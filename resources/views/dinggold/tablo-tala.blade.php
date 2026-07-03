<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تابلو طلا</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; overflow: hidden; font-family: Tahoma, Arial, sans-serif; }
        .container { display: flex; height: 100vh; }
        .price-panel { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #1a1a2e; color: #fff; padding: 2em; }
        .price-panel h1 { font-size: 1.5em; margin-bottom: 0.5em; color: #e2b714; }
        .price-value { font-size: 6em; font-weight: bold; margin: 0.3em 0; direction: ltr; }
        .price-label { font-size: 2.2em; color: #aaa; }
        .price-up { color: #4caf50; }
        .price-down { color: #f44336; }
        .update-time { margin-top: 1em; font-size: 2em; color: #888; display: flex; align-items: center; gap: 10px; }
        .live-dot { width: 14px; height: 14px; background: #4caf50; border-radius: 50%; display: inline-block; animation: blink 1s infinite; }
        @keyframes blink { 0%,100% { opacity: 1; } 50% { opacity: 0; } }
        .slider-panel { flex: 1; position: relative; overflow: hidden; background: #0f0f1a; }
        .slide { position: absolute; inset: 0; display: none; }
        .slide.active { display: flex; align-items: center; justify-content: center; }
        .slide img { width: 100%; height: 100%; object-fit: cover; }
        .slide-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 2em; color: #fff; text-align: center; }
        .slide-overlay h3 { font-size: 1.5em; margin-bottom: 0.3em; }
        .slide-overlay p { font-size: 1em; color: #e2b714; }
        .slider-dots { position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10; }
        .slider-dots span { width: 12px; height: 12px; border-radius: 50%; background: rgba(255,255,255,0.4); cursor: pointer; }
        .slider-dots span.active { background: #e2b714; }
        @media (max-width: 768px) {
            .container { flex-direction: column-reverse; }
            .price-value { font-size: 2.5em; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="price-panel">
        <h1 style="font-size: 3em;">قیمت طلا ۱۸ عیار</h1>
        <div class="price-value" id="gold-price">@convertCurrency($goldPrice['priceToman'])</div>
        <div class="price-label">تومان</div>
        <div class="update-time"><span class="live-dot"></span><span id="update-time">آخرین به‌روزرسانی: {{ now()->format('H:i:s') }}</span></div>
    </div>
    <div class="slider-panel" id="slider">
        @foreach ($products as $i => $product)
            <div class="slide {{ $i == 0 ? 'active' : '' }}" data-index="{{ $i }}">
                @php
                    $img = $product->images['images']['xlarge'] ?? $product->images['images']['medium'] ?? $product->images['images']['small'] ?? '';
                @endphp
                @if ($img)
                    <img src="{{ $img }}" alt="{{ $product->title }}">
                @endif
                <div class="slide-overlay">
                    <h3>{{ $product->title }}</h3>
                    @if (isset($product->attr['weight']))
                        <p>{{ $product->attr['weight'] }} گرم</p>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="slider-dots" id="slider-dots">
            @foreach ($products as $i => $product)
                <span class="{{ $i == 0 ? 'active' : '' }}" data-index="{{ $i }}"></span>
            @endforeach
        </div>
    </div>
</div>
<script>
    var currentSlide = 0;
    var slides = $('#slider .slide');
    var dots = $('#slider-dots span');
    var slideInterval = setInterval(nextSlide, 4000);

    function nextSlide() {
        slides.eq(currentSlide).removeClass('active');
        dots.eq(currentSlide).removeClass('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides.eq(currentSlide).addClass('active');
        dots.eq(currentSlide).addClass('active');
    }

    dots.click(function() {
        clearInterval(slideInterval);
        slides.eq(currentSlide).removeClass('active');
        dots.eq(currentSlide).removeClass('active');
        currentSlide = $(this).data('index');
        slides.eq(currentSlide).addClass('active');
        $(this).addClass('active');
        slideInterval = setInterval(nextSlide, 4000);
    });

    function updateGoldPrice() {
        $.get('{{ route("tablo.tala.price") }}', function(data) {
            var $price = $('#gold-price');
            var old = parseInt($price.text().replace(/,/g, ''));
            $price.text(data.price);
            if (old > 0) {
                $price.removeClass('price-down price-up');
                if (data.priceNum > old) $price.addClass('price-up');
                else if (data.priceNum < old) $price.addClass('price-down');
            }
            $('#update-time').text('آخرین به‌روزرسانی: ' + data.time);
        });
    }
    setInterval(updateGoldPrice, 120000); // 2minutes
</script>
</body>
</html>
