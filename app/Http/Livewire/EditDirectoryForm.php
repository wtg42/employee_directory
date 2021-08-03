<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Directory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditDirectoryForm extends Component
{
    // 表單欄位
    public $employee_number;
    public $chinese_name;
    public $english_name;
    public $email;
    public $phone;
    public $ext;
    public $dept;
    public $directoryID; // 資源ID

    // form reuls 搭配 messages
    protected $rules = [
        'employee_number' => 'required|integer',
        'chinese_name' => 'required|string|min:2',
        'english_name' => 'required|string|min:2',
        'email' => 'required|email',
        'phone' => 'required|string|min:8',
        'ext' => 'required|integer',
        'dept' => 'required',
    ];

    protected $messages = [
        'employee_number.unique' => '員工編號已被使用',
        'employee_number.required' => '員工編號不能空白',
        'chinese_name.required' => '姓名不能空白',
        'chinese_name.min' => '最少需要2個字',
        'english_name.required' => '姓名不能空白',
        'english_name.min' => '最少需要2個字',
        'email.unique' => 'Email已被使用',
        'email.required' => 'Email欄位不能留空',
        'email.email' => 'Email格式錯誤.',
        'phone.required' => '電話欄位不能留空',
        'phone.min' => '電話格式錯誤',
        'ext.required' => '分機不能空白',
        'dept.required' => '請選擇部門',
    ];

    public function render()
    {
        return view('livewire.edit-directory-form', ['departments' => Department::all()]);
    }

    /**
     * 欄位預設值設定
     * @return void
     * @throws ModelNotFoundException
     */
    public function mount()
    {
        $directory = Directory::with('Department')->findOrFail($this->directoryID);
        $this->employee_number = $directory->employee_number;
        $this->chinese_name = $directory->chinese_name;
        $this->english_name = $directory->english_name;
        $this->email = $directory->email;
        $this->phone = $directory->phone;
        $this->ext = $directory->ext;
        $this->dept = $directory->department_id;
    }

    // Real-time Validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // 新增聯絡人表單送出
    public function submitForm()
    {
        try {
            $validatedData = $this->validate();
            // 寫入欄位
            Directory::where([['id', '=', $this->directoryID]])->update([
                'employee_number' => $validatedData['employee_number'],
                'chinese_name' => $validatedData['chinese_name'],
                'english_name' => $validatedData['english_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'ext' => $validatedData['ext'],
                'department_id' => $validatedData['dept'],
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            session()->flash('success_message', '更新失敗，信箱、員工編號或姓名是否重複?(' . $e->getCode() . ')');
            return;
        }

        session()->flash('success_message', $validatedData['chinese_name'] . '已更新。');
    }

    // dismiss Contact us form success message box
    public function dismissSuccessMessage()
    {
        session()->flash('success_message', null);
    }
}
