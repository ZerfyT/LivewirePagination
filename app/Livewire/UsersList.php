<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Cursor;
use Livewire\Component;

class UsersList extends Component
{
    public $perPage = 10;
    public $nextCursor;
    public $hasMorePages;

    protected $listeners = [
        'load-more' => 'loadMore',
        'reload' => '$refresh',
    ];

    public function loadMore()
    {
        if($this->hasMorePages !== null && !$this->hasMorePages) {
            // dd('empty');
            return;
        }
        // $this->limitPerPage = $this->limitPerPage + 20;
    }

    public function mount()
    {
        
    }

    public function fetchData()
    {
        $users = User::orderBy('created_at', 'desc')->cursorPaginate($this->perPage, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));
        $this->hasMorePages = $users->hasMorePages();
        if ($this->hasMorePages) {
            $this->nextCursor = $users->nextCursor()->encode();
        }
        return $users;
    }

    public function deleteUser($id)
    {
        // Delete the user
        User::find($id)->delete();

        // Update the list of users
        // $this->emit('userStore', User::orderBy('created_at', 'desc')->cursorPaginate(10));
    }


    public function render()
    {
        $users = User::orderBy('created_at', 'desc')->cursorPaginate($this->perPage, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor));
        $this->hasMorePages = $users->hasMorePages();
        if ($this->hasMorePages) {
            $this->nextCursor = $users->nextCursor()->encode();
        }
        else{
            // return;
        }
        // $users = User::latest()->paginate($this->limitPerPage);
        $this->dispatch('userStore', $users, $this->nextCursor, $this->hasMorePages);

        return view('livewire.users-list', ['users' => $users]);
    }
}
