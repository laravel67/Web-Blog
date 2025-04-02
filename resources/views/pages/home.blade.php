@php
use Illuminate\Support\Str;
@endphp
<x-app-layout :title="$title">
<x-banner/>
<x-featured/>

<div class="flex flex-col">
    <div class="flex flex-col md:flex-row w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
            <p>Latests</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
        @if ($posts[0])
        <div
            class="relative col-span-7 lg:row-span-3 p-3 rounded-xl hover:border hover:border-primary hover:cursor-pointer transition-all duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
            <a href="{{ route('post', $posts[0]->slug) }}">
                <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                    {{ $posts[0]->category->name }}
                </div>
                <div class="rounded-2xl overflow-hidden w-full h-80">
                    <img src="{{ $posts[0]->image ? asset('storage/'.$posts[0]->image) :'https://placehold.co/600x350?text=NoImage' }}"
                        alt="{{ $posts[0]->title }}" class="w-full h-full object-cover">
                </div>
                <p class="font-bold text-xl mt-3">{{ $posts[0]->title }} </p>
                <p class="text-slate-400 text-base mt-1">
                    {!! Str::limit($posts[0]->content, 200, '...') !!}
                </p>
                <p class="text-slate-400 text-base mt-1">
                {{ \Carbon\Carbon::parse($posts[0]->created_at)->translatedFormat('d F Y') }}
                </p>
            </a>
        </div>
            
        @else
            
        @endif

        @forelse ($posts->skip(1) as $post)
            <x-card-side :item="$post"/>
        @empty
        @endforelse
    </div>
</div>

<!-- Author -->
<div class="flex flex-col my-10">
    <x-section-head label="Author" href="/admin/register" text="Join As Author" />
    <div class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @forelse ($authors as $author)
        <a href="{{ route('posts.author', $author->username) }}">
            <div class="flex flex-col items-center border-slate-200 px-4 py-8 rounded-2xl 
                        hover:bg-primary hover:text-white hover:cursor-pointer 
                        transition-all duration-200 ease-in-out transform hover:scale-105 hover:shadow-lg">
                <x-avatar :img="$author->avatar_url" :alt="$author->name" class="rounded-full w-24 h-24" />
                <p class="font-bold text-xl mt-4">{{$author->name}}</p>
                <p class="text-slate-400 group-hover:text-white transition-all duration-300">{{ $author->posts->count() }} Berita
                </p>
            </div>
        </a>
        @empty
        @endforelse
    </div>
</div>
<x-populer/>
</x-app-layout>