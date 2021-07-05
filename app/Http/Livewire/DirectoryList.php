<?php

namespace App\Http\Livewire;

use App\Models\Directory;
use Livewire\Component;

class DirectoryList extends Component
{
    public function render()
    {
        $userList = Directory::all();
        return view('livewire.directory-list', ['userList' => $userList]);
    }
}
