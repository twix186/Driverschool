<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Practice extends Model
{
    use SoftDeletes;

    public $table = 'practices';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'instructor_id',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }


    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}