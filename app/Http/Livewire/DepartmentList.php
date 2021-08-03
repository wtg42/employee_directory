<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentList extends Component
{
    use WithPagination; // livewire分頁用 沒加會變成reload分頁

    public function render()
    {
        $dept = Department::paginate(5);
        return view('livewire.department-list', ['departments' => $dept]);
    }

    public function removeFromTableRow($removeID)
    {
        $dept = Department::find($removeID);
        $dept->delete();
    }
}
