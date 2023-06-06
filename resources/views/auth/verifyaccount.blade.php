@extends('layout.app')
@section('title', 'تایید حساب کاربری')

@section('body')

<div class="m-auto w-full min-w-fit sm:w-2/3 md:w-[400px]">
    <div
        class="mx-auto mb-4 flex flex-col rounded-lg border-r-4 border-r-fuchsia-400 bg-white p-1 align-baseline shadow">

        تایید حساب کاربری

    </div>
    <div class="mx-auto flex flex-col rounded-lg border-t-4 border-t-fuchsia-400 bg-white p-3 shadow">
        <form id="verifyAccount" method="POST" class="w-full" x-data="verifyPhone()">
            @if (!auth()->user()->hasVerifiedPhone())
            <div class="phone mb-4" x-show="phoneDispaly" <x-alpinejs.transition-1 />>
            <label for="phone" class="mb-2 flex flex-row text-sm font-semibold text-gray-900 dark:text-white">
                <x-heroicon::o-device-phone-mobile class="h-6 w-6" />
                شماره موبایل
            </label>
            <div class="relative flex items-center justify-end">
                <input type="tel" id="phone"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    value="{{ auth()->user()->phone }}" disabled {{-- pattern="(09){1}[0-9]{9}" required --}}>

                <button
                    class="absolute mr-2 w-auto rounded-tl-lg rounded-bl-lg bg-blue-700/90 px-1 py-[11px] text-center text-sm font-medium text-white shadow shadow-blue-500/10 hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-300"
                    x-html="phoneSubmitButton" :disabled="phoneDisabled" @click.prevent="phoneSubmit">
                    ارسال کد
                </button>

            </div>

    </div>
    @endif
    @if (!auth()->user()->hasVerifiedEmail())
    <div class="mb-4" x-show="{{ auth()->user()->hasVerifiedPhone() ? 'true': 'emailDispaly' }}" x-cloak
        <x-alpinejs.transition-1 />>
    <label for="email" class="mb-2 flex flex-row text-sm font-semibold text-gray-900 dark:text-white">
        <x-heroicon::o-at-symbol class="h-6 w-6" />
        ایمیل
    </label>
    <div class="relative flex items-center justify-end">
        <input type="text" id="email" value="{{ auth()->user()->email }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            {{-- pattern="(09){1}[0-9]{9}" required --}}>

        <button
            class="absolute mr-2 w-auto rounded-tl-lg rounded-bl-lg bg-blue-700/90 px-1 py-[11px] text-center text-sm font-medium text-white shadow shadow-blue-500/10 hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-300"
            x-html="emailSubmitButton" :disabled="emailDisabled" @click.prevent="emailSubmit">
            ارسال کد
        </button>

    </div>
</div>
@endif

<div class="otp mb-4" x-show="otpDispaly" x-cloak <x-alpinejs.transition-1 /> >
<label for="otp" class="mb-2 flex flex-row text-sm font-semibold text-gray-900 dark:text-white">
    <x-heroicon::o-hashtag class="h-6 w-6" />
    کد تایید
</label>
<div class="relative flex items-center justify-end">
    <input type="number" id="otp"
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
        {{-- pattern="(09){1}[0-9]{9}" required --}}>

    <button
        class="absolute mr-2 w-auto rounded-tl-lg rounded-bl-lg bg-blue-700/90 px-1 py-[11px] text-center text-sm font-medium text-white shadow shadow-blue-500/10 hover:bg-blue-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-300"
        x-html="otpSubmitButton" :disabled="otpDisabled" @click.prevent="otpSubmit">
        تایید
    </button>

</div>


</div>
</form>

</div>

</div>


<script>
    function verifyPhone() {

            return {
                data: {},
                otpType: null,
                phoneDispaly: true,
                emailDispaly: false,
                otpDispaly: false,
                phoneSubmitButton: "ارسال کد",
                emailSubmitButton: "ارسال کد",
                otpSubmitButton: "تایید",
                phoneDisabled: false,
                emailDisabled:false,
                otpDisabled: false,
                iconLoading: `<x-heroicon::s-arrow-path class="w-5 h-5 animate-spin " />`,
                phoneSubmit() {
                    this.otpType = "phone";
                    this.data.phone = document.getElementById('phone').value;
                    this.phoneButtonSet(this.iconLoading, true);
                    vy_fetch(this.data, "{{ route('auth.sendOtp') }}")
                        .then((data) => {
                            notify(data.body, 'success');
                            if (data.success) {
                                this.timer(timeLeft=> {this.phoneSubmitButton = timeLeft;
                    this.phoneDisabled = true;}, end => {
                        this.phoneSubmitButton = "ارسال کد";
                        this.phoneDisabled = false;
                                this.otpDispaly = false;
                            }, data.data.time);
                                this.otpDispaly = true;
                            }

                        })
                        .catch((err) => {
                            notify(err.body, 'error');
                            this.phoneSubmitButton = 'ارسال کد';
                           this.phoneDisabled = false;
                        })

                },
                emailSubmit() {
                    this.otpType = "email";
                    this.data.email = document.getElementById('email').value;
                    this.emailSubmitButton = this.iconLoading;
                    this.emailDisabled = true;
                    vy_fetch(this.data, "{{ route('auth.sendOtp') }}")
                        .then((data) => {
                            notify(data.body, 'success');
                            if (data.success) {

                                this.timer(timeLeft=> {this.emailSubmitButton = timeLeft;
                    this.emailDisabled = true;}, end => {
                        this.emailSubmitButton = "ارسال کد";
                        this.emailDisabled = false;
                                this.otpDispaly = false;
                            } ,data.data.time);
                                this.otpDispaly = true;
                            }

                        })
                        .catch((err) => {
                            notify(err.body, 'error');
                            this.emailSubmitButton = 'ارسال کد';
                           this.emailDisabled = false;
                        })

                },
                otpSubmit() {
                    this.data.otp = document.getElementById('otp').value;
                    this.data.otpType = this.otpType;
                    this.otpSubmitButton = this.iconLoading;
                    this.otpDisabled = true;
                    vy_fetch(this.data, "{{ route('auth.validateOtp') }}")
                        .then((data) => {
                            notify(data.body, 'success');
                            this.otpDispaly = false;
                            this.phoneDispaly = false;
                            if (data.data.redirect) {
                                setTimeout(() => {
                                    document.location.href = '/my'
                                }, 1000);
                            } else {
                                this.emailDispaly = ! this.emailDispaly;
                                this.otpSubmitButton = 'تایید';
                                this.otpDisabled = false;
                            }

                        })
                        .catch((err) => {
                            notify(err.body, 'error');
                            this.otpSubmitButton = 'تایید';
                            this.otpDisabled = false;
                        })
                },
                timer(timeLeft,end,time) {
                    vy_timer(timeLeft,end, new Date().getTime() +
                            time,
                            'm:s')
                        .init();

                },
                phoneButtonSet(text = 'ارسال کد', disabled = false) {
                    this.phoneSubmitButton = text;
                    this.phoneDisabled = disabled;
                },

            }

        }
</script>

@endsection