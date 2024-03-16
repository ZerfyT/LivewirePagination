<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserCard extends Component
{
    public $user;
    // public $listeners = ['reload' =>'render'];
    public function render()
    {
        return view('livewire.user-card');
    }

    public function deleteUser($userId)
    {
        // $response = response();
        // dd('delete user');
        // Delete the user
        // dd('delete user');
        // dd($userId);
        try {
            $user = User::findOrFail($this->user->id);
            $user->delete();
            // $this->render();
            // sleep(1);
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        $this->dispatch('reload-homepage', $userId)->to('users-list');
        // $this->dispatch('reload');
        // $this->dispatch('reloadHomepage');
        // $this->dispatch('reload-homepage', User::all())->to('users-list');
    }
}
