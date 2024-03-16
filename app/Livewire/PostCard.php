<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCard extends Component
{
    public $user;

    // #[On('homeupdated')]
    // public function catchHomeUpdated()
    // {
    //     dd('home updated');
    // }


    public function deleteUser()
    {
        // $response = response();
        // dd('delete user');
        // Delete the user
        // dd('delete user');
        try {
            // User::findOrFail($this->user->id)->delete();
            // $this->dispatch('reload-homepage');
            $this->dispatch('reload-homepage');
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        // $this->dispatch('reload');
        // $this->dispatch('reloadHomepage');
        // $this->dispatch('reload-homepage')->to('users-list');
    }

    public function deleteDispatch()
    {
        $this->dispatch('homeupdated');
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}
