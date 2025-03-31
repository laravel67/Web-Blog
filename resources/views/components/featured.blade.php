<div class="flex flex-col my-10 justify-center">
    <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
            <p>Berita Unggulan</p>
        </div>
        <a href="{{ route('posts.featured') }}"
            class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
            Lihat Semua
        </a>
    </div>
    <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @forelse ($posts as $post)
        <a href="{{ route('post', $post->slug) }}" class="mb-5">
            <div
                class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
                <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                    {{ $post->category->name }}
                </div>
                <img src="{{ asset('storage/'. $post->image) }}" alt="" class="w-full rounded-xl  mb-3">
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