<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp_number',
        'address',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function workerProfile()
    {
        return $this->hasOne(WorkerProfile::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'hirer_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'worker_id');
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'hirer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'worker_id');
    }
}