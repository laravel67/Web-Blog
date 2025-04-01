<div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
    <a href="{{ route('post', $data->slug) }}">
        <div
            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
            {{ $data->category->name }}    
            </div>
            <img src="{{ asset('storage/'.$data->image) }}" alt="{{ $data->title }}" class="w-full rounded-xl mb-3">
            <p class="font-bold text-base mb-1">
                {{ $data->title }}
            </p>
            <p class="text-slate-400">
                {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
            </p>
        </div>
    </a>
</div>