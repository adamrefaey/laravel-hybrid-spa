<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        foreach (config('laravel-hybrid.favicons') as $favicon) {
            $type = $favicon['type'];
            $sizes = $favicon['sizes'];
            $href = $favicon['href'];
            echo "<link rel='icon' type='{$type}' sizes='{$sizes}' href='{$href}'>";
        }
    @endphp

    {!! app('seotools')->generate(true) !!}
</head>

<body>
    <!-- js app element -->
    <div id='{{ config("laravel-hybrid.js-app-id") }}'></div>

    <!-- Initial state -->
    <script>
        @php
            $shared_state_variable = config("laravel-hybrid.shared-state-variable");
            $page_state_variable = config("laravel-hybrid.page-state-variable");

            echo "window.{$shared_state_variable} = {$shared_state};";
            echo "window.{$page_state_variable} = {$page_state};";

            echo "window.__SESSION_SUCCESS_MESSAGES__ = {$session_success_messages};";
            echo "window.__SESSION_ERROR_MESSAGES__ = {$session_error_messages};";
        @endphp
    </script>

    <!-- js app script -->
    <script src='{!! config("laravel-hybrid.js-app-url") !!}'></script>
</body>

</html>
