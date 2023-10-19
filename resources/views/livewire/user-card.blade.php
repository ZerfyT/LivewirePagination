<div class="flex justify-center items-center h-screen">
    <div class="card w-full max-w-sm">
        <div class="card-body">
            <div class="flex flex-col items-center">
                <img src="{{ $user->profile_photo_path }}" alt="Profile image" class="rounded-full w-32 h-32">
                <h2 class="mt-4 text-xl font-semibold">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->id }}</p>
            </div>
            <ul class="mt-4">
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 11-8 0 4 4 0 018 0zM7 20h5v4m0-4h5v4m-5-4v-4h5" />
                    </svg>
                    <span class="ml-2">{{ $user->email }}</span>
                </li>
                <li class="flex items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 2v2m0-4h6m2 4h6m6-4v2m0-4v2m0-4h-2m0 4h-2m0-4h-2" />
                    </svg>
                    <span class="ml-2">
                        <{{ $user->password }} /span>
                </li>
                <li>
                    <button wire:click="deleteUser({{ $user->id }})">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</div>