<form id="login"  wire:submit.prevent="loginWithPass" >

    <div class="mb-4">
        <label for="phone" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            شماره موبایل</label>
        <input type="phone" id="phone" wire:model.defer="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{--
                pattern="(09){1}[0-9]{9}" required --}}>

    </div>


    <div class="mb-4">
        <div class="flex flex-row items-baseline justify-between">
            <label for="password" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">رمز
                عبور</label>

            <a href="#" wire:click="$set('type', 'forgetPass')" class="flex flex-row text-sm hover:text-purple-500">

                <x-heroicon::ms-arrow-path-rounded-square class="w-5 h-5 pl-1" />
                بازیابی رمز عبور
            </a>

        </div>

        <input type="password" id="password" wire:model.defer="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- required --}}>
    </div>

    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
            <input id="remember" type="checkbox" wire:model="remember" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" {{--
required --}}>
        </div>
        <label for="remember" class="mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">بخاطر
            بسپار</label>
    </div>




    <div class="flex items-center justify-between">
        <button type="submit" class=" text-white bg-blue-700/90 hover:bg-blue-700 hover:shadow-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow shadow-blue-500/10">
            ورود
        </button>

        <a href="#" wire:click="$set('type', 'register')" class=" flex text-white bg-purple-600/80 hover:bg-purple-700 hover:shadow-xl focus:ring-4
        focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-auto px-3 py-1.5
        text-center dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800 shadow
        shadow-purple-500/10">
            <x-heroicon::s-user-plus class="w-6 h-6" />
            ثبت نام
        </a>

    </div>




</form>