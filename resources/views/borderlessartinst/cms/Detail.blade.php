@extends(@env('TEMPLATE_NAME').'.App')

@section('head')
    <meta property="og:image" content="{{ url($detail->images['images']['medium'] ?? '') }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:height"
        content="{{ $detail->attr_type == 'product' ? env('PRODUCT_MEDIUM') : env('ARTICLE_MEDIUM') }}" />
    <meta property="og:image:alt" content="{{ $detail->title }}" />

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

@endsection

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

    {{-- recaptcha --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        function callbackThen(response) {
            // read HTTP status
            console.log(response.status);

            // read Promise object
            response.json().then(function(data) {
                console.log(data);
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error);
            alert('صفحه را مجدد بارگذاری نمایید.')
        }

    </script>
    {!! htmlScriptTagJsApi([
    'callback_then' => 'callbackThen',
    'callback_catch' => 'callbackCatch',
    ]) !!} --}}
@endsection

@section('Content')
    @php
    $tableOfImages = tableOfImages($detail->description);
    $append = '';
    @endphp

    @if ($detail->attr_type == 'product')
        @include('jsonLdProduct')
    @endif
    @include('jsonLdFaq')


    <section class="breadcrumb">
        <div class="flex one  ">
            <div class="p-0">
                <a href="/">Home </a>
                @foreach ($breadcrumb as $key => $item)
                    <span>></span>
                    <a href="{{ $item['slug'] }}">{{ $item['title'] }}</a>
                @endforeach

            </div>
        </div>
    </section>

    <section class="detail" id="">

        <div class="flex one ">
            <div class="bg-white border-radius-5">
                <div class="top-page">
                    <div>
                        <h1 class="">{{ $detail->title }}</h1>
                        <div>
                            @isset($detail->attr['price'])
                                <span class="price text-green "> @convertCurrency($detail->attr['price']?? 0) تومان</span>
                            @endisset
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
                                        <img width="20" height="20"
                                            srcset="{{ asset('/img/star2x.png') }} 2x , {{ asset('/img/star1x.png') }} 1x"
                                            src="{{ asset('/img/star1x.png') }}" alt="{{ 'star for rating' }}">
                                    @endfor
                                    <span class="font-08">({{ count($detail->comments) }} نفر)</span>
                                @endif
                            </span> |
                            {{ $detail->viewCount }} Viewed |
                            Date published: <span class="ltr">{{ convertGToJ($detail->publish_date) }} </span> |

                            <ul>
                                @foreach ($table_of_content as $key => $item)
                                    <li class="toc1">
                                        <a href="#{{ $item['anchor'] }}">{{ $item['label'] }}</a>
                                    </li>
                                @endforeach

                            </ul>


                            @include(@env('TEMPLATE_NAME').'.DescriptionModule')

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>



    @if (count($relatedPost))
        <section class="films bg-orange" id="index-best-view">
            <div class="flex one ">
                <div>
                    <h2>Related to {{ $detail->title }}</h2>
                    <div class="flex one two-500 four-900 center ">

                        {{-- $data['newPost'] --}}
                        @foreach ($relatedPost as $content)
                            <div>

                                <article class="shadow1">
                                    @if (isset($content->images['thumb']))
                                        <a href="{{ $content->slug }}">
                                            <div><img src="{{ $content->images['thumb'] }}"
                                                    alt="{{ $content->title }}">
                                            </div>
                                        </a>
                                    @endif
                                    <footer>
                                        <h2> <a href="{{ $content->slug }}">{{ $content->title }}</a></h2>

                                    </footer>
                                </article>

                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </section>
    @endif

    <style>
        .films footer {
            text-align: center
        }

        .films article {
            background-color: #000;
        }

        .films article footer a {
            color: #fff;
            padding: 1em;
            display: block
        }

        .films img {
            width: 100%
        }



    </style>

@endsection
