@php
use Illuminate\Support\Str;
@endphp
<a href="{{ route('post',$item->slug) }}"
    class="relative col-span-5 flex flex-col h-fit md:flex-row gap-1 border-slate-200 p-2 rounded-xl hover:border hover:border-primary hover:cursor-pointer
    transition-all duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg
    ">
    <div class="bg-primary text-white rounded-full w-fit px-3 py-1 font-normal ml-2 mt-1 absolute text-sm">
        {{ $item->category->name }}
    </div>
    <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://placehold.co/300x200?text=NoImage' }}"
        alt="{{ $item->title }}" class="rounded-xl md:w-48 md:max-h-48 sm:w-100">
    <div class="mt-1 md:mt-0">
        <h2 class="font-semibold text-lg">
            {{ $item->title }}
        </h2>
        <p class="text-slate-400 mt-1 text-sm font-normal">
            {!! Str::limit($item->content, 50, '...') !!}
        </p>
        <p class="text-slate-400 text-base mt-0.5">
            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
        </p>
    </div>
</a>