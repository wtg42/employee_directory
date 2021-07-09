<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentList extends Component
{
    public function render()
    {
        $dept = Department::paginate(2);
        return view('livewire.department-list', ['departments' => $dept]);
    }

    public function removeFromTableRow($removeID)
    {
        $contactUs = Department::find($removeID);
        $contactUs->delete();
    }
}
