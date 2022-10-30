<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$setting->name}}</title>

    @include("layouts.frontend.style")
    <style>
        body {
            top: 0px !important;
            position: static !important;
        }

        .goog-te-banner-frame {
            display: none !important
        }
        .goog-te-gadget-simple{
            width: 70px !important;
            background-color: #283290 !important;
            padding: 2px !important;
            border: none !important;
        }
        .goog-te-gadget-simple img {
            display: none !important;
        }
        .goog-te-menu-value span{
            display: none;
        }
        .goog-te-menu-value span:first-child{
            display: block;
            text-align: center;
            color: white;
        }
    </style>

</head>

<body class="antialiased">
    @include("layouts.frontend.navbar")
    <main>
        @yield("content")
    </main>
    <!-- footer section -->
    @include("layouts.frontend.footer")

    @include("layouts.frontend.script")
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ 
                includedLanguages : 'en,bn',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
</body>

</html>