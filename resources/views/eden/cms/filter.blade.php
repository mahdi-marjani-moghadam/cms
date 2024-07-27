
<script>
    $(window).ready(function() {
        $('.filter-menu').click(function(e) {
            $('.filter-items').css('right', 0);
            $('.filter-items').prepend('<a class="close-filter">بستن فیلتر</a>');
            $("body").css("overflow", "hidden");

        });

        $('.filter-header').click(function() {
            $(this).next().slideToggle();
        });

        $('body').on('click', '.close-filter', function() {
            $('.filter-items').css("right", '-100%');
            $('.close-filter').remove();
            $("body").css("overflow", "");

        });


    });
</script>


@if (count($filterList['filter']))
    <a href="javascript:void(0);" rel="nofollow" class="filter-menu mb-3">
        <span>
            <span></span>
            <span></span>
            <span></span>
        </span>
        لیست فیلتر ها
    </a>
@endif
@if (count($filterList['removeFilter']))
    <div class="px-3 mb-2">
        <div class="  filter-remote-link ">
            @foreach ($filterList['removeFilter'] as $key => $filterItem)
                <a class="bg-white  after:text-red-500  hover:border-b-red-500  border border-gray-300     !text-gray-500   after:rounded-full  !overflow-hidden !rounded" href="{{ $filterItem->url }}">{{ $filterItem->name }} </a>
            @endforeach
        </div>
    </div>
@endif





<div class="flex one  filter-items py-0 px-3 w-f">

    <div class="toc1 shadow ">
        <a class="filter-header p-3" href="#قیمت">قیمت</a>
        <div class="filter-items-list pt-5 pb-4">
            @include(@env('TEMPLATE_NAME') . '.cms.filterPrice')
        </div>
    </div>
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
</div>
