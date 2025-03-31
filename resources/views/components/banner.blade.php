<div class="swiper mySwiper my-10">
    <div class="swiper-wrapper">
        @forelse ($banners as $banner)
        <div class="swiper-slide">
            <a href="{{ route('post', $banner->post->slug) }}" class="block">
                <div class="relative flex flex-col gap-1 justify-end p-3 h-72 rounded-xl overflow-hidden bg-cover bg-center"
                    style="background-image: url('{{ asset('storage/'.$banner->post->image) }}');">
                    <div
                        class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t from-[rgba(0,0,0,0.4)] to-[rgba(0,0,0,0)] rounded-b-xl">
                    </div>
                    <div class="relative z-10 mb-3" style="padding-left: 10px;">
                        <div class="bg-primary text-white text-xs rounded-lg w-fit px-3 py-1 font-normal mt-3">
                            {{ $banner->post->category->name }}
                        </div>
                        <p class="text-3xl font-semibold text-white mt-1">
                            {{ $banner->post->title }}
                        </p>
                        <div class="flex items-center gap-1 mt-1">
                            <img src="{{ asset('storage/'.$banner->post->author->avatar) }}" alt="" class="w-12 h-12 object-cover rounded-full border-primary border-2">
                            <p class="text-white text-xs">{{$banner->post->author->name}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @empty
            
        @endforelse
    </div>
</div>