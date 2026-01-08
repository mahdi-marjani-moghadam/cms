@if ($detail->attr_type == 'product' && env('SHOP', false))
    <div class="order-form  ">
        @if (\Session::has('success'))
            <div class="alert alert-success ">
                {!! \Session::get('success') !!}
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger ">
                {!! \Session::get('error') !!}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif

        <div class="flex items-center">
            <form action="{{ route('customer.cart.store') }}" class="grow p-0 ml-0 mr-2" method="post">
                <input type="hidden" name="id" value="{{ $detail->id }}">
                @csrf
                <button class="bg-lime-700 !text-white   p-3 rounded-md !w-full">
                    <i class="fa fa-plus"></i>
                    ثبت سفارش
                </button>
            </form>
            <form class="mr-4 !p-0 !m-0 flex items-center !w-auto" target="__blank" action="/calc" method="post">
                @csrf
                <input name="tala" type="hidden" value="{{ (getGoldPrice()['priceToman'] / 1000) }}">
                <input name="weight" type="hidden" value="{{ $detail->attr['weight'] ?? 0 }}">
                <input name="ojrat" type="hidden" value="{{ $detail->attr['ojrat'] ?? 0 }}">
                <input name="sood" type="hidden" value="7">
                <input name="additionalPrice" type="hidden" value="{{ $detail->attr['additionalprice'] ?? 0 }}">
                <input name="tax" type="hidden" value="10">

                <button class="!p-0 !m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        id="_x32_" width="50px" height="50px" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <path fill="#999" class="st0"
                                d="M394.656,0H117.359C92.313,0,72,20.313,72,45.344v421.313C72,491.688,92.313,512,117.359,512h277.297   C419.703,512,440,491.688,440,466.656V45.344C440,20.313,419.703,0,394.656,0z M184,440h-48v-48h48V440z M184,360h-48v-48h48V360z    M184,280h-48v-48h48V280z M280,440h-48v-48h48V440z M280,360h-48v-48h48V360z M280,280h-48v-48h48V280z M376,440h-48V312h48V440z    M376,280h-48v-48h48V280z M376,160H136V80h240V160z" />
                        </g>

                    </svg>
                </button>
            </form>


        </div>
    </div>

@endif
