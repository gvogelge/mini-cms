<section>
    <header>
        <h2 class="text-lg font-semibold text-red-700">
            Delete Account
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <div class="mt-6">
        <button type="submit"
                class="border border-black bg-red-600 text-white px-6 py-2 hover:bg-red-400 transition"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Delete Account
        </button>
    </div>

    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />
                <x-text-input id="password" name="password" type="password"
                              class="block w-full mt-1 border border-black px-4 py-2 focus:outline-none focus:ring-0 focus:border-lime-400"
                              placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" @click="$dispatch('close')"
                        class="border border-black px-6 py-2 text-black hover:bg-gray-200 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="border border-black bg-red-600 text-white px-6 py-2 hover:bg-red-400 transition">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>