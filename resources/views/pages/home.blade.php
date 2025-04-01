<x-app-layout :title="$title">
<x-banner/>

<!-- Berita Unggulan -->
<x-featured/>

<!-- Berita Terbaru -->
<div class="flex flex-col">
    <div class="flex flex-col md:flex-row w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
            <p>Berita Terbaru</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
        @if ($posts[0])
        <div
            class="relative col-span-7 lg:row-span-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
            <a href="{{ route('post', $posts[0]->slug) }}">
                <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
                    {{ $posts[0]->category->name }}
                </div>
                <img src="{{ asset('storage/'.$posts[0]->image) }}" alt="{{ $posts[0]->title }}" class="rounded-2xl w-full">
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
        <a href="detail-MotoGp.html"
            class="relative col-span-5 flex flex-col h-fit md:flex-row gap-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 absolute text-sm">
                {{ $post->category->name }}
            </div>
            <img src="img/Berita-Motor.png" alt="berita2" class="rounded-xl w-50 md:max-h-50">
            <div class="mt-2 md:mt-0">
                <p class="font-semibold text-lg">
                    {{ $post->title }}
                </p>
                <p class="text-slate-400 mt-3 text-sm font-normal">
                    {!! Str::limit($post->content, 150, '...') !!}
                </p>
                <p class="text-slate-400 text-base mt-1">
                    {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                </p>
            </div>
        </a>
        @empty  
        @endforelse
    </div>
</div>

<!-- Author -->
<div class="flex flex-col my-10">
    <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
            <p>Penulis</p>
        </div>
        <a href="/admin/register" class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
            Gabung Menjadi Penulis
        </a>
    </div>
    <div class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @forelse ($authors as $author)
        <a href="{{ route('posts.author', $author->username) }}">
            <div class="flex flex-col items-center border border-slate-200 px-4 py-8 rounded-2xl hover:border-primary hover:cursor-pointer">
                <x-avatar :img="$author->avatar_url" :alt="$author->name" class="rounded-full w-24 h-24"/>
                <p class="font-bold text-xl mt-4">{{$author->name}}</p>
                <p class="text-slate-400">{{ $author->posts->count() }} Berita</p>
            </div>
        </a>
        @empty
        @endforelse
    </div>
</div>

<!-- Pilihan Author -->
<x-populer/>
</x-app-layout>