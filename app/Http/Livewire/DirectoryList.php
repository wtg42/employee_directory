<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DirectoryList extends Component
{
    public function render()
    {
        $userList = [];
        return view('livewire.directory-list', ['userList' => $userList]);
    }
}
