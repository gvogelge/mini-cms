<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-2xl border border-black bg-white shadow px-8 py-6">

            <h2 class="text-2xl font-semibold mb-6 text-center">Edit Post</h2>

            <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Titel -->
                <div>
                    <label for="title" class="block text-black font-medium mb-1">Title</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $post->title) }}"
                           class="w-full border border-black px-4 py-2
                                  focus:outline-none focus:ring-0 focus:border-lime-600"
                           required>
                </div>

                <!-- Inhalt -->
                <div>
                    <label for="content" class="block text-black font-medium mb-1">Content</label>
                    <textarea name="content" id="content" rows="12"
                              class="w-full border border-black px-4 py-2 resize-y
                                     focus:outline-none focus:ring-0 focus:border-lime-600"
                              required>{{ old('content', $post->content) }}</textarea>
                </div>

                <!-- Bild -->
                <div>
                    <label for="image" class="block text-black font-medium mb-1">Replace Picture (optional)</label>
                    <input type="file" name="image" id="image"
                           class="w-full border border-black px-4 py-2
                                  file:bg-lime-400 file:text-black file:border-0
                                  hover:file:bg-lime-200 focus:outline-none focus:ring-0 focus:border-lime-600">
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="border border-black bg-lime-600 text-black px-6 py-2 hover:bg-lime-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>