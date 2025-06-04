<x-app-layout>
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    @if($post->image_path)
        <img src="{{ asset('storage/' . $post->image_path) }}" style="max-width:300px;">
    @endif

    @if(auth()->id() === $post->user_id)
        <a href="{{ route('posts.edit', $post) }}">Bearbeiten</a>
        <form method="POST" action="{{ route('posts.destroy', $post) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Löschen</button>
        </form>
    @endif
</x-app-layout>