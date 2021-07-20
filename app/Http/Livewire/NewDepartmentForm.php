<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewDepartmentForm extends Component
{
    public $dept_name;

    // form reuls 搭配 messages
    protected $rules = [
        'dept_name' => 'required|min:2',
    ];

    protected $messages = [
        'dept_name.required' => '名稱不能空白',
        'dept_name.min' => '最少需要2個字',
    ];
    public function render()
    {
        return view('livewire.new-department-form');
    }

    // Real-time Validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {

        try {
            $validatedData = $this->validate();
            // 寫入欄位
            $dept = Department::create([
                'dept_name' => $validatedData['dept_name'],
            ]);
            $dept->save();
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            session()->flash('success_message', '新增失敗(' . $e->getCode() . ')。');
            return;
        }

        session()->flash('success_message', $validatedData['dept_name'] . '已新增。');
        // reset public property values to thrie initial state.
        $this->reset();
    }

    // dismiss Contact us form success message box
    public function dismissSuccessMessage()
    {
        session()->flash('success_message', null);
    }
}
