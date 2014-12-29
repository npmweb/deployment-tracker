<!DOCTYPE html5>
<html>
    <head>
        @include('layouts._headtag')
    </head>
    <body id='{{ esc_for_attr($route_controller) }}' class='{{ esc_for_attr($route_method) }}'>
        @include('layouts._header')
        <div class="row">
            <div class="columns">
                @yield('content')
            </div>
        </div>
        @include('layouts._footer')
    </body>
</html>
