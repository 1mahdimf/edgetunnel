<form id="login" method="POST" class="w-full" wire:submit.prevent="register">
    @csrf
    <div class="flex flex-row mb-4">
        <div class="w-1/2">
            <label for="fname" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                نام</label>
            <input type="text" id="fname" wire:model="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
                required --}}>
        </div>
        <div class="w-1/2 mr-2 "> <label for="lname"
                class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                نام خانوادگی </label>
            <input type="text" id="lname" wire:model="lname" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
                required --}}>
        </div>
    </div>

    <div class="mb-4">
        <label for="phone" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            شماره موبایل</label>
        <input type="phone" id="phone" wire:model.defer="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{--
                pattern="(09){1}[0-9]{9}" required --}}>

    </div>


    <div class="mb-4">
        <label for="email" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            ایمیل</label>
        <input type="email" id="email" wire:model="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
required --}}>
    </div>


    <div class="mb-4">
        <label for="password" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">رمز
            عبور</label>

        <input type="password" id="password" wire:model.defer="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- required --}}>
    </div>
    <div class="mb-6">
        <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">تکرار
            رمز
            عبور
        </label>
        <input type="password" id="password_confirmation" wire:model="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- required --}}>
    </div>

    <div class="otp mb-6">
        <label for="otp" class="mb-2 flex flex-row text-sm font-semibold text-gray-900 dark:text-white">
            <x-heroicon::o-hashtag class="h-6 w-6" />
            کد تایید
        </label>
        <input type="number" id="otp" wire:model="otp"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            {{-- pattern="(09){1}[0-9]{9}" required --}}>


    </div>



    <div class="flex items-center justify-between">
        <button type="submit"
            class=" text-white bg-blue-700/90 hover:bg-blue-700 hover:shadow-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow shadow-blue-500/10">
            ثبت نام
        </button>

        <a href="#" wire:click="$set('type', 'login')" class=" flex text-white bg-purple-600/80 hover:bg-purple-700 hover:shadow-xl focus:ring-4
                focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-auto px-3 py-1.5
                text-center dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800 shadow
                shadow-purple-500/10">
            <x-heroicon::s-arrow-left-on-rectangle class="w-6 h-6" />
            ورود
        </a>

    </div>




</form>