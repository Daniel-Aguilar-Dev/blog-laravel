<x-app-layout>
    <div class="container py-8">
        <h1 class="uppercase text-center text-4xl font-bold mb-4" >Etiqueta: {{ $tag->name }} </h1>
        @foreach ($posts as $post)
            <x-card-post :post="$post" />
        @endforeach
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>