<div class="flex flex-col my-10 justify-center">
    <x-section-head label="Featured" href="{{ route('posts.featured') }}" text="Show All" />
    <x-card-post :items="$posts"/>
</div>