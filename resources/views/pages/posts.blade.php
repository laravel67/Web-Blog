<x-app-layout :title="$title">
    {{-- <div class="w-full text-center lg:p-24 mb-4 bg-cover rounded-xl p-5" style="background-image: url('{{ asset('storage/'.$banner) }}');">
        <h1 class="md:font-bold bg-gray-600 text-white rounded-xl px-4 p-1 md:text-normal sm:text-sm inline-block">
            {!! $title !!}
        </h1>
    </div> --}}

    <div class="w-full text-center lg:p-10 mb-4 bg-cover rounded-xl">
        <h1 class="md:font-bold bg-gray-600 text-white rounded-xl px-4 md:text-normal inline-block">
            {!! $title !!}
        </h1>
    </div>
    
    <!-- Berita -->
    <div class=" flex flex-col gap-5">
        @if ($posts->isNotEmpty())
            <x-card-post :items="$posts" />
        @else
            <p class="text-center">Not Found.</p>
        @endif
        {{ $posts->links() }}
    </div>
</x-app-layout>