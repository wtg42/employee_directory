<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;

    protected $table = 'directories';

    protected $fillable = [
        'employee_number',
        'chinese_name',
        'english_name',
        'phone',
        'ext',
        'email',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
