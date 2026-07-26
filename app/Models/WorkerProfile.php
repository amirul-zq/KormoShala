<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'area',
        'description',
        'expected_rate',
        'verification_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
