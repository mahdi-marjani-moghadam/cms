<section class="wide " id="footer">
    <div class="container">
        <div class="flex one">
            <div class="right">
                <div>ویژن شرکت corepo</div>
                <div>
                    ایجاد پلتفرم تبلیغاتی و آگهی
                </div>
                <div>ساخته شده توسط <a target="_blanck" href="https://tarhoweb.com">طرح و وب</a></div>
            </div>

        </div>
    </div>
</section>

@yield('footer')
<script>
    var TEMPLATE_NAME = `{{ env('TEMPLATE_NAME') }}`;
</script>
<script src="{{ url('/main.js') }}"></script>
</body>
</html>
