<x-app-layout>
    <x-slot name="header">
        <h2>Neuen Beitrag erstellen</h2>
    </x-slot>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Titel</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label for="content">Inhalt</label>
            <textarea name="content" required></textarea>
        </div>

        <div>
            <label for="image">Bild (optional)</label>
            <input type="file" name="image">
        </div>

        <button type="submit">Speichern</button>
    </form>
</x-app-layout>