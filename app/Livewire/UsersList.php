<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
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
    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadUsers()
    {
        if ($this->hasMorePages !== null  && ! $this->hasMorePages) {
            return;
        }
        $users = User::cursorPaginate(12, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));

        $this->users->push(...$users->items());

        if ($this->hasMorePages = $users->hasMorePages()) {
            $this->nextCursor = $users->nextCursor()->encode();
        }
        $this->dispatch('userStore', $users, $this->nextCursor, $this->hasMorePages);
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
        // $users = User::latest()->paginate($this->limitPerPage);
        // $this->dispatch('userStore', $users);

        return view('livewire.users-list');
    }
}
