<?php

namespace App\Http\Livewire;

use App\Models\Directory;
use Livewire\Component;
use Livewire\WithPagination;

class DirectoryList extends Component
{
    // search input
    public $zhnameOrPhone;

    use WithPagination; // livewire分頁用 沒加會變成reload分頁

    public function render()
    {
        $directory = new Directory;
        $directories = $directory->when(!empty($this->zhnameOrPhone), function ($query) {
            return $query
                ->where([['chinese_name', 'like', "%{$this->zhnameOrPhone}%"]])
                ->orwhere([['phone', 'like', "%{$this->zhnameOrPhone}%"]]);
        })
            ->with('Department')
            ->paginate(5);

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
