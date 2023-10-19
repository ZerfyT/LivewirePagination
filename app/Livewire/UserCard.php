<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.user-card');
    }

    public function deleteUser()
    {
        // Delete the user
        $this->user->delete();
        // dd('delete user');
        // $this->render();
        // $this->dispatch('reloadHomepage');
        $this->dispatch('reload-homepage')->to('users-list');


        // Update the list of users
    }
}
