@extends('management.index')
@section('title','افزودن مطلب')


@section('page')
<x-layout.body.contentItem>
    <div class="w-1/2 mb-2">
        <label for="lname" class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            عنوان </label>
        <input type="text" id="lname" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="w-1/2 mb-2">
        <label for="lname" class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            پیوند یکتا </label>
        <input type="text" id="lname" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="w-1/2 mb-2">
        <label for="lname" class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            خلاصه متن</label>
        <textarea name="" id="" cols="30" rows="2" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

    </div>
    <div class="w-1/2 mb-2">
        <label for="lname" class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            متن</label>
        <textarea name="" id="" cols="30" rows="10" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

    </div>

    <div class="w-1/2 mb-2">
        <label for="lname" class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            موضوع</label>

        <select class="form-select appearance-none
        bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
        focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <button type="button"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Click
        me</button>

</x-layout.body.contentItem>
@endsection