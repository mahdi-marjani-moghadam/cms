@extends(@env('TEMPLATE_NAME').'.App')

@section('twitter:title', $detail->title)
@section('twitter:description', clearHtml($detail->brief_description))

@section('og:title', $detail->title)
@section('og:description', clearHtml($detail->brief_description))
@section('canonical', url($detail->slug))

@if (isset($detail->images['images']['medium']))

    @section('twitter:image', url($detail->images['images']['medium']))

    @section('og:image', url($detail->images['images']['medium']))
    @section('og:image:type', 'image/jpeg')
    @section('og:image:width', $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM_W') : env('ARTICLE_MEDIUM_W'))
    @section('og:image:height', $detail->attr_type == 'article' ? env('PRODUCT_MEDIUM_H') : env('ARTICLE_MEDIUM_H'))
    @section('og:image:alt', $detail->title)

@endif




@section('footer')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {

            const ratings = document.querySelectorAll('[name="rate"]');
            const labels = document.querySelectorAll('.rating > label');

            const change = (e) => {
                console.log(e.target.value);

            }
            const mouseenter = (e) => {
                document.getElementById('rating-hover-label').innerHTML = e.target.title;
            }
            const mouseleave = (e) => {

                document.getElementById('rating-hover-label').innerHTML = '';
            }

            ratings.forEach((el) => {
                el.addEventListener('change', change);
            });
            labels.forEach((el) => {
                el.addEventListener('mouseenter', mouseenter);
                el.addEventListener('mouseleave', mouseleave);
            });
        });
    </script>
     @auth
     @if ((Auth::user()->id) == 1)

        <div class="btn btn-info edit-button" onclick="window.open('{{ url('/admin/contents/' . $detail->id . '/edit/') }}')">
            ویرایش</div>
    @endif
    @endauth
@endsection


@section('Content')
    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp

    @if ($detail->attr_type == 'product')
        @include('jsonLdProduct')
    @endif

    @if ($detail->attr_type == 'article')
        @include('jsonLdArticle')
    @endif
    @include('jsonLdWebsite')

    @include('jsonLdBreadcrumb')

    <section class="breadcrumb">
        <div class="flex one  ">
            <div class="p-0">
                <a href="/">خانه </a>
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                @endforeach

            </div>
        </div>
    </section>

    <section class="product-detail" id="">
        <div class="flex one ">

            <div>
                <div class="top-page">
                    @if (isset($detail->images['images']['large']))
                        <picture>
                            <source media="(min-width:{{ env('PRODUCT_MEDIUM_W') }}px)"
                                srcset="{{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['large']) ?? '' }} 2x">
                            <source media="(min-width:{{ env('PRODUCT_SMALL_W') }}px)"
                                srcset="{{ str_replace(' ', '%20', $detail->images['images']['small']) ?? '' }} , {{ str_replace(' ', '%20', $detail->images['images']['medium']) ?? '' }} 2x">
                            <img src="{{ $detail->images['images']['medium'] ?? '' }}"
                                sizes="(max-width:{{ env('PRODUCT_MEDIUM_W') }}px) 100vw  {{ ENV('PRODUCT_MEDIUM_W') }}px {{ ENV('PRODUCT_LARGE_W') }}px"
                                alt="{{ $detail->title }}" width="{{ env('PRODUCT_LARGE_W') }}"
                                height="{{ env('PRODUCT_LARGE_H') }}">
                        </picture>

                    @endif
                    <div>
                        <h1 class="">{{ $detail->title }}</h1>
                        <div>
                            @isset($detail->attr['price'])<div class="price">قیمت: @convertCurrency($detail->attr['price']) تومان </div>@endisset
                            @if (count($detail->companies))
                                <div class="company-logo">
                                    فروشگاه / تعمیرگاه
                                    <a href="{{ url('/profile/' . $detail->companies->first()->id) }}">
                                        {{ $detail->companies->first()->name ?? '' }}</a>
                                </div>
                            @endif

                            <div>{!! $detail->brief_description !!}</div>

                            <span class="rate mt-1">
                                @if (count($detail->comments))
                                    @php
                                        $rateAvrage = $rateSum = 0;
                                    @endphp
                                    @foreach ($detail->comments as $comment)
                                        @php
                                            $rateSum = $rateSum + $comment['rate'];
                                        @endphp
                                    @endforeach
                                    @for ($i = $rateSum / count($detail->comments); $i >= 1; $i--)
                                        <label for=""></label>
                                    @endfor
                                    <span class="font-08">({{ count($detail->comments) }} نفر)</span>
                                @endif
                            </span> |
                            {{ $detail->viewCount }} بار دیده شده |
                            تاریخ انتشار: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |
                        </div>
                    </div>
                </div>


                <ul>
                    @foreach ($table_of_content as $key => $item)
                        <li class="toc1">
                            <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach

                </ul>


                @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                {{-- <script type="text/javascript">
                    (function(){
                    var now = new Date();
                    var head = document.getElementsByTagName('head')[0];
                    var script = document.createElement('script');
                    script.async = true;
                    var script_address = 'https://cdn.yektanet.com/js/remotyadak.ir/native-remotyadak.ir-22550.js';
                    script.src = script_address + '?v=' + now.getFullYear().toString() + '0' + now.getMonth() + '0' + now.getDate() + '0' + now.getHours();
                    head.appendChild(script);
                    })();
                </script>
                <div id="pos-article-text-card-65103"></div> --}}

                {{-- attribute --}}
                <div class="attr">
                    <div class="">
                        @foreach ($detail->attributeValue as $key => $item)
                            <div class="">
                                <div >
                                    {{ $item->label }}
                                </div>
                                <div>
                                    @if ($item->type=='combo' && $item->json != '')
                                        @php
                                            $json= collect(json_decode($item->json))->where('value','=',$item->value)->first();
                                            echo $json->name ?? ''
                                        @endphp
                                    @else
                                        {{ $item->value }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- end attribute --}}


            </div>
        </div>
    </section>

    @if (count($relatedProduct))
        <section class="products bg-gray m-0 pt-1 pb-1" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>محصولات مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900  ">

                        @foreach ($relatedProduct as $content)
                            <div class="">
                                <a href="{{ url($content->slug) }}">
                                    <article class="shadow">
                                        @if (isset($content->images['images']['small']))
                                            <div><img width="150" height="150px"
                                                    src="{{ $content->images['images']['small'] }}"
                                                    alt="{{ $content->title }}"></div>
                                        @endif
                                        <footer>
                                            <div> {{ $content->title }}</div>
                                            {!! $content->brief_description !!}
                                        </footer>
                                    </article>
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    @if (count($relatedPost))
        <section class="products" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>مقاله های مرتبط {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{-- $data['newPost'] --}}
                        @foreach ($relatedPost as $content)
                            <div>
                                <article>
                                    @if (isset($content->images['images']['small']))
                                        <div><img src="{{ $content->images['images']['small'] }}"
                                                alt="{{ $content->title }}"></div>
                                    @endif
                                    <footer>
                                        <h2><a href="{{ $content->slug }}"> {{ $content->title }}</a></h2>
                                        {!! $content->brief_description !!}
                                    </footer>
                                </article>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    <section class="comments bg-gray mt-0 mb-0">
        <div class="flex one">
            <div>
                <div>نظرات شما در مورد {{ $detail->title }}</div>

                <div>
                    <div class="comment-form">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                {!! \Session::get('success') !!}
                            </div>
                        @endif

                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <form action="{{ route('comment.client.store') }}#comment" id="comment" method="post">
                            <input type="hidden" name="content_id" value="{{ $detail->id }}">

                            @csrf
                            <div>
                                <div class="rating">
                                    <span>امتیاز: </span>
                                    <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }}
                                        value="5" />
                                    <label for="st5" title="عالی"></label>
                                    <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }}
                                        value="4" />
                                    <label for="st4" title="خوب"></label>
                                    <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }}
                                        value="3" />
                                    <label for="st3" title="معمولی"></label>
                                    <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }}
                                        value="2" />
                                    <label for="st2" title="ضعیف"></label>
                                    <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }}
                                        value="1" />
                                    <label for="st1" title="بد"></label>
                                    <span id="rating-hover-label"></span>
                                </div>
                            </div>

                            <div>
                                <label for="comment_name">نام:</label>
                                <input id="comment_name" type="text" name="name" value="{{ old('name') }}">
                            </div>
                            <div>
                                <label for="comment-text">پیام:</label>
                                <textarea id="comment-text" name="comment">{{ old('comment') }}</textarea>
                            </div>
                            <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key"
                                data-callback='onSubmit' data-action='submit'>ارسال نظر</button>
                        </form>
                    </div>

                    @foreach ($detail->comments as $comment)
                        @if ($comment['name'] != '' && $comment['comment'] != '')
                            <div class="comment">
                                <div class="aside">
                                    <div class="name">{{ $comment['name'] }}</div>
                                    <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                                </div>
                                <div class="article">
                                    <div>
                                        @for ($i = $comment->rate; $i >= 1; $i--)
                                            <img width="20" height="20"
                                                srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                                src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                        @endfor
                                    </div>
                                    <div class="text">{!! $comment['comment'] !!}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
