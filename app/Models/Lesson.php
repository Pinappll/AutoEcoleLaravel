<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'moniteur_id',
        'student_id',
        'car_id',
    ];

    public function moniteur()
    {
        return $this->belongsTo(Moniteur::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
