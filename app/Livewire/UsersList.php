<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{
    public $limitPerPage = 10;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 20;
    }

    public function deleteUser($id)
    {
        // Delete the user
        User::find($id)->delete();

        // Update the list of users
        $this->emit('userStore', User::latest()->paginate($this->limitPerPage));
    }


    public function render()
    {
        $users = User::latest()->paginate($this->limitPerPage);
        $this->dispatch('userStore', $users);

        return view('livewire.users-list', ['users' => $users]);
    }
}
