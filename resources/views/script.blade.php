@php($settings = app(\JeffersonGoncalves\TawkTo\Settings\TawkToSettings::class))

@if($settings->shouldRender())
    @php($user = $settings->identify_users ? auth()->user() : null)
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        @if(filled(data_get($user, 'email')))
        Tawk_API.visitor = { name: @js((string) data_get($user, 'name')), email: @js((string) data_get($user, 'email')) };
        @endif
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = "https://embed.tawk.to/" + @js($settings->property_id) + "/" + @js($settings->widget_id);
            s1.charset = "UTF-8";
            s1.setAttribute("crossorigin", "*");
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
