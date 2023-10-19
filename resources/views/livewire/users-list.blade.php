<div>
    @foreach ($users as $user)
        @livewire('user-card', ['user' => $user], key($user->id))
    @endforeach
    @if ($hasMorePages)
        <div x-data x-intersect="@this.call('loadUsers')" class="flex justify-center items-center">
            <div class="text-center w-full m-4 p-4 text-lg font-bold bg-gray-300">Loading...</div>
        </div>
    @endif
</div>
