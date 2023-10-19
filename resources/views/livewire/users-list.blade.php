<div>
    @foreach ($users as $user)
        @livewire('user-card', ['user' => $user], key($user->id))
    @endforeach
    @if($hasMorePages)
    <div
        x-data
        x-intersect="@this.call('loadUsers')"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4">
            @foreach(range(1, 4) as $x)
                <div class="bg-gray-100 w-100 text-hide">Loading...</div>
            @endforeach
        </div>
    @endif
</div>
