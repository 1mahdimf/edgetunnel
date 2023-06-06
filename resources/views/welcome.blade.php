@extends('layout.app')
@section('title','نننننن')



{{-- @section('rightSidebar')
<x-layout.body.sideBarItem>
    <x-slot:title>
        Heading
        </x-slot>

        Content


</x-layout.body.sideBarItem>
<x-layout.body.sideBarItem>
    <x-slot:title>
        Heading
        </x-slot>

        Content


</x-layout.body.sideBarItem>
@endsection


@section('leftSidebar')
<x-layout.body.sideBarItem>
    <x-slot:title>
        Heading
        </x-slot>

        Content


</x-layout.body.sideBarItem>
<x-layout.body.sideBarItem>
    <x-slot:title>
        Heading
        </x-slot>

        Content


</x-layout.body.sideBarItem>
@endsection
 --}}


@section('page')

<div class="w-full sm:w-2/3 md:w-[400px]  m-auto ">

    <div class="flex flex-col items-center p-3">
        <a href="/" itemprop="url" rel="home">
            <div class="site">
                <span class="valed">والد</span><span class="font-bold text-green-800">یاد</span>
            </div>
            <div class="">تربیت کودک</div>
        </a>
    </div>

    <div class="flex flex-col p-3 mx-auto bg-white border-t-4 rounded-lg shadow border-t-cyan-400">



        @livewire('auth.login')



    </div>

</div>

@endsection