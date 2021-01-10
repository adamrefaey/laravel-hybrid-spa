<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        foreach (config('laravel-hybrid-spa.favicons') as $favicon) {
            $type = $favicon['type'];
            $sizes = $favicon['sizes'];
            $href = $favicon['href'];
            echo "<link rel='icon' type='{$type}' sizes='{$sizes}' href='{$href}'>";
        }
    @endphp

    @php
        foreach (config('laravel-hybrid-spa.stylesheets') as $stylesheet) {
            echo "<link href='{$stylesheet}' rel='stylesheet'>";
        }
    @endphp

    @php
        foreach (config('laravel-hybrid-spa.scripts') as $script) {
            echo "<script src='{$script}'></script>";
        }
    @endphp

    {!! app('seotools')->generate(true) !!}
</head>

<body>
    <!-- js app element -->
    <div id='{{ config("laravel-hybrid-spa.js-app-id") }}'></div>

    <!-- Initial state -->
    <script>
        @php
            $shared_state_variable = config("laravel-hybrid-spa.shared-state-variable");
            $page_state_variable = config("laravel-hybrid-spa.page-state-variable");

            echo "window.{$shared_state_variable} = {$shared_state};";
            echo "window.{$page_state_variable} = {$page_state};";
            echo "window.__SKIP_LOADING_PAGE_STATE_ONCE__ = true;";

            echo "window.__SESSION_SUCCESS_MESSAGES__ = {$session_success_messages};";
            echo "window.__SESSION_ERROR_MESSAGES__ = {$session_error_messages};";
        @endphp
    </script>

    <!-- js app script -->
    <script src='{!! config("laravel-hybrid-spa.js-app-url") !!}'></script>
</body>

</html>
