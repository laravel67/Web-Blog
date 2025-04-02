<div class="flex flex-col my-10">
    <x-section-head label="Populars" href="{{ route('posts.popular') }}" text="Show All" />
    <x-card-post :items="$posts"/>
</div>