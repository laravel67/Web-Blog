@props(['label'=>'', 'href'=>'' ,'text'=>''])
<div class="flex flex-col flex-row justify-between items-center w-full mb-6">
    <div class="font-bold md:text-2xl text-center md:text-left">
        <span>{{$label}}</span>
    </div>
    <a href="{{ $href }}"
        class="px-5 md:py-2 rounded-full md:text-1xl sm:text-sm text-primary font-semibold hover:underline h-fit">
        {{ $text }}
    </a>
</div>  