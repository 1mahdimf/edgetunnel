<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
        @yield('title') |
        @endif
        والدیاد
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="//cdn.tailwindcss.com"></script>

    <script src="{{ asset('js/alpinejs.min.js') }}" defer></script>
    {{-- <script src="{{asset('js/toastr.min.js')}}" defer></script> --}}
    @livewireStyles
</head>