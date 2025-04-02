@props(['label'=>'', 'href'=>'' ,'text'=>''])
<div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
    <div class="font-bold text-2xl text-center md:text-left">
        <p>{{$label}}</p>
    </div>
    <a href="{{ $href }}"
        class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
        {{ $text }}
    </a>
</div>  