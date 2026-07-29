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

    /**
     * Jobs posted by this user as a Hirer.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'hirer_id');
    }

    /**
     * Alias used by the Admin User details controller.
     */
    public function postedJobs()
    {
        return $this->hasMany(Job::class, 'hirer_id');
    }

    /**
     * Jobs assigned to this user as a Worker.
     */
    public function selectedJobs()
    {
        return $this->hasMany(Job::class, 'selected_worker_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'worker_id');
    }

    /**
     * Reviews written by this user as a Hirer.
     */
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'hirer_id');
    }

    /**
     * Alias for reviews written by the Hirer.
     */
    public function writtenReviews()
    {
        return $this->hasMany(Review::class, 'hirer_id');
    }

    /**
     * Reviews received by this user as a Worker.
     */
    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'worker_id');
    }

    /**
     * Alias used by the Admin User details controller.
     */
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'worker_id');
    }
}