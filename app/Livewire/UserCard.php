<?php

namespace App\Livewire;

use Livewire\Component;

class UserCard extends Component
{
    public $user;
    public $loop;
    public function render()
    {
        return view('livewire.user-card');
    }
}
