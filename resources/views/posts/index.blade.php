<x-app-layout>
    <x-slot name="header">
        <h2>Beiträge</h2>
    </x-slot>

    @foreach ($posts as $post)
        <div>
            <h3><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
            <p>{{ Str::limit($post->content, 150) }}</p>
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Beitragsbild" style="max-width: 300px;">
            @endif
            <p>Von: {{ $post->user?->name ?? 'Unbekannt' }}</p>
        </div>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>