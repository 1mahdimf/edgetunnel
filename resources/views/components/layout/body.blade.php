<div id="main-container" class="flex flex-row gap-3  px-5 pb-4">

    @php
    if(trim($__env->yieldContent('rightSidebar')) && trim($__env->yieldContent('leftSidebar'))){
    $mainClass = "w-3/4";
    }elseif(trim($__env->yieldContent('rightSidebar')) || trim($__env->yieldContent('leftSidebar'))){
    $mainClass = "w-3/4";
    }else{
    $mainClass = "w-full";

    }
    @endphp


    @hasSection('rightSidebar')
    <aside class="w-1/4">

        @yield('rightSidebar')
    </aside>
    @endif


    @hasSection('page')
    <main class="{{$mainClass}}">

        @yield('page')
    </main>

    @endif





    @hasSection('leftSidebar')
    <aside class="w-1/4">

        @yield('leftSidebar')
    </aside>

    @endif

</div>