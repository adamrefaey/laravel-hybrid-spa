<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" type="image/x-icon" href="{{ url('assets/site/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('assets/site/favicon@2x.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/site/favicon.png') }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <title>{{ $page_title }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{!! url('') !!}">
    <meta name="base-locale" content="{{ app()->getLocale() }}">
</head>

<body>
    @php
        // if this is a crawler, print the page state content to be rendered immediately
        $crawlerDetect = new \Jaybizzle\CrawlerDetect\CrawlerDetect();
        if($crawlerDetect->isCrawler()) {
            echo $seo_content;
        }
    @endphp

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
    <script defer src='{!! url("app.js") !!}'></script>
</body>

</html>
