<x-app-layout>
    <div class="flex flex-col items-center mt-10 space-y-6">
        <div class="w-full max-w-2xl bg-white border border-black shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">
                Profile
            </h2>

            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="w-full max-w-2xl bg-white border border-black shadow-sm p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="w-full max-w-2xl bg-white border border-black shadow-sm p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>