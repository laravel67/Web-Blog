<x-app-layout :title="$title">
    <div class="w-full text-center p-24 mb-4 bg-cover rounded-xl p-5" style="background-image: url('{{ asset('storage/'.$banner) }}');">
        <h1 class="font-bold bg-primary text-white rounded-xl px-4 p-1 text-2xl inline-block">
            {{ $title }}
        </h1>
    </div>
    
    <!-- Berita -->
    <div class=" flex flex-col gap-5">
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
            @forelse ($posts as $post)
            <a href="{{ route('post', $post->slug) }}">
                <div
                    class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
                    <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                        {{ $post->category->name }}
                    </div>
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="w-full rounded-xl mb-3">
                    <p class="font-bold text-base mb-1">{{$post->title}}</p>
                    <p class="text-slate-400">
                        {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </a>
            @empty
            @endforelse
        </div>
    </div>
</x-app-layout>