<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Exam extends Model
{
    use SoftDeletes;

    public $table = 'exams';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'student_id',
        'date',
        'result',
        'created_at',
        'updated_at',
        'deleted_at',
        'exam_type',
    ];

    const STATUS_SELECT = [
        'theory' => 'Теория',
        'polygon'  => 'Автодром',
        'city' => 'Город',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

}