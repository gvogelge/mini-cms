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
                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                            onsubmit="return confirm('Diesen Beitrag wirklich löschen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    title="Löschen"
                                    class="text-gray-500 hover:text-red-800 flex items-center">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </form>
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

                <p class="text-sm text-gray-500 mt-4">
                    Von: {{ $post->user?->name ?? 'Unbekannt' }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>