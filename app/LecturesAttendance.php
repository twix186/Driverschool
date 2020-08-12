<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class LecturesAttendance extends Model
{
    use SoftDeletes;

    public $table = 'lectures_attendances';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'student_id',
        'date_of_lecture_id',
        'check',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function date_of_lecture()
    {
        return $this->belongsTo(Lecture::class, 'date_of_lecture_id');
    }
}