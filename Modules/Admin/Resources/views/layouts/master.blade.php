<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{isset($title)?$title:"Admin"}}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
    @livewireStyles
</head>
<body >
<input type="checkbox" class="hidden" id="lf-control" />
<div id="lf-container">
   <x-admin::header-bar />
    <div id="lf-content">
        <x-admin::menu />
        <div id="lf-page">
            <div id="lfp-content">
                <x-lf.page.header />
                {{$slot}}
            </div>
            <div id="lf-footer">
                <span class="flex-auto">Copyright © 2022 &nbsp <span class="text-teal-500 font-bold"> {{env("APP_NAME")}} </span>. All rights reserved.</span>
                <span class="flex-none">Version: {{lForm()->getVersion()}}</span>
            </div>
        </div>
        <label for="lf-control" id="lf-overlay"></label>
    </div>
</div>
@livewireScripts
@stack('scripts')
</body>
</html>
