<div>
    @foreach ($users as $user)
        @livewire('user-card', ['user' => $user], key($user->id))
    @endforeach
</div>
