<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'hirer_id',
        'worker_id',
        'rating',
        'review',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function hirer()
    {
        return $this->belongsTo(User::class, 'hirer_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}