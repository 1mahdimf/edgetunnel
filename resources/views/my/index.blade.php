@extends('layout.app')
@section('title','حساب کاربری')



@section('rightSidebar')
<x-layout.body.sideBarItem>
    <x-slot:title>
        Heading
        </x-slot>

        Content


</x-layout.body.sideBarItem>

@endsection




@section('page')
<x-layout.body.contentItem>
    @section('myAccount')
    <x-slot:title>
        حساب کاربری
        </x-slot>


        مثلا محتوا
        @show

</x-layout.body.contentItem>
@endsection