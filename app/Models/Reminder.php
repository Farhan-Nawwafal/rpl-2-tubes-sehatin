<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;

class Reminder extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function getDayTextAttribute()
    {
        return $this->date->format('l');
    }

    public function getDayNumberAttribute()
    {
        return $this->date->format('d');
    }

    public function getMonthAttribute()
    {
        return $this->date->format('F');
    }

    public function getYearAttribute()
    {
        return $this->date->format('Y');
    }

    public function getSleepStatusAttribute($value)
    {
        return $this->attributes['sleep_status'];
    }

    public function getEatStatusAttribute()
    {
        return $this->attributes['eat_status'];
    }
    public function getScreenTimeStatusAttribute()
    {
        return $this->attributes['screen_time_status'];
    }
    public function getSleepMessageAttribute()
    {
        return $this->attributes['sleep_message'];
    }
    public function getEatMessageAttribute()
    {
        return $this->attributes['eat_message'];
    }
    public function getScreenTimeMessageAttribute()
    {
        return $this->attributes['screen_time_message'];
    }
}
