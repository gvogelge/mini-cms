<x-app-layout>
    <div class="flex flex-col items-center space-y-6 mt-6">
        @foreach ($posts as $post)
            <div class="w-full max-w-2xl border border-black shadow-sm bg-white">

                <!-- Kopfzeile mit Titel & Lupe -->
                <div class="flex items-center justify-between px-6 py-3 border-b border-black bg-gray-50">
                    <h3 class="text-xl font-semibold text-gray-800">
                        {{ $post->title }}
                    </h3>
                    <a href="{{ route('posts.show', $post) }}"
                       class="text-gray-500 hover:text-gray-700"
                       title="Beitrag anzeigen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                        </svg>
                    </a>
                </div>

                <!-- Post-Inhalt -->
                <div class="px-6 py-4">
                    <p class="text-gray-700 select-none break-words">
                        {{ Str::limit($post->content, 150) }}
                    </p>

                    <!-- Bildanzeige mit Zoom-Funktion -->
                    @if ($post->image_path)
                        <div x-data="{ showFull: false }" class="flex justify-center mt-4">
                            <!-- Kleines Bild -->
                            <img src="{{ asset('storage/' . $post->image_path) }}"
                                 alt="Beitragsbild"
                                 @click="showFull = true"
                                 class="cursor-zoom-in border border-black border-1 shadow max-w-[300px] transition duration-200">

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
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>