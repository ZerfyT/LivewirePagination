<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use Livewire\Attributes\On;
use Livewire\Component;

class UsersList extends Component
{
    public $limitPerPage = 10;
    public $users;
    public $nextCursor;
    public $hasMorePages;

    public function mount()
    {
        $this->users = new Collection();
        $this->loadUsers();
    }

    #[On('reload-homepage')]
    public function reloadHomepage()
    {
        // dd('reload 2');
        $this->render();
    }

    public function updateUsersCollection()
    {
        if($users = Redis::get('users')) {
            $users = json_decode($users, false);
        }
        else {
            $users = User::cursorPaginate($this->limitPerPage, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));
            $this->users->push(...$users->items());
            Redis::set('users', json_encode($this->users, JSON_FORCE_OBJECT));
        }
        return $users;
    }

    public function loadUsers()
    {
        if ($this->hasMorePages !== null  && ! $this->hasMorePages) {
            return;
        }
        $users = $this->updateUsersCollection();
        // dd($users);


        if ($this->hasMorePages = $users->hasMorePages()) {
            $this->nextCursor = $users->nextCursor()->encode();
        }
        $this->dispatch('userStore', $users, $this->nextCursor, $this->hasMorePages);
    }

    public function render()
    {
        // $users = User::latest()->paginate($this->limitPerPage);
        // $this->dispatch('userStore', $users);

        return view('livewire.users-list');
    }
}
