<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        .loading_wrap {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #FFF;
            display: block;
            position: absolute;
        }

        .loader_logo {
            height: 80px;
            width: 80px;
            position: absolute;
            left: calc(50% - 50px);
            top: 38%;
        }

        .loader_logo img {
            height: 100%;
            width: 100%;
        }

        .loading {

            border: 3px solid rgba(102, 51, 153, 0.45);
            position: absolute;
            left: calc(50% - 35px);
            top: 50%;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border-top-color: #663399;
            animation: loader 1s ease-in-out infinite;
            -webkit-animation: loader 1s ease-in-out infinite;
        }

        @keyframes loader {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes loader {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

    </style>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <!-- Scripts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<noscript>
    <strong>
        We're sorry but gull-vue doesn't work properly without JavaScript
        enabled. Please enable it to continue.</strong>
</noscript>


<!-- built files will be auto injected -->
<div class="loading_wrap" id="loading_wrap">
    <div class="loader_logo">
        <img src="{{ asset('images/logo.png') }}" class="" alt="logo">
      </div>

      <div class="loading"></div>
    </div>
<div id="app">Aguarde...</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
