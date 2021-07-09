<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Directory;
use App\Models\Department;
use Livewire\WithPagination;

class DirectoryList extends Component
{
    use WithPagination;// livewire分頁用 沒加會變成reload分頁

    public function render()
    {
        $directory = new Directory;
        $directories = $directory->with('Department')->paginate(2);

        return view('livewire.directory-list', ['directories' => $directories]);
    }

    public function removeFromTableRow($removeID)
    {
        $contactUs = Directory::find($removeID);
        $contactUs->delete();
    }
}
