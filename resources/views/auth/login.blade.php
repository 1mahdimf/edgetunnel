@extends('layout.app')
@section('title','ورود به حساب کاربری')







@section('page')





{{-- <div class=" min-w-fit w-full sm:w-2/3 md:w-[400px]  m-auto"> --}}

    {{-- <div class="col-span-full sm:col-span-8 sm:col-start-3 md:col-span-4 md:col-start-5 "> --}}

        <div class="w-full sm:w-2/3 md:w-[400px]  m-auto ">
            <div class="flex flex-col  items-center  p-3">
                <a href="/" itemprop="url" rel="home">
                    <div class="site">
                        <span class="valed">والد</span><span class="text-green-800 font-bold">یاد</span>
                    </div>
                    <div class="">تربیت کودک</div>
                </a>
            </div>

            <div class="flex flex-col bg-white mx-auto shadow rounded-lg p-3 border-t-4 border-t-cyan-400">

                <form id="login" method="POST" class="w-full " x-data="loginHandler()"
                    @submit.prevent="formTypeCheck('login') ? login :(formTypeCheck('register') ? register : lostPassword) ">
                    @csrf
                    <div class="flex flex-row mb-4" x-show="formTypeCheck('register')" x-cloak
                        <x-alpinejs.transition-1 />>
                    <div class="w-1/2"> <label for="fname"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                            نام</label>
                        <input type="text" id="fname" x-model="data.fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
            focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
                            required --}}>
                    </div>
                    <div class="w-1/2 mr-2 "> <label for="lname"
                            class="block  mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                            نام خانوادگی </label>
                        <input type="text" id="lname" x-model="data.lname" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
                            required --}}>
                    </div>
            </div>

            <div class="mb-4" <x-alpinejs.transition-1 />>
            <label for="phone" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
                شماره موبایل</label>
            <input type="phone" id="phone" x-model="data.phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :disabled="phoneDisabled" {{--
                pattern="(09){1}[0-9]{9}" required --}}>
        </div>


        <div class="mb-4" x-show="formTypeCheck('register')" x-cloak <x-alpinejs.transition-1 />>
        <label for="email" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">
            ایمیل</label>
        <input type="email" id="email" x-model="data.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- pattern="(09){1}[0-9]{9}"
            required --}}>
    </div>
    <div class="mb-4"
        x-show="formTypeCheck('login') ||  formTypeCheck('register') || formTypeCheck('lostPasswordStep2')"
        <x-alpinejs.transition-1 />>
    <div class="flex flex-row justify-between items-baseline">
        <label for="password" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">رمز
            عبور</label>

        <a href="#" @click="formTypeSet('lostPassword')" x-show="formTypeCheck('login')"
            class="flex flex-row  text-sm hover:text-purple-500">

            <x-heroicon::ms-arrow-path-rounded-square class="pl-1 w-5 h-5" />
            بازیابی رمز عبور
        </a>

    </div>

    <input type="password" id="password" x-model="data.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- required --}}>
</div>

<div class="mb-6" x-show="formTypeCheck('register') || formTypeCheck('lostPasswordStep2')" x-cloak
    <x-alpinejs.transition-1 />>
<label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">تکرار
    رمز
    عبور
</label>
<input type="password" id="password_confirmation" x-model="data.password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" {{-- required --}}>
</div>

<div class="otp mb-6" x-show="formTypeCheck('lostPasswordStep2')" x-cloak <x-alpinejs.transition-1 /> >
<label for="otp" class="mb-2 flex flex-row text-sm font-semibold text-gray-900 dark:text-white">
    <x-heroicon::o-hashtag class="h-6 w-6" />
    کد تایید
</label>
<input type="number" id="otp" x-model="data.otp"
    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
    {{-- pattern="(09){1}[0-9]{9}" required --}}>


</div>



<div x-show="formTypeCheck('login')" class="flex items-start mb-6">
    <div class="flex items-center h-5">
        <input id="remember" type="checkbox" x-model="data.remember" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300
                    dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" {{--
            required --}}>
    </div>
    <label for="remember" class="mr-2 text-sm font-medium text-gray-900 dark:text-gray-300">بخاطر
        بسپار</label>
</div>
<div class="flex justify-between items-center">
    <button type="submit"
        x-text="formTypeCheck('login')  ? loginButtonText : (formTypeCheck('lostPassword') || formTypeCheck('lostPasswordStep2')? lostPasswordButtonText : registerButtonText)"
        x-bind:disabled="loading"
        class=" text-white bg-blue-700/90 hover:bg-blue-700 hover:shadow-xl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow shadow-blue-500/10">
        ورود
    </button>

    <a href="#" @click="formTypeSet('register')" x-show="formTypeCheck('login')" class=" flex text-white bg-purple-600/80 hover:bg-purple-700 hover:shadow-xl focus:ring-4
                    focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-auto px-3 py-1.5
                    text-center dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800 shadow
                    shadow-purple-500/10">
        <x-heroicon::s-user-plus class="w-6 h-6" />
        ثبت نام
    </a>
    <a href="#" @click="formTypeSet('login')" x-show="formTypeCheck('register') || formTypeCheck('lostPassword')"
        x-cloak class=" flex text-white bg-purple-600/80 hover:bg-purple-700 hover:shadow-xl focus:ring-4
                focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-auto px-3 py-1.5
                text-center dark:bg-purple-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800 shadow
                shadow-purple-500/10">
        <x-heroicon::s-arrow-left-on-rectangle class="w-6 h-6" />
        ورود
    </a>
</div>



</form>




</div>





{{-- <div x-data="{show: true}" x-effect="setTimeout(() => show = false, 3000)" x-show="show">
    <p>
        $dispatch('notice', {type: 'success', text: 'آلرت ساکسس'});
    </p>
</div>
--}}
</div>

<script>
    function loginHandler() {
      return {
        data: {},
        formType:'login',
        phoneDisabled : false,
        loginButtonText:  "ورود",
        registerButtonText: "ثبت نام",
        lostPasswordButtonText: "بازیابی رمز عبور",
        loading: false,
        login() {
          this.data.formType = this.formType;
          this.data.phone,
          this.data.password,
          this.data.remember,  
          this.loginButtonText = "در حال ورود...";
          this.loading = true;
          vy_fetch(this.data,"{{ route('auth.loginWithPass') }}" )
            .then((data) => {
                notify(data.body,'success');
                setTimeout(()=> {document.location.href = data.data.url}, 1500);
                this.data = {} ;
                
            })
            .catch((err) => {
              notify(err.body,'error');

            })
            .finally(() => {
              this.loginButtonText = "ورود";
              this.loading = false;
            });
        },
        register() {
            this.data.formType = this.formType;
          this.data.phone ,
          this.data.password,
          this.registerButtonText = "لطفا صبر کنید...";
          this.loading = true;
          vy_fetch(this.data,"{{ route('auth.register') }}" )
            .then((data) => {
                notify(data.body,'success');
                setTimeout(()=> {document.location.href = data.data.url}, 1500);
                this.data = {} ;
            })
            .catch((err) => {
              notify(err.body,'error');

            })
            .finally(() => {
              this.registerButtonText = "ثبت نام";
              this.loading = false;
            });
        },
        lostPassword() {
            this.data.formType = this.formType;
          this.data.phone ;
          this.data.password  ;
          this.data.otp ;
          this.lostPasswordButtonText = "لطفا صبر کنید...";
          this.loading = true;

            vy_fetch(this.data,"{{ route('auth.lostPassword') }}" )
            .then((data) => {
                notify(data.body,'success');  
                if(['otpCreated','otpSentLimit'].includes(data.type)){
                  
                    this.lostPasswordButtonText = "تغییر رمزعبور";
this.formTypeSet('lostPasswordStep2');
this.phoneDisabled = true;
                } 
                if(data.type == "passwordChanged"){
                    this.phoneDisabled = false;
                    this.formTypeSet('login');
                    this.data = {} ;


                }             
            })
            .catch((err) => {
              notify(err.body,'error');

            })
            .finally(() => {
             this.lostPasswordButtonText = "بازیابی رمز عبور";
              this.loading = false;
            });
        },
        formTypeSet(type) {
          this.formType = type;
        },
        formTypeCheck(type) {
           return this.formType == type;
 
        },
   

      };
    }
 
</script>



@endsection