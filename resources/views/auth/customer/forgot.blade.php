@extends(@env('TEMPLATE_NAME').'.App')
@section('meta-title', __('messages.forgot'))

    @push('head')

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




            ///////////////////////////////////////////////////////////////////////////////
        </script>
    @endpush
@section('Content')
    <section class="reset">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @error('mobile')
            <span class="text-danger mb-2">
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </span>
        @enderror

            <h1>@lang('messages.forgot')</h1>
        <form method="POST"  id="forgot-password" action="{{ route('password.update') }}">
            @csrf

            <div class="form-group">
                <label for="mobile" class="control-label">@lang('messages.mobile')</label>
                <input id="mobile" type="mobile" class="h-10 rounded ltr w-full px-2 focus:border-gray-400 @error('mobile') is-invalid @enderror" name="mobile"
                    value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

            </div>

            <div class="form-group   mt-1 ">
                <div class=" center ">
                    @include(env('TEMPLATE_NAME').'.widget.captcha')

                    <button type="submit"  id="btn-loading" class="btn bg-blue-700 text-white!  btn-block">
                        @lang('messages.Send Password')
                    </button>
                </div>
            </div>
        </form>
    </section>
    <section class="extra-link">
        <div class=" m-0" style="margin: 0px !important">
            <a href="{{ route('login') }}">@lang('messages.login')</a>
            /
            <a href="{{ route('register') }}">@lang('messages.register')</a>

        </div>
        <a href="{{ route('customer.forgot.request') }}">@lang('messages.forgot')</a>
    </section>

@endsection
