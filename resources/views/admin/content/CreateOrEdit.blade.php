@extends('admin.layouts.app')
@section('ckeditor')
    <script>
        $(document).ready(function() {

            $('.selcet2').select2();

            var $input = $("#parent_id");
            var $parent_id_hide = $("#parent_id_hide");
            var $parent = $('#parent_id_hide').find(':selected').val();

            $parent_id_hide.select2();
            $input.select2();
            $input.on("selecting unselecting change", function() {
                setOption($("#parent_id").parent().find("ul.select2-choices"));

            })
            $parent_id_hide.on("selecting unselecting change", function() {
                $parent = $('#parent_id_hide').find(':selected').val();

            })

            $("#parent_id").parent().find("ul.select2-choices").sortable({
                containment: 'parent',
                update: function() {
                    setOption(this)
                },

            });

            @isset($content)
                @php
                $categoryImplode = "'" . implode("','", $content->categories->pluck('id')->toArray()) . "'";

                @endphp
            @endisset
            $input.val([{!! $categoryImplode ?? '' !!}]);
            $input.trigger('change'); // Notify any JS components that the value changed
            function setOption($this) {
                var $select = $("#parent_id");
                //$(this).closest(".select2-container").next();
                var options;
                options = $select.find("option");
                //$("#parent_id_hide").empty();
                //var newoptions = '';
                var newoptions = [];
                // Clear option
                $($this).find(".select2-search-choice").each(function(i, tag) {

                    var $exist = 0;
                    options.each(function(j, option) {
                        var optionTag = '';
                        if ($.trim($(tag).text()) == $.trim($(option).text())) {
                            // console.log(option.val());
                            //$("#par_idd").append(new Option($(tag).text(),  $(option).val()));
                            optionTag = new Option($(tag).text(), $(option).val());
                            if ($(option).val() == $parent) {
                                $exist = 1;
                            }
                            $("#par_idd").append(new Option($(tag).text(), $(option).val()));
                            //newoptions=newoptions+','+$(option).val();
                            newoptions.push(optionTag);
                            //$("#par_idd").append(option);
                        }

                    });
                });


                //$parent = $('#parent_id_hide').find(':selected').val();

                $("#parent_id_hide").empty();
                //$('#parent_id_hide option:selected').removeAttr('selected');
                $('#parent_id_hide').select2('destroy');
                $parent_id_hide.select2();
                if (newoptions.length > 0) {
                    $("#parent_id_hide").append(newoptions);
                    $parent_id_hide.val($parent);
                }
                // $parent_id_hide.val($parent);

                //$('#parent_id_hide').select2('destroy');

                //if ($exist != 0) {
                // }
                $parent_id_hide.trigger('change'); // Notify any JS components that the value changed


                //getselector();


            }
        });
        $("#meta_keywords").select2({
            tags: [],
            maximumInputLength: 100
        });
    </script>

    <script src="/ckeditor4/ckeditor.js"></script>

    <script>
        CKEDITOR
            .replace(document.querySelector('#brief_description'), {
                ckfinder: {
                    uploadUrl: "{{ route('contents.upload', ['_token' => csrf_token()]) }}",
                },

                @if (!$ltr)
                    language: 'fa'
                @endif
            })
        // .then(editor => {
        //     const wordCountPlugin = editor.plugins.get('WordCount');
        //     const wordCountWrapper = document.getElementById('word-count1');
        //     wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);

        //     window.editor = editor;
        // })

        // .catch(err => {
        //     console.error(err.stack);
        // });
    </script>





@endsection

@section('content')

    <div class="content-control">
        <ul class="breadcrumb">
            @php
                $template = '';
                $attr_type = Request()->is('*product*') ? 'product' : 'article';

                if (Request()->get('template')) {
                    $template = Request()->get('template');
                }

                if (isset($content->attr_type)) {
                    $attr_type = $content->attr_type;
                }
                if (isset($content->attr['template_name'])) {
                    $template = $content->attr['template_name'];
                }

            @endphp

            <li><a href="{{ route('contents.type.show', ['type' => $attr_type]) }}" class="">
                    @lang('messages.'. $attr_type .'s' ) </a></li>
            <li class="active">
                @if (Request()->is('*create*'))
                    @lang('messages.add')
                @else
                    @lang('messages.edit') {{ old('title', $content->title) }}

                @endif


            </li>
        </ul>
    </div>


    <div class="content-body">
        <div class="panel panel-default  pos-abs chat-panel bottom-0">

            <div class="panel-body ">


                <div
                    style="background: rgb(255, 255, 111);padding:5px;margin-bottom:1em; border-radius:5px;box-shadow:0 1px 3px rgba(0,0,0,0.2)">
                    <label for="" style="float: right; line-height: 2em">ویژگی محصول</label>

                    <form action="" method="get">
                        <input type="hidden" name="qtitle" value="{{ app('request')->qtitle }}">
                        <input type="hidden" name="qslug" value="{{ app('request')->qslug }}">
                        <input type="hidden" name="page" value="{{ app('request')->page }}">
                        <div class="col-3 col-md-3">

                            <select name="attr" id="" class="form-control">
                                <option value="">بدون ویژگی</option>
                                @foreach ($attributes as $item)
                                    <option value="{{ $item->id }}"
                                        {{ app('request')->attr == $item->id ? 'selected': (($attribute->id ??'') == $item->id?'selected':'')}}
                                        >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-danger">تغییر</button>
                    </form>
                </div>





                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif

                @if (Request()->is('*create*'))
                    <form method="post"
                        action=" {{ route('contents.store', ['attr_type' => $attr_type, 'page' => app('request')->input('page'), 'qtitle' => app('request')->qtitle, 'qslug' => app('request')->qslug]) }}"
                        enctype="multipart/form-data">
                    @else
                        <form method="post"
                            action="   {{ route('contents.update', ['attr_type' => $attr_type, 'content' => $content->id, 'page' => app('request')->input('page'), 'qtitle' => app('request')->qtitle, 'qslug' => app('request')->qslug]) }}"
                            enctype="multipart/form-data">
                            @method('PATCH')
                @endif

                @csrf




                <div class="form-group row">
                    <div class="col-5 col-md-5 col-xs-12">
                        <label for="title" class=" col-form-label text-md-left">@lang('messages.title'):</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $content->title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="col-5 col-md-5  col-xs-12">
                        <label for="slug" class=" col-form-label text-md-left">@lang('messages.url') :</label>
                        <input type="text" class="form-control" name="slug"
                            value="{{ old('slug', $content->slug ?? '') }}"
                            placeholder="@lang('messages.if slug empty')" />
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="col-2 col-md-2 col-xs-12">
                        <label for="name">@lang('messages.publish date') :</label>
                        <input type="{{ $ltr ? 'date' : '' }}" class="form-control @if (!$ltr) datepicker @endif"
                            name="publish_date" value="{{ old('publish_date', $content->publish_date ?? '') }}" />
                    </div>
                </div>
                @if (isset($template) && $template != '')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.static template')
                                @lang('messages.name')
                                :</label>
                            <input type="text" class="form-control" name="attr[template_name]"
                                value="{{ old('attr[template_name]', $content->attr['template_name'] ?? '') }}" />

                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.brief'):</label>

                        <textarea class="form-control" id="brief_description" name="brief_description" rows="10"
                            placeholder="Enter your Content">{{ old('brief_description', $content->brief_description ?? '') }}</textarea>
                        <div id="word-count1"></div>
                        <span class="text-danger">{{ $errors->first('brief_description') }}</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="name" class=" col-form-label text-md-left">@lang('messages.description')
                            :</label>
                        <span class="text-danger">{{ $errors->first('description') }}</span>

                    </div>

                    <div class="col-md-12">
                        @include('admin.gridMaker')
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-6 col-md-6">
                        <label for="name">@lang('messages.category'):</label>
                        <select id="parent_id" class="js-example-basic-multiple" name="parent_id[]" multiple="multiple">

                            @foreach ($category as $Key => $fields)
                                <option value="{{ $fields['id'] }}">{!! $fields['symbol'] . $fields['title'] !!}</option>
                            @endforeach
                        </select>

                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                    <div class="col-6 col-md-6">

                        <label for="name">@lang('messages.main category'):</label>

                        <div id="parent_id_val" class="parent_id_val"></div>
                        <select id="parent_id_hide" name="parent_id_hide">
                            <option value="{!! $content->parent_id ?? '' !!}"></option>
                        </select>

                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-6 col-sm-6">
                        <label for="images" class="control-label">@lang('messages.image')
                            <br>
                            (@lang('messages.content') w:{{ env('ARTICLE_LARGE_W') }}px
                            h:{{ env('ARTICLE_LARGE_H') }}px)
                            <br>
                            (@lang('messages.product') w:{{ env('PRODUCT_LARGE_W') }}px
                            h:{{ env('PRODUCT_LARGE_H') }}px)</label>
                        <input type="file" class="form-control" name="images" id="images"
                            placeholder="@lang('messages.select image')" value="{{ old('imageUrl') }}">



                        @include('admin.cropper')


                    </div>
                    <div class="col-6 col-sm-6">
                        <label for="watermark">@lang('messages.watermark') @lang('messages.image')</label>
                        <input class="form-control" id="watermark" placeholder="@lang('messages.watermark placeholder')"
                            type="text" name="watermark">
                    </div>

                </div>

                <div class="form-group row ">
                    <div class="col-sm-12" style="display: flex">
                        @if (is_array($content->images ?? ''))
                            @foreach ($content->images['images'] as $key => $image)
                                <div class="col-sm-2">
                                    <label class="control-label">
                                        {{ $key }}

                                        <a href="{{ $image }}" target="_blank"><img src="{{ $image }}"
                                                width="{{ (env(Str::upper($attr_type) . '_' . Str::upper($key) . '_W') ?? env(Str::upper($attr_type) . '_LARGE_W')) / 4 }}"></a>
                                    </label>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>



                <div style="background: #ddd; padding:1em;border-radius:5px;" class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_title">@lang('messages.gallery')</label>

                        <div class="gallery">
                            @foreach ($content->gallery ?? [] as $item)
                                <div>
                                    <img src="{{ $item->images['images']['small'] }}" data-id="{{ $item->id }}"
                                        height="100" alt="">
                                </div>
                            @endforeach

                        </div>

                        <div class="col-4 col-md-4">
                            <input type="file" class="form-control" name="galleryFile" id="galleryFile">
                        </div>

                        @include('admin.cropperGallery')


                    </div>
                </div>


                <div class="row"
                    style="background: #ddd; border-radius:5px; padding:1em; margin-bottom:1em; display:block">
                    @include('admin.attribute.CreateOrEdit')
                </div>


                <div class="form-group row">
                    <div class="col-md-6 col-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title"
                            value="{{ old('meta_title', $content->meta_title ?? '') }}" />
                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                    </div>
                    <div class="col-md-6 col-6">
                        <label for="name" class=" text-md-left">meta keywords</label>
                        <input id="meta_keywords" type="text" name="meta_keywords"
                            value="{{ old('meta_keywords', $content->meta_keywords ?? '') }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="meta_description" class=" col-form-label text-md-left">meta
                            Description:</label>
                        <textarea class="form-control" id="meta_description"
                            name="meta_description">{{ old('meta_description', $content->meta_description ?? '') }}</textarea>
                    </div>

                </div>



                @if ($attr_type == 'product')

                    <div class="form-group row">

                        <div class="col-6 col-md-6">
                            <label for="price"
                                class=" col-form-label text-md-left">@lang('messages.price'):@lang('messages.toman')</label>
                            <input type="text" class="form-control" name="attr[price]"
                                value="{{ old('attr[price]', $content->attr['price'] ?? '') }}" />
                        </div>

                        <div class="col-6 col-md-6">
                            <label for="offer_price"
                                class=" col-form-label text-md-left">@lang('messages.discount'):</label>

                            <input type="text" class="form-control" name="attr[offer_price]"
                                value="{{ old('attr[offer_price]', $content->attr['offer_price'] ?? '') }}" />
                        </div>

                        <div class="col-6 col-md-6">
                            <label for="brand" class=" col-form-label text-md-left">@lang('messages.brand'):</label>
                            <input type="text" class="form-control" name="attr[brand]"
                                value="{{ old('attr[brand]', $content->attr['brand'] ?? '') }}" />
                        </div>


                        <div class="col-6 col-md-6 ">
                            <label for="alternate_name" class=" col-form-label text-md-left">@lang('messages.alternative')
                                @lang('messages.name')
                                :</label>

                            <input type="text" class="form-control" name="attr[alternate_name]"
                                value="{{ old('attr[alternate_name]', $content->attr['alternate_name'] ?? '') }}" />
                        </div>
                    </div>

                @endif
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="rate" class="col-form-label text-md-left">@lang('messages.rate'):</label>

                        <input type="text" class="form-control" name="attr[rate]"
                            value="{{ old('attr[rate]', $content->attr['rate'] ?? '') }}" />
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="col-form-label text-md-left">@lang('messages.status'):</label>

                        <select class="form-control" name="status">
                            <option value="1" {{ ($content->status ?? '1') == '1' ? 'selected' : '' }}>
                                @lang('messages.Active')</option>
                            <option value="0" {{ ($content->status ?? '') == '0' ? 'selected' : '' }}>
                                @lang('messages.Disactive')</option>
                        </select>
                    </div>
                </div>


                <button type="submit" class="btn btn-success  @if (!$ltr) pull-right @endif mat-btn ">
                    @if (Request()->is('*create*'))
                        @lang('messages.add')
                    @else
                        @lang('messages.edit')
                    @endif
                </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        #cropperPreview,
        #cropperPreviewPng {
            width: {{ env('CATEGORY_SMALL_W') }}px !important
        }

    </style>
@endsection
