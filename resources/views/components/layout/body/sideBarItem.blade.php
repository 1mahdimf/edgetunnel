@props([
'title',
'footer',
])

<div {{ $attributes->class(['bg-white','rounded-md','shadow','p-2','mb-2','last:mb-0']) }}>
    <h1 {{ $title->attributes->class(['text-lg','font-bold']) }}>
        {{ $title }}
    </h1>

    {{ $slot }}

    @isset($footer)
    <footer {{ $footer->attributes->class(['text-gray-700']) }}>
        {{ $footer }}
    </footer>
    @endisset



</div>