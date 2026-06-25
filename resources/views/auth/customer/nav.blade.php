<link rel="stylesheet" href="{{ mix('panel/panel.css', env('TEMPLATE_NAME')) }}">


<div class="company-nav" style="position: relative">
    <div class="company-menu" style="position: absolute; right:60px; top:10px; font-weight: bold ">منوی پروفایل</div>
    <div class="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="[&>li]:border-b-1 [&>li]:last:border-b-0">

        <li>
            {{ Auth::user()->mobile ?? ''}}
        </li>


        @hasrole('company')
        <li class="{{ Request::is('customer/profile') ? 'active' : '' }}"><a href="{{ route('customer.profile') }}">
                {{ __('messages.profile') }}</a></li>
        @endrole



        <li class="{{ Request::is('customer/') ? 'active' : '' }} flex">
            <i class="fa fa-dashboard mt-2  text-gray-500"></i>
            <a class="no-border" href="{{ route('customer.dashboard') }}"> {{ __('messages.Dashboard') }}</a>
        </li>

        <li class="{{ Request::is('customer/cart') ? 'active' : '' }} flex">
            <i class="fa fa-cart-shopping mt-2  text-gray-500"></i>
            <a class="no-border" href="{{ route('customer.cart.list') }}"> {{ __('messages.cart') }}</a>
        </li>

        <li class="{{ Request::is('customer/orders') ? 'active' : '' }} flex">
            <i class="fa fa-receipt mt-2  text-gray-500"></i>
            <a href="{{ route('customer.order.list') }}">{{ __('messages.orders') }}</a>
        </li>

        <li class="{{ Request::is('customer/transaction') ? 'active' : '' }} flex">
            <i class="fa fa-dollar mt-2  text-gray-500"></i>
            <a class="no-border" href="{{ route('customer.transaction') }}"> {{ __('messages.transaction') }}</a>
        </li>


        <li class="{{ Request::is('customer/wallet') ? 'active' : '' }} flex">
            <i class="fa fa-wallet mt-2  text-gray-500"></i>
            <a class="no-border" href="{{ route('customer.wallet.list') }}"> کیف پول</a>
        </li>

        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class=" hover:text-white !m-0 !p-0  rounded-full  ">
                    <i class="fa fa-right-from-bracket"></i>
                    @lang('messages.logout')</button>
            </form>
        </li>
    </ul>
</div>

<style>
    @media (min-width:960px) {
        .company-menu {
            display: none
        }
    }
</style>



<script>
    $('.company-nav .burger').click(function () {
        $('.company-nav ul').slideToggle();
        $('.burger').children('span:last-child').toggleClass('hide');
        $('.burger').children('span:nth-child(1)').toggleClass('rotate1');
        $('.burger').children('span:nth-child(2)').toggleClass('rotate2');
    })
</script>
