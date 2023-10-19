<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{
    public $totalRecords;
    public $loadAmount = 10;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->loadAmount += 10;
    }

    public function deleteUser($id)
    {
        // Delete the user
        // User::find($id)->delete();
        $this->totalRecords = User::count();

        // Update the list of users
        $this->dispatch('userStore', User::latest()->paginate($this->limitPerPage));
    }


    public function render()
    {
        $users = User::latest()->limit($this->loadAmount)->get();
        $this->dispatch('userStore', $users);

        return view('livewire.users-list', ['users' => $users]);
    }
}
