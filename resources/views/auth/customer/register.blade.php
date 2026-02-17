@extends(@env('TEMPLATE_NAME').'.App')

@section('meta-title', __('messages.register').' | درب کالا')
@section('meta-description','فرم ثبت نام ')


    @push('head')
        {{-- recaptcha --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

    @endpush
    @push('scripts')
        <script>
            //only number
            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {

                    textbox.addEventListener(event, function() {
                        this.value = this.value.replace('۰', '0');
                        this.value = this.value.replace('۱', '1');
                        this.value = this.value.replace('۲', '2');
                        this.value = this.value.replace('۳', '3');
                        this.value = this.value.replace('۴', '4');
                        this.value = this.value.replace('۵', '5');
                        this.value = this.value.replace('۶', '6');
                        this.value = this.value.replace('۷', '7');
                        this.value = this.value.replace('۸', '8');
                        this.value = this.value.replace('۹', '9');


                        if (inputFilter(this.value)) {
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {

                            this.value = this.oldValue;

                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);

                        } else {
                            this.value = "";

                        }
                    });
                });
            }

            setInputFilter(document.getElementById("mobile"), function(value) {
                return /^-?\d*$/.test(value);
            });


            setInputFilter(document.getElementById("password"), function(value) {
                return /$/.test(value);
            });


            ///////////////////////////////////////////////////////////////////////////////
        </script>

    @endpush

@section('Content')
    <section class="register">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
        <h1>@lang('messages.register')</h1>

        <form method="POST" action="">
            @csrf

            <div class="form-group row">
                <label for="mobile" class="col-md-12 col-form-label ">@lang('messages.mobile')</label>

                <div class="col-md-12">
                    <input id="mobile" type="tel" class="h-10 rounded ltr w-full px-2 focus:border-gray-400 ltr @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required
                        placeholder="{{ __('messages.example') }}:09331181877" autocomplete="mobile">

                    @error('mobile')
                        <span class="red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-1">
                <label for="password" class="col-md-12 col-form-label ">@lang('messages.password')</label>

                <div class="col-md-12">
                    <input id="password" type="text" autocomplete="off"  class="h-10 rounded ltr w-full px-2 focus:border-gray-400 @error('password') is-invalid @enderror"
                        name="password" required autocomplete="password">

                    @error('password')
                        <span class="red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>




            <div class="form-group row mb-0 mt-1">
                <div class="col-md-12 pull-right">

                    <button type="submit" id="btn-loading"  class="btn bg-blue-700 text-white!  btn-block  ">
                        @lang('messages.register')
                    </button>

                </div>
            </div>
        </form>
    </section>
    <section class="extra-link">
        <a href="{{ route('login') }}">@lang('messages.login')</a>

        <a href="{{ route('customer.forgot.request') }}">@lang('messages.forgot')</a>
    </section>

    <style>.red{color: red}</style>

@endsection
