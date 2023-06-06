<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<x-layout.head />


<body class="bg-gray-100/75 antialiased m-auto dark:bg-dark dark:text-light">

    <x-layout.header />


    <x-layout.body />

    <x-layout.footer />

    @livewireScripts
</body>

</html>