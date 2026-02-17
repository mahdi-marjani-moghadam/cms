<script>
    $(window).ready(function () {
        $('.filter-menu').click(function (e) {
            $('.filter-items').css('right', 0);
            $('.filter-items').prepend('<a class="close-filter">بستن فیلتر</a>');
            $("body").css("overflow", "hidden");

        });

        $('.filter-header').click(function () {
            $(this).next().slideToggle();
        });

        $('body').on('click', '.close-filter', function () {
            $('.filter-items').css("right", '-100%');
            $('.close-filter').remove();
            $("body").css("overflow", "");

        });


    });
</script>


<a href="javascript:void(0);" rel="nofollow" class="filter-menu !py-2  mb-3 font-09 ">
    <span>
        <span></span>
        <span></span>
        <span></span>
    </span>
فیلتر

    @if (request()->min_price || request()->max_price)
    <span class="ring px-2 rounded-full mr-5 font-09 text-gray-500">حدود قیمت
         @if (request()->min_price > 0)
             از {{ request()->min_price }}
         @endif
          تا {{ request()->max_price }} میلیون تومان</span>
    @else
    قیمت
          @endif
</a>
@php /*
@if (count($filterList['removeFilter']))
    <div class="px-3 mb-2">
        <div class="  filter-remote-link ">
            @foreach ($filterList['removeFilter'] as $key => $filterItem)
                <a class="bg-white  after:text-red-500  hover:border-b-red-500  border border-gray-300     !text-gray-500   after:rounded-full  !overflow-hidden !rounded"
                    href="{{ $filterItem->url }}">{{ $filterItem->name }} </a>
            @endforeach
        </div>
    </div>
@endif
*/ @endphp




<div class="flex one  filter-items py-0 px-3 w-f">


    <div class="toc1 shadow ">
        <a class="filter-header p-3" href="#جستجو">جستجو</a>
        <div class="filter-items-list  pt-5 pb-4">
            <form method="GET" action="" class="flex items-center justify-center">
                <input type="hidden" name="min_price" value="{{ request()->min_price }}">
                <input type="hidden" name="max_price" value="{{ request()->max_price }}">

                <input class="m-0 h-10 px-2 py-0" type="" name="q" value="{{ app('request')->q }}">
                <button
                    class="m-0 h-10 px-4 !py-1 bg-blue2 text-xs !rounded-r-none hover:bg-blue-800 hover:shadow">جستجو</button>
            </form>
        </div>
    </div>
    <div class="toc1 shadow ">
        <a class="filter-header p-3" href="#قیمت">قیمت</a>
        <div class="filter-items-list pt-5 pb-4">
            @include(@env('TEMPLATE_NAME') . '.cms.filterPrice')
        </div>
    </div>

    @php /*
   @if (count($filterList['filter']))
       @foreach ($filterList['filter'] as $key => $filterItem)
           <div class="toc1 shadow mt-1 ">
               <a class="filter-header p-3" href="#{{ $filterItem->label }}">{{ $filterItem->label }}</a>
               <div class="filter-items-list">

                   @foreach ($filterItem->ComboFields as $key2 => $filterOption)

                       <div class="toc1 px-2">
                           @if ($filterOption->check == 'checked')
                               <a href="{{ $filterOption->url }}">🮱 {{ $filterOption->name }}</a>
                           @else
                               <a class="block" href="{{ $filterOption->url }}"> ⬜ {{ $filterOption->name }}</a>
                           @endif
                           {{-- <input type="checkbox" name="vehicle3" value="Boat" {{ $filterOption['check'] }}> --}}
                       </div>
                   @endforeach
               </div>
           </div>
       @endforeach
   @endif
   */ @endphp

</div>
