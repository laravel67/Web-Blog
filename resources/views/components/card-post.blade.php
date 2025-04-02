@php
use Illuminate\Support\Str;
@endphp
<div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
    @forelse ($items as $item)
        <a href="{{ route('post', $item->slug) }}">
            <div
                class="border-slate-200 p-3 rounded-xl hover:border hover:border-primary hover:cursor-pointer transition-all duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
                <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                {{ $item->category->name }}    
                </div>
                <img src="{{ $item->image ? asset('storage/'.$item->image ) : 'https://placehold.co/600x500?text=NoImage' }}" alt="{{ $item->title }}" class="w-full rounded-xl mb-3">
                <p class="font-bold text-base mb-1">
                    {{ $item->title }}
                </p>
                <p class="text-slate-400 mt-1 text-sm font-normal">
                    {!! Str::limit($item->content, 50, '...') !!}
                </p>
                <p class="text-slate-400">
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </p>
            </div>
        </a>
    @empty
    @endforelse
</div>