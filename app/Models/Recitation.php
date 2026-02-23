<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recitation extends Model
{
     protected $fillable = [
        'student_id',
        'subject',
        'notes',
        'name',
        'date',
        'condition'
    ];

    public function student()
{
    return $this->belongsTo(Student::class);
}

}
