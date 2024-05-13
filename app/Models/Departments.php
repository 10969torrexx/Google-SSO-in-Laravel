<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
