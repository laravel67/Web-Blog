<x-app-layout :title="$title">
    <div class="w-full text-center p-24 mb-4 bg-cover rounded-xl p-5" style="background-image: url('{{ asset('storage/'.$banner) }}');">
        <h1 class="font-bold bg-primary text-white rounded-xl px-4 p-1 text-2xl inline-block">
            {{ $title }}
        </h1>
    </div>
    
    <!-- Berita -->
    <div class=" flex flex-col gap-5">
        <x-card-post :items="$posts" />
    </div>
</x-app-layout>