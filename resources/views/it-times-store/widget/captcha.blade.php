<div class="mb-3">
    <label for="captcha">کد امنیتی</label>
    <div class="flex flex-nowrap! align-items-center gap-2">
        <input id="captcha" type="text" name="captcha" class="rounded h-10 px-2 w-32! focus:border-gray-400 ltr " required>
        <span id="captcha-img" class="">{!! captcha_img() !!}</span>
        <span type="button" class="cursor-pointer  flex-1/5! px-2! py-0! text-2xl! justify-center flex align-middle" onclick="refreshCaptcha()">↻</span>
    </div>

     @error('captcha')
        <span class="red">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<script>
    function refreshCaptcha() {
        fetch('/reload-captcha')
            .then(res => res.json())
            .then(data => {
                document.getElementById('captcha-img').innerHTML = data.captcha;
                document.querySelector('input[name="captcha"]').value = '';
            });
    }
</script>
