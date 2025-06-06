<x-app-layout>
    <div class="flex flex-col items-center mt-6">
        <div class="w-full max-w-2xl border border-black shadow-sm bg-white">

            <!-- Kopfzeile mit Titel und Icons -->
            <div class="flex justify-between items-center px-6 py-3 border-b border-black bg-gray-50">
                <h1 class="text-2xl font-semibold text-gray-800">
                    {{ $post->title }}
                </h1>

                @if(auth()->id() === $post->user_id)
                    <div class="flex items-center space-x-4">
                        <!-- Bearbeiten -->
                        <a href="{{ route('posts.edit', $post) }}"
                        title="Bearbeiten"
                        class="text-gray-500 hover:text-lime-600 flex items-center">
                            <x-heroicon-o-pencil-square class="w-5 h-5" />
                        </a>

                        <!-- Löschen -->
                        <!-- Alpine State -->
                        <div x-data="{ confirmDelete: false }">
                            <!-- Löschen Button -->
                            <button @click="confirmDelete = true"
                                    type="button"
                                    title="Löschen"
                                    class="text-gray-500 hover:text-red-800 flex items-center">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>

                            <!-- Modal -->
                            <div x-show="confirmDelete"
                                x-cloak
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                                @keydown.escape.window="confirmDelete = false">

                                <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                        Beitrag wirklich löschen?
                                    </h2>

                                    <p class="text-sm text-gray-600 mb-6">
                                        Diese Aktion kann nicht rückgängig gemacht werden.
                                    </p>

                                    <div class="flex justify-end space-x-3">
                                        <button @click="confirmDelete = false"
                                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                            Abbrechen
                                        </button>

                                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                Löschen
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Post-Inhalt -->
            <div class="px-6 py-4">
                <p class="text-gray-700 whitespace-pre-line break-words">
                    {{ $post->content }}
                </p>

                <!-- Bildanzeige mit Zoom-Funktion -->
                @if($post->image_path)
                    <div x-data="{ showFull: false }" class="flex justify-center mt-4">
                        <!-- Kleines Bild -->
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                             alt="Beitragsbild"
                             @click="showFull = true"
                             class="cursor-zoom-in border border-black shadow max-w-[300px] transition duration-200">

                        <!-- Vergrößertes Bild als Overlay -->
                        <div x-show="showFull"
                             @click="showFull = false"
                             @keydown.escape.window="showFull = false"
                             class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
                             x-cloak>
                            <img src="{{ asset('storage/' . $post->image_path) }}"
                                 class="max-w-4xl max-h-[90vh] rounded shadow-lg cursor-zoom-out">
                        </div>
                    </div>
                @endif

                <div class="flex justify-between items-center text-sm text-gray-500 mt-4">
                    <p>Von: {{ $post->user?->name ?? 'Unbekannt' }}</p>
                    <p>{{ $post->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>