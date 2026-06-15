@extends('admin.layouts.app')

@section('footer')
@endsection

@section('content')
    @php
        $productsJson = $products->mapWithKeys(function ($p) {
            $images = $p->images['images'] ?? [];
            $image = $images['small'] ?? $images['medium'] ?? $images['large'] ?? '';
            $gp = $p->GoldPrice();
            return [$p->id => [
                'id'               => $p->id,
                'title'            => $p->title,
                'slug'             => $p->slug,
                'image'            => $image,
                'gold_price_gram'  => $gp['goldprice']      ?? 0,
                'weight'           => (float) ($p->attr['weight']          ?? 0),
                'additional_price' => (int)   ($p->attr['additionalprice'] ?? 0),
                'ojrat_percent'    => (float) ($p->attr['ojrat']           ?? 13),
                'sood_percent'     => 7,
                'total_price'      => $gp['totalPrice'] ?? 0,
            ]];
        });
    @endphp

    <div class="content-control">
        <ul class="breadcrumb">
            <li class="active"><a href="{{ route('admin.order.index') }}">@lang('messages.order')</a></li>
            <li class="active">@lang('messages.add')</li>
        </ul>
    </div>

    <div class="content-body">
        <div class="panel panel-default pos-abs chat-panel bottom-0">
            <div class="panel-body full-height">

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.order.store') }}" method="POST" id="order-form">
                    @csrf

                    <div class="row">

                        <div class="col-md-3 col-sm-3 form-group">@lang('messages.name'):
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                        <div class="col-md-3 col-sm-3 form-group">@lang('messages.mobile'):
                            <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" />
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        </div>

                        <div class="col-md-3 col-sm-3 form-group">کد پستی:
                            <input class="form-control" name="zipcode" type="text" value="{{ old('zipcode') }}">
                        </div>

                        <div class="col-md-3 col-sm-3 form-group">@lang('messages.address'):
                            <input class="form-control" name="address" type="text" value="{{ old('address') }}">
                        </div>

                        <div class="col-md-6 col-sm-8 form-group">
                            <label>محصول: (قیمت روز طلا: @convertCurrency(getGoldPrice()['priceToman']) تومان)</label>
                            <div style="display:flex; gap:6px; align-items:center;">
                                <div style="flex:1;">
                                    <select id="product" style="width:100%">
                                        @foreach ($products as $p)
                                            <option value="{{ $p->id }}">{!! $p->title !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="number" id="product-count" value="1" min="1"
                                    class="form-control" style="width:75px" placeholder="تعداد">
                                <button type="button" id="product-add-btn" class="btn btn-success">
                                    <i class="fa fa-plus"></i> افزودن
                                </button>
                            </div>
                            <span id="product-error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-12 col-md-12" >
                            <table class="table table-striped" id="products-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد</th>
                                        <th>@lang('messages.image')</th>
                                        <th>@lang('messages.title')</th>
                                        <th>وزن (گرم)</th>
                                        <th>اجرت%</th>
                                        <th>سود%</th>
                                        <th>قیمت اضافه (تومان)</th>
                                        <th>قیمت واحد (تومان)</th>
                                        <th>تعداد</th>
                                        <th>جمع</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody id="products-tbody">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10" style="font-weight:bold; text-align:right;">مبلغ کل:</td>
                                        <td colspan="2" style="white-space:nowrap;">
                                            <input type="text" id="total-price-display"
                                                value="0" class="form-control"
                                                style="width:160px; display:inline-block; font-weight:bold; font-size:1.1em;">
                                            <input type="hidden" id="total-price-input" name="total_price" value="0">
                                            @lang('messages.toman')
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <span id="products-required-error" class="text-danger"></span>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <label class="col-form-label text-md-left">@lang('messages.status'):</label>
                            <select class="form-control" name="status">
                                <option value="0">ثبت شده</option>
                                <option value="-1">رد شد</option>
                                <option value="1">ارسال به بانک</option>
                                <option value="2">آپلود فیش</option>
                                <option value="3">@lang('messages.paid successfully')</option>
                                <option value="4">@lang('messages.prepairing')</option>
                                <option value="5">@lang('messages.ready to send')</option>
                            </select>
                        </div>

                    </div>

                    <div id="hidden-products-container"></div>

                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success @if (!$ltr) pull-right @endif mat-btn">
                                ثبت نهایی
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        var productsMap = @json($productsJson);
        var productIndex = 0;

        function formatNumber(n) {
            return parseInt(n || 0).toLocaleString('en-US');
        }

        /* Mirrors the PHP calcuteGoldPrice logic */
        function calcPrice(goldPriceGram, weight, ojratPct, soodPct, additionalPrice) {
            var gold   = goldPriceGram * weight;
            var ojrat  = gold * ojratPct / 100;
            var sood   = (gold + ojrat) * (soodPct / 100);
            var tax    = (sood + ojrat) * 0.1;
            return Math.floor((gold + sood + ojrat + tax + additionalPrice) / 1000) * 1000;
        }

        function recalcRow($tr) {
            var p            = productsMap[$tr.data('product-id')];
            var ojratPct        = parseFloat($tr.find('.ojrat-input').val())       || 0;
            var soodPct         = parseFloat($tr.find('.sood-input').val())        || 0;
            var additionalPrice = parseInt($tr.find('.additional-price-input').val()) || 0;
            var count           = parseInt($tr.find('.count-input').val())         || 1;
            var unitPrice       = calcPrice(p.gold_price_gram, p.weight, ojratPct, soodPct, additionalPrice);
            var rowTotal     = unitPrice * count;
            var idx          = $tr.data('index');

            $tr.data('unit-price', unitPrice);
            $tr.find('.unit-price-input').val(formatNumber(unitPrice));
            $tr.find('.row-total').text(formatNumber(rowTotal));
            $('.hidden-price-' + idx).val(unitPrice);
            $('.hidden-count-' + idx).val(count);
            updateTotal();
        }

        function updateTotal() {
            var total = 0;
            $('#products-tbody tr').each(function () {
                var unitPrice = parseInt($(this).data('unit-price')) || 0;
                var count     = parseInt($(this).find('.count-input').val()) || 1;
                total += unitPrice * count;
            });
            $('#total-price-display').val(formatNumber(total));
            $('#total-price-input').val(total);
        }

        $(document).ready(function () {

            $('#product').select2();

            $('#product-add-btn').on('click', function () {
                var productId = $('#product').val();
                var count     = parseInt($('#product-count').val()) || 1;
                var product   = productsMap[productId];

                if (!product) {
                    $('#product-error').text('محصول یافت نشد');
                    return;
                }
                $('#product-error').text('');
                $('#products-required-error').text('');

                var idx       = productIndex++;
                var imgHtml   = product.image
                    ? '<img src="' + product.image + '" alt="" style="max-height:45px; border-radius:4px;">'
                    : '-';
                var unitPrice = product.total_price;
                var rowTotal  = unitPrice * count;

                var $row = $('<tr></tr>')
                    .attr('data-index', idx)
                    .attr('data-product-id', product.id)
                    .attr('data-unit-price', unitPrice)
                    .append('<td>' + (idx + 1) + '</td>')
                    .append('<td>' + product.id + '</td>')
                    .append('<td>' + imgHtml + '</td>')
                    .append('<td><a target="_blank" href="/' + product.slug + '">' + product.title + '</a></td>')
                    .append('<td>' + product.weight + '</td>')
                    .append(
                        '<td><input type="number" class="form-control ojrat-input" ' +
                        'value="' + product.ojrat_percent + '" min="0" step="0.1" style="width:70px;" data-idx="' + idx + '"></td>'
                    )
                    .append(
                        '<td><input type="number" class="form-control sood-input" ' +
                        'value="' + product.sood_percent + '" min="0" step="0.1" style="width:70px;" data-idx="' + idx + '"></td>'
                    )
                    .append(
                        '<td><input type="number" class="form-control additional-price-input" ' +
                        'value="' + product.additional_price + '" min="0" step="1000" style="width:100px;" data-idx="' + idx + '"></td>'
                    )
                    .append(
                        '<td><input type="text" class="form-control unit-price-input" ' +
                        'value="' + formatNumber(unitPrice) + '" style="width:130px; font-weight:bold;" data-idx="' + idx + '"></td>'
                    )
                    .append(
                        '<td><input type="number" class="form-control count-input" ' +
                        'value="' + count + '" min="1" style="width:70px;" data-idx="' + idx + '"></td>'
                    )
                    .append('<td class="row-total">' + formatNumber(rowTotal) + '</td>')
                    .append(
                        '<td><button type="button" class="btn btn-danger btn-xs remove-product-btn" data-idx="' + idx + '">' +
                        '<i class="fa fa-trash"></i></button></td>'
                    );

                $('#products-tbody').append($row);

                var titleEscaped = product.title.replace(/"/g, '&quot;');
                $('#hidden-products-container').append(
                    '<input type="hidden" name="products[' + idx + '][product_id]" value="' + product.id + '">' +
                    '<input type="hidden" name="products[' + idx + '][title]"      value="' + titleEscaped + '">' +
                    '<input type="hidden" name="products[' + idx + '][price]"      value="' + unitPrice + '" class="hidden-price-' + idx + '">' +
                    '<input type="hidden" name="products[' + idx + '][count]"      value="' + count + '"     class="hidden-count-' + idx + '">'
                );

                updateTotal();
            });

            $('#products-tbody').on('click', '.remove-product-btn', function () {
                var idx = $(this).data('idx');
                $(this).closest('tr').remove();
                $('#hidden-products-container').find('[name^="products[' + idx + ']"]').remove();
                updateTotal();
            });

            $('#products-tbody').on('change input', '.ojrat-input, .sood-input, .additional-price-input, .count-input', function () {
                recalcRow($(this).closest('tr'));
            });

            /* direct unit-price edit: format on blur, sync row total + grand total */
            $('#products-tbody').on('blur', '.unit-price-input', function () {
                var $tr      = $(this).closest('tr');
                var idx      = $tr.data('index');
                var raw      = parseInt($(this).val().replace(/,/g, '')) || 0;
                var count    = parseInt($tr.find('.count-input').val()) || 1;
                $(this).val(formatNumber(raw));
                $tr.data('unit-price', raw);
                $tr.find('.row-total').text(formatNumber(raw * count));
                $('.hidden-price-' + idx).val(raw);
                updateTotal();
            });

            /* manual override: strip commas → sync to hidden input, reformat on blur */
            $('#total-price-display').on('input', function () {
                var raw = parseInt($(this).val().replace(/,/g, '')) || 0;
                $('#total-price-input').val(raw);
            }).on('blur', function () {
                var raw = parseInt($(this).val().replace(/,/g, '')) || 0;
                $(this).val(formatNumber(raw));
                $('#total-price-input').val(raw);
            });

            $('#order-form').on('submit', function (e) {
                if ($('#products-tbody tr').length === 0) {
                    e.preventDefault();
                    $('#products-required-error').text('حداقل یک محصول اضافه کنید.');
                }
            });

        });
    </script>
@endsection
