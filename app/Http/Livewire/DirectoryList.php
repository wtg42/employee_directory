<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Directory;
use Livewire\WithPagination;

class DirectoryList extends Component
{
    use WithPagination;// livewire分頁用 沒加會變成reload分頁

    public function render()
    {
        $directory = new Directory;
        $directories = $directory->with('Department')->paginate(5);

        return view('livewire.directory-list', ['directories' => $directories]);
    }

    // Remove row from table.
    public function removeFromTableRow($removeID)
    {
        $contactUs = Directory::find($removeID);
        $contactUs->delete();
    }

    /**
     * 導向編輯聯絡資訊頁面
     * @param mixed $editID 要移除的主鍵。
     * @return void
     */
    public function editFromTableRow($editID)
    {
        // [URI: directory/{directory}/edit]
        return redirect(Route("directory.edit", ['directory' => $editID]));
    }
}
