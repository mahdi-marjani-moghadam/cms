@extends(@env('TEMPLATE_NAME') . '.App')
@section('meta-title', __('messages.invoices'))

@section('Content')
    <section class="panel">
        @include('auth.customer.nav')

        <div class="list">
            <h1 class="flex">
                <a class="font-08" href="{{ route('customer.order.list') }}"><- {{ Lang::get('messages.back to', ['page' => Lang::get('messages.orders')]) }}</a>
                        <span class="align-left font-08"></span>
            </h1>
            <div class="">

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

                <div class="grid gap-4 grid-cols-1 md:grid-cols-3">
                    <div class="md:col-span-2 pb-3 px-3 bg-slate-100  border rounded">
                        <meta name="_token" content="{{ csrf_token() }}">
                        @if ($order->status == 0)
                            <h2> آدرس و مشخصات تحویل گیرنده</h2>

                            <form method="post" id="upload-bill" enctype="multipart/form-data" class="flex    px-1 py-1 "
                                action="{{ route('customer.uploadBill', ['order' => $order->id]) }}">
                                @csrf
                                @method('post')

                                <div class=" max-md:w-full  ">
                                    <div class=" grid md:grid-cols-7  mb-3">
                                        @lang('messages.name'):
                                        @if (!isset(Auth::user()->customer->name) || Auth::user()->customer->name == '')
                                            <span class="absolute right-0 top-6 text-red-700  p-1 -mr-3 px-3 text-xs">نام را وارد
                                                نمایید</span>
                                        @endif
                                        <div class="col-span-6">

                                            <input type="text" required name="name"
                                                value="{{ old('name', Auth::user()->customer->name) }}"
                                                class=" grow focus:ring-gray-500 w-full  rounded  p-2 bg-white  text-gray-700  ">
                                            @if ($errors->has('name'))
                                                <div class="w-full text-red-500">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>


                                    <div class=" grid md:grid-cols-7 mb-3">
                                        <span class="">@lang('messages.address'):</span>
                                        @if (!isset(Auth::user()->customer->address) || Auth::user()->customer->address == '')
                                            <span class="absolute right-0 top-6 text-red-700  p-1 -mr-3 px-3 text-xs">آدرس را وارد
                                                نمایید</span>
                                        @endif

                                        <div class="col-span-6">
                                            <input name="address" required type="text"
                                                value="{{ old('address', Auth::user()->customer->address)  }}"
                                                class="w-full  grow focus:ring-gray-500 rounded p-2 bg-white  text-gray-700 ">
                                            @if ($errors->has('address'))
                                                <div class="text-red-500">
                                                    {{ $errors->first('address') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="grid md:grid-cols-7  ">@lang('messages.zipcode'):
                                        @if (!isset(Auth::user()->customer->zipcode) || Auth::user()->customer->zipcode == '')
                                            <span class="absolute right-0 top-6 text-red-700  p-1 -mr-3 px-3 text-xs">کد پستی را
                                                وارد
                                                نمایید</span>
                                        @endif
                                        <div class="col-span-6">

                                            <input name="zipcode" required type="text"
                                                value="{{ old('zipcode', Auth::user()->customer->zipcode) }}"
                                                class=" grow  w-full rounded  p-2 bg-white  text-gray-700  ">
                                            @if ($errors->has('zipcode'))
                                                <div class="text-red-500">
                                                    {{ $errors->first('zipcode') }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <h2 class="!mt-4 w-full border-t-2 border-gray-700"><span
                                        class="bg-yellow-500  px-[7px] rounded-full text-sm">1</span> روش پرداخت کارت به کارت
                                </h2>
                                <div class="w-full mb-4">
                                    <p class="border bg-yellow-100 rounded-md p-1 text-xs">بعد از پرداخت کارت به کارت تصویر فیش
                                        خود را آپلود نماید تا تیم فروش مراحل خرید شما را پیگیری نمایند.</p>
                                    <p class="border bg-white rounded-md p-1 mt-1 text-center ">شماره کارت به نام مهدی مرجانی
                                        مقدم
                                        <br>
                                        <span class="font-bold text-lg ltr ">6219-8610-2672-9706 <a href="#"
                                                class="text-sm ring-1  rounded-full px-3" id="copy-card"> کپی</a> </span>
                                    </p>
                                </div>


                                <div class="mt-2 block" for="">می توانید تصویر چندین فیش را انتخاب نمایید</div>
                                <input type="file" id="fileInput" multiple name="bill[]" class=" text-sm text-gray-500
                                    w-full mb-2 hidden
                                    file:py-2 file:px-4
                                    file:rounded
                                    file:text-sm file:font-semibold
                                    file:bg-gray-300 file:text-gray-500 cursor-pointer
                                    hover:file:bg-gray-100 file:border file:border-solid file:border-gray-500
                                ">

                                <button type="button" id="customButton"
                                    class="block text-sm bg-gray-300 mr-2 rounded py-2 px-4 mb-2">
                                    انتخاب تصاویر
                                </button>
                                <div id="errorMessage" class="text-red-500 w-full "></div>
                                <span id="fileName" class="text-gray-600 w-full mb-2"></span>
                                @if ($errors->has('bill'))
                                    <div class="text-red-500">
                                        {{ $errors->first('bill') }}
                                    </div>
                                @endif

                                <button class="rounded-full border bg-blue-500 !text-white p-1 px-3 font-normal">ثبت مشخصات و
                                    فیش</button>
                            </form>

                            <div class="mt-6 border-t-2 border-gray-700">
                                <h2 class="w-full"><span class="bg-yellow-500  px-[7px] rounded-full text-sm">2</span> پرداخت از
                                    صندوق طلا</h2>
                                <div class="border bg-white rounded-md p-3 mt-2 flex items-center">

                                    <div class=" mx-auto">
                                        <strong>موجودی شما: {{ $balance['gold'] ?? 0 }} گرم</strong><br>
                                    </div>

                                    <form method="post" class="mx-auto"
                                        action="{{ route('customer.order.payWallet', $order) }}">
                                        @csrf
                                        <button type="submit"
                                            class="rounded-full border bg-green-600 !text-white p-2 px-4 font-normal"
                                            onclick="return confirm('آیا از پرداخت از کیف پول اطمینان دارید؟')">
                                            پرداخت از کیف پول
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @else


                            <div class="flex justify-between">
                                <div> شماره سفارش #{{ $order->id }}</div>

                                @if ($order->status == 1)
                                    <div>@lang('messages.status'): @lang('messages.send to bank')</div>
                                @elseif ($order->status == 2)
                                    <div class="border bg-yellow-100 rounded text-sm px-2 mt-1">
                                        <span class=""> در حال بررسی می باشد</span>
                                    </div>
                                @elseif ($order->status == 3)
                                    <div class="green">@lang('messages.status'): @lang('messages.paid successfully')</div>
                                @elseif ($order->status == 4)
                                    <div class="green">@lang('messages.status'): @lang('messages.prepairing')</div>
                                @elseif ($order->status == 5)
                                    <div class="green"><svg class="w-5 fill-lime-950" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="nu rw uk axs">
                                            <path fill-rule="evenodd"
                                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                clip-rule="evenodd"></path>
                                        </svg> @lang('messages.ready to send')</div>
                                @elseif ($order->status == -1)
                                    <div class="red">
                                        @lang('messages.status'): سفارش رد شد
                                        {{ $order->message }}
                                    </div>
                                @else
                                    <div>
                                        <i
                                            class="fa fa-remove bg-red-600 text-white w-5 h-5 p-1 text-sm  rounded-full text-center "></i>
                                        @lang('messages.pending')
                                    </div>
                                @endif
                            </div>

                            <div class="relative">
                                @lang('messages.name'):
                                <span class=" font-bold  inline-block m-1  rounded ">
                                    {{ Auth::user()->customer->name ?? '' }}</span>
                            </div>

                            <div class="relative">
                                @lang('messages.address'):
                                <span class=" font-bold   inline-block m-1    rounded ">
                                    {{ Auth::user()->customer->address ?? '' }}</span>
                            </div>

                            <div class="relative ">@lang('messages.zipcode'):
                                <span class=" font-bold  inline-block m-1   rounded ">
                                    {{ Auth::user()->customer->zipcode ?? '' }}</span>
                            </div>
                            @foreach ($order->transactions as $item)
                                <div class="text-xs  my-2">آپلود شده در تاریخ: {{ convertGtoJ($item->created_at) }}</div>
                                @foreach(explode(',', $item->description) as $bill)
                                    <a target="__blunk" class="rounded-full ring-1  ring-blue-500  ml-2 mb-2 px-3  inline-block"
                                        href="{{ $bill }}">مشاهده فیش
                                        <img src="{{ $bill }}" class="inline-block rounded h-7" height="28" alt="">
                                    </a>
                                @endforeach
                            @endforeach
                        @endif
                    </div>







                    <div class=" px-3 bg-slate-100  border rounded mb-20">
                        @foreach ($orderDetail as $content)
                            @php
                                $pid = $content['attributes']['product_id'];
                                $pr = \App\Models\Content::find($pid);
                            @endphp
                            <div class="item border-b py-4  relative">
                                <div class="">
                                    <div class="mr-0">
                                        <a target="__blank" href="{{ url($pr->slug) }}">
                                            @if ($content['attributes']['image'])
                                                <img class="rounded max-h-20"
                                                    src="{{ image_or_placeholder($content['attributes']['image']) }}" alt="">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="pr-5">
                                        <div class=" text-sm">
                                            @if (isset($pr['attr']['in-stock']) && $pr['attr']['in-stock'] == 1)
                                                <span class="text-slate-400">قیمت:</span>
                                            @else
                                                <span class="text-slate-400">بیعانه:</span>
                                            @endif
                                            @convertCurrency($content['price']) @lang('messages.toman')
                                        </div>
                                        <div class="text-slate-600 text-sm">
                                            <span class="text-slate-400">وزن:</span>
                                            {{ $pr['attr']['weight'] }}g
                                        </div>


                                        @if (isset($pr['attr']['in-stock']) && $pr['attr']['in-stock'] == 1)
                                            <p class="flex justify-start"><svg class="w-5 fill-lime-950"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                    aria-hidden="true" class="nu rw uk axs">
                                                    <path fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                        clip-rule="evenodd"></path>
                                                </svg> <span>موجود می باشد</span></p>
                                        @endif

                                    </div>
                                    <div class="bg-gray hidden ">
                                        <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                            @csrf
                                            <input type="hidden" name="count" value="1">
                                            <button class="py-0"><i class="fa fa-plus"></i></button>
                                        </form>
                                        {{ $content['quantity'] }}
                                        <form method="post" action="{{ route('customer.cart.update', $content['id']) }}">
                                            @csrf
                                            <input type="hidden" name="count" value="-1">
                                            <button class="py-0"><i class="fa fa-minus"></i></button>
                                        </form>

                                    </div>
                                </div>

                                @if (isset($content['attributes']['in-stock']) && $content['attributes']['in-stock'] == 0)
                                    <div class=" bg-yellow-100 border rounded-sm mt-2">
                                        <p class="text-sm p-1">وزن دقیق و قیمت نهایی بعد از ساخت که ۷ الی ۱۰ روز کاری زمان
                                            می برد مشخص می شود.
                                            این مبلغ به عنوان بیعانه دریافت می شود</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="border-t-2 border-gray-400 mt-2 pt-2 px-3 text-sm ">
                            <div class="flex justify-between font-bold text-base">
                                <span>مبلغ کل فاکتور:</span>
                                <span>@convertCurrency($order->total_price) تومان</span>
                            </div>
                            <div class="flex justify-between">
                                <span>مبلغ به طلا:</span>
                                <span>قیمت روز طلا: {{ $orderDetail->first()->attributes['gold_price'] }}</span>
                                <span>{{ number_format($order->total_price / $orderDetail->first()->attributes['gold_price'], 3) }}
                                    گرم</span>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>

@endsection

@section('footer')
    <script>
        $('#copy-card').click(function (e) {
            e.preventDefault();
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val("6219861026729706").select();
            document.execCommand("copy");
            $temp.remove();
            alert('شماره کارت کپی شد');
        })

        $.each($(' .text-editor'), function (i, n) {
            $(this).append(
                '<i class="fa-edit far fa-edit mr-3 text-lg cursor-pointer"></i>'
            )
        });

        $('.text-editor').click(function () {
            var _editor = $('.profile-editor-modal input[type=text]');
            _editor.attr('name', '');
            $('.profile-editor-modal label').html('');
            var field = $(this).data('field');
            var label = $(this).data('label');
            var val = $(this).text();
            $('#edit-profile').modal('show');
            _editor.attr('name', field);
            if (['email', 'mobile', 'site', 'whatsapp', 'telegram', 'instagram'].includes(field)) {
                _editor.css('direction', 'ltr');
            } else {
                _editor.css('direction', 'rtl');
            }
            _editor.val(val);
            _editor.focus();
            $('.profile-editor-modal label').html(label);

        });

        $(function () {

            $('input[required]').on('invalid', function () {
                this.setCustomValidity('لطفا این فیلد را پر کنید.'); // پیام فارسی
            });

            $('input[required]').on('input', function () {
                this.setCustomValidity(''); // پاک کردن پیام خطا
            });


            // مدیریت رویداد کلیک بر روی دکمه سفارشی
            $('#customButton').on('click', function () {
                $('#fileInput').click(); // باز کردن فیلد ورودی فایل
            });

            $('#upload-bill').on('submit', function (e) {
                const files = $('#fileInput').prop('files');
                if (files.length === 0) {
                    e.preventDefault(); // جلوگیری از ارسال فرم
                    $('#errorMessage').text('لطفاً تصویر فیش واریزی را انتخاب نمایید.'); // نمایش پیام خطا
                }
            });

            // نمایش نام فایل‌های انتخاب شده
            $('#fileInput').on('change', function () {
                const files = $(this).prop('files');
                // const fileNames = Array.from(files).map(file => file.name).join(', '); // گرفتن نام فایل‌ها
                const fileCount = files.length;
                $('#fileName').text(`🮱 ${fileCount} فایل انتخاب شده `); // نمایش نام فایل‌ها

            });


            // $('#edit-profile form').submit(function(e) {

            //     e.preventDefault();

            //     $.ajax({
            //         type: "POST",
            //         dataType: "json",
            //         url: "{{ route('customer.profile.update') }}",
            //         data: {
            //             '_token': $('meta[name="_token"]').attr('content'),
            //             'data': $('#edit-profile form').serializeArray()
            //         },
            //         success: function(data) {
            //             $('#edit-profile').modal('hide');
            //             var span = $('span[data-field=' + data.data.name + ']')
            //             span.text(data.data.value);
            //             span.append('<i class="fa-edit far fa-edit  text-lg cursor-pointer"></i>');
            //             span.prev().remove();

            //             if ($('span.text-red-700').length > 0) {
            //                 $('form#upload-bill').hide();
            //                 $('form#upload-bill').next().show();
            //             } else {
            //                 $('form#upload-bill').show();
            //                 $('form#upload-bill').next().hide();
            //             }
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             if (xhr.status == 404) {
            //                 alert(JSON.parse(xhr.responseText).msg);
            //             }
            //         }

            //     });
            // });

            $('#edit-profile .close').on('click', function () {
                $('#edit-profile').modal('hide');
            })
        });
    </script>
    <!-- <div class="modal fade profile-editor-modal" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog   top-1/3 m-auto " role="document">
            <div class="modal-content">
                <div class="modal-body bg-slate-100">
                    <div class="img-container">
                        <div class="row">
                            <form>
                                <div class="col-xs-12 py-1 ">
                                    <div class="col-md-12 col-xs-12 flex gap-x-3 px-3 my-5">
                                        <label for="" class=" text-nowrap"></label>
                                        <input id="modalInput" type="text" name="" class="ring focus:ring-gray-500 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    {{-- <input type="submit" class="btn btn-info" value="@lang('messages.edit')"> --}}
                                    <button class="rounded border bg-blue-500 text-white p-1 px-3 font-normal">تایید</button>
                                    <a class="close px-4" href="#">@lang('messages.cancel')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection
