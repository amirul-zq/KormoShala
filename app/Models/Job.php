<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'hirer_id',
        'title',
        'category',
        'description',
        'area',
        'work_date',
        'budget',
        'status',
        'selected_worker_id',
    ];

    protected function casts(): array
    {
        return [
            'work_date' => 'date',
        ];
    }

    public function hirer()
    {
        return $this->belongsTo(User::class, 'hirer_id');
    }

    public function selectedWorker()
    {
        return $this->belongsTo(User::class, 'selected_worker_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}