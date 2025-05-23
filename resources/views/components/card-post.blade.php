@props(['post'])
<article class="mb-6 bg-white shadow-lg rounded-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-20 object-cover object-center" src="{{ Storage::url($post->image->url) }}"
        alt="{{ $post->name }}">
    @else
        <img class="w-full h-20 object-cover object-center" src="https://cdn.pixabay.com/photo/2018/04/22/13/04/hallway-3341001_1280.jpg"
        alt="{{ $post->name }}">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h1>
        <div class="text-gray-700 text-base">
            {{ $post->extract }}
        </div>
    </div>
    <div class="px-6 pt-4 pb-4">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.tag', $tag) }} " class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>
