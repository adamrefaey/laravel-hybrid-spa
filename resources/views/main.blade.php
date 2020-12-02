<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @php
        foreach (config('laravel-hybrid.favicons') as $favicon) {
            $type = $favicon['type'];
            $sizes = $favicon['sizes'];
            $href = $favicon['href'];
            echo "<link rel='icon' type='{$type}' sizes='{$sizes}' href='{$href}'>";
        }
    @endphp

    {!! SEO::generate(true) !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{!! url('') !!}">
    <meta name="base-locale" content="{{ app()->getLocale() }}">
</head>

<body>
    <!-- Vue app element -->
    <div id="app"></div>

    <!-- Initial state -->
    <script>
        window.__SHARED_STATE__ = {!! $shared_state !!};
        window.__PAGE_STATE__ = {!! $page_state !!};

        window.__SUCCESS_MESSAGES__ = {!! $initial_success_messages !!};
        window.__ERROR_MESSAGES__ = {!! $initial_error_messages !!};
    </script>

    <!-- Vue app script -->
    <script defer src="{!! config('laravel-hybrid.vue-app-url') !!}"></script>
</body>

</html>
