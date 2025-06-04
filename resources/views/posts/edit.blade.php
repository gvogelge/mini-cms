<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
    <textarea name="content" required>{{ old('content', $post->content) }}</textarea>

    @if($post->image_path)
        <img src="{{ asset('storage/' . $post->image_path) }}" style="max-width:300px;">
    @endif

    <input type="file" name="image">

    <button type="submit">Aktualisieren</button>
</form>