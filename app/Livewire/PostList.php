<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class PostList extends Component
{
    public $limitPerPage = 5;
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
        dd('reload homepage');
    }

    #[On('home-updated')]
    public function catchHomeUpdated()
    {
        // dd('home updated');
        dd('reload');
    }

    public function loadUsers()
    {
        if ($this->hasMorePages !== null  && ! $this->hasMorePages) {
            return;
        }
        $users = User::cursorPaginate($this->limitPerPage, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));

        $this->users->push(...$users->items());

        if ($this->hasMorePages = $users->hasMorePages()) {
            $this->nextCursor = $users->nextCursor()->encode();
        }
        $this->dispatch('userStore', $users, $this->nextCursor, $this->hasMorePages);
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
