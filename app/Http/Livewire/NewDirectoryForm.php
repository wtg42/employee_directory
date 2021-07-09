<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Directory;
use App\Models\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class NewDirectoryForm extends Component
{

    // 表單欄位
    public $chinese_name;
    public $english_name;
    public $email;
    public $phone;
    public $ext;
    public $dept;

    // form reuls 搭配 messages
    protected $rules = [
        'chinese_name' => 'required|min:2',
        'english_name' => 'required|min:2',
        'email'   => 'required|email',
        'phone'   => 'required|string|min:8',
        'ext'     => 'required',
        'dept'    => 'required',
    ];

    protected $messages = [
        'chinese_name.required' => '姓名不能空白',
        'chinese_name.min' => '最少需要2個字',
        'english_name.required' => '姓名不能空白',
        'english_name.min' => '最少需要2個字',
        'email.required' => 'Email欄位不能留空',
        'email.email' => 'Email格式錯誤.',
        'phone.required' => '電話欄位不能留空',
        'phone.min' => '電話格式錯誤',
        'ext.required' => '分機不能空白',
        'dept.required' => '請選擇部門',
    ];

    public function render()
    {
        $departments = Department::all();
        return view('livewire.new-directory-form', ['departments' => $departments]);
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
            $dirct = Directory::create([
                'chinese_name' => $validatedData['chinese_name'],
                'english_name' => $validatedData['english_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'ext' => $validatedData['ext'],
                'department_id' => $validatedData['dept'],
            ]);
            $dirct->save();
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            session()->flash('success_message', '新增失敗，信箱是否重複?('. $e->getCode() .')');
            return;
        }

        session()->flash('success_message', $validatedData['chinese_name'].'已新增。');
        // reset public property values to thrie initial state.
        $this->reset();
    }

    // dismiss Contact us form success message box
    public function dismissSuccessMessage()
    {
        session()->flash('success_message', null);
    }
}
