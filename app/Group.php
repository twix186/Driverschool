<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Group extends Model
{
    use SoftDeletes;

    public $table = 'groups';

    protected $dates = [
        'date_of_start',
        'date_of_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'date_of_start',
        'date_of_end',
        'learning_plan_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function learning_plan()
    {
        return $this->belongsTo(LearningPlan::class, 'learning_plan_id');
    }
}