@extends('admin.layouts.app')

@section('footer')

@endsection

@section('content')
    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active"><a href="{{ route('admin.order.index') }}">@lang('messages.order')</a> </li>
            <li class="active">@lang('messages.add') </li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif


                <form action="{{ Request()->is('*create*') ?: route('admin.order.edit', $order->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @if (Request()->is('*edit*'))
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="row">


                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.name'):
                            <input class="form-control" name="name" type="text"
                                value="{{ old('name', $order->name ?? '') }}" required>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>


                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.mobile'):
                            <input id="mobile" type="text" class="form-control" name="mobile"
                                value="{{ old('mobile', $order->mobile ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        </div>


                        <div class="col-md-3  col-sm-3 form-group">کد پستی:
                            <input class="form-control" name="email" type="text"
                                value="{{ old('email', $order->email ?? '') }}">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="col-md-3  col-sm-3 form-group">@lang('messages.address'):
                            <input class="form-control" name="address" type="text"
                                value="{{ old('address', $order->address ?? '') }}">
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>


                        <div class="col-md-5 col-sm-6 form-group">
                            <label for="name">محصول:</label>
                            <div style="display: flex; gap: 5px">
                                <select id="product" name="product" >
                                    @foreach ($products as $Key => $fields)
                                        <option value="{{ $fields['id'] }}">{!! $fields['title'] !!}</option>
                                    @endforeach
                                </select>
                                <a class="btn btn-success block">افزودن</a>
                            </div>
                            <span id="product-add-btn" class="text-danger">{{ $errors->first('parent_id') }}</span>
                        </div>


                        <div class="col-12 col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>کد</th>
                                        <th>@lang('messages.image')</th>
                                        <th>@lang('messages.title')</th>
                                        <th>@lang('messages.price')</th>
                                        <th>@lang('messages.status')</th>
                                        <th>@lang('messages.updated at')</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div style="font-weight:bold">
                                                مبلغ کل @convertCurrency($order->total_price) @lang('messages.toman')
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-6 col-md-6">
                            <label for="name" class="col-form-label text-md-left">@lang('messages.status'):</label>

                            <select class="form-control" name="status">
                                <option value="1" {{ ($order->status) == '-1' ? 'selected' : '' }}>ثبت شده</option>
                                <option value="1" {{ ($order->status) == '0' ? 'selected' : '' }}>رد شد</option>
                                <option value="1" {{ ($order->status) == '1' ? 'selected' : '' }}> ارسال به بانک</option>
                                <option value="1" {{ ($order->status) == '2' ? 'selected' : '' }}>آپلود فیش </option>
                                <option value="1" {{ ($order->status) == '3' ? 'selected' : '' }}>
                                    @lang('messages.paid successfully')</option>
                                <option value="1" {{ ($order->status) == '4' ? 'selected' : '' }}>@lang('messages.prepairing')
                                </option>
                                <option value="1" {{ ($order->status) == '5' ? 'selected' : '' }}>
                                    @lang('messages.ready to send')</option>

                            </select>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">

                            <button type="submit" class="btn btn-success  @if (!$ltr) pull-right @endif mat-btn ">

                                @if (Request()->is('*create*'))
                                    @lang('messages.add')
                                @else
                                    @lang('messages.edit')
                                @endif
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function () {
            var $input = $("#parent_id");
            var $parent_id_hide = $("#parent_id_hide");
            var $parent = $('#parent_id_hide').find(':selected').val();

            $input.on("selecting unselecting change", function () {
                setOption($("#parent_id").parent().find("ul.select2-choices"));

            })
            $parent_id_hide.on("selecting unselecting change", function () {
                $parent = $('#parent_id_hide').find(':selected').val();

            })

            $("#parent_id").parent().find("ul.select2-choices").sortable({
                containment: 'parent',
                update: function () {
                    setOption(this)
                },
            });


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
                $($this).find(".select2-search-choice").each(function (i, tag) {

                    var $exist = 0;
                    options.each(function (j, option) {
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


            };
        });
    </script>

    <script>
        $("#product").select2();
        // $("#phone").select2({
        //     tags: [],
        //     maximumInputLength: 100
        // });
    </script>





    <script>


        // $('body').on('click', '.map-editor button.edit', function() {
        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         url: "{ { route('company.profile.update') }}",
        //         data: {
        //             '_token': $('meta[name="_token"]').attr('content'),
        //             'data': [{
        //                 'name': 'location',
        //                 'value': marker.getLatLng().lat + ',' + marker.getLatLng().lng
        //             }]
        //         },
        //         success: function(data) {
        //             marker.dragging.disable();
        //             map.scrollWheelZoom.disable();

        //             $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
        //             $('.map-area').toggleClass('map-editor');
        //         }
        //     });
        // });



        // $('body').on('click', '.map-editor a.cancel', function() {
        //     marker.dragging.disable();
        //     map.scrollWheelZoom.disable();
        //     $('.map-area .edit,.map-area .cancel,.map-area .guid').remove();
        //     $('.map-area').toggleClass('map-editor');
        // });




    </script>
@endsection
