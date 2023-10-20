<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserCard extends Component
{
    public $user;
    public $listeners = ['reload' =>'render'];
    public function render()
    {
        return view('livewire.user-card');
    }

    public function deleteUser($id)
    {
        // Delete the user
        // dd('delete user');
        User::find($id)->delete();
        $this->dispatch('reload');
        // $this->render();
        // $this->dispatch('reloadHomepage');
        // $this->dispatch('reload-homepage')->to('users-list');


        // Update the list of users
    }
}
