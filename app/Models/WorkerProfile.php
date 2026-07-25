<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'area',
        'description',
        'expected_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}