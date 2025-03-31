<x-app-layout :title="$title">
    <div class="flex flex-col mt-10">
        <div class="flex flex-col lg:flex-row w-full gap-20 justify-center">
            <!-- Berita Utama -->
            <div class="lg:w-8/12">
                <div class="font-bold text-xl lg:text-2xl mb-6 text-center lg:text-left">
                    <h1>{{$post->title}}</h1>
                </div>
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="w-full max-h-100 rounded-xl object-cover">
                <p class="text-slate-400 text-base mt-1">
                    {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                </p>
                <article class="prose mt-6 text-base lg:text-xl leading-relaxed text-justify">
                   {!! Str::replace('<pre>', '<pre><code>', Str::replace('</pre>', '</code></pre>', $post->content)) !!}
                </article>
            </div>
            <!-- Berita Terbaru -->
            <div class="lg:w-4/12 flex flex-col gap-10">
                <div class="sticky top-24 z-40">
                    <p class="font-bold mb-8 text-xl lg:text-2xl">Postingan Terkait</p>
                    <!-- Berita Card -->
                    <div class=" gap-5 flex flex-col">
                        @forelse ($relatedPosts as $post)
                            <a href="{{ route('post', $post->slug) }}">
                                <div class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl">
                                    <div class="flex gap-3 flex-col lg:flex-row">
                                        <img src="{{ asset('storage/'.$post->image) }}" alt="" class="max-h-16 rounded-xl object-cover">
                                        <div class="">
                                            <p class="font-semibold text-sm">{{$post->title}}</p>
                                            <p class="text-slate-400 mt-2 text-sm lg:text-xs">
                                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                        
                        @endforelse
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    <div class="flex flex-col gap-4 mb-10 p-4 w-full lg:w-2/3">
        <p class="font-semibold text-xl lg:text-2xl mb-2">Penulis</p>
        <a href="author.html">
            <div
                class="flex flex-col lg:flex-row gap-4 items-center border border-slate-300 rounded-xl p-6 lg:p-8 hover:border-primary transition">
                <img src="{{ asset('storage/'.$post->author->avatar) }}" alt="{{$post->author->name}}" class="rounded-full w-24 lg:w-28 border-2 border-primary">
                <div class="text-center lg:text-left">
                    <p class="font-bold text-lg lg:text-xl">{{$post->author->name}}</p>
                    <p class="text-sm lg:text-base leading-relaxed">
                        {{ $post->author->bio }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@push('css')
@once
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/github-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll("pre code").forEach((el) => {
                    hljs.highlightElement(el);
                });
            });
</script>
@endonce
@endpush
</x-app-layout>