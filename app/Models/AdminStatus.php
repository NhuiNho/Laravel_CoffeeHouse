<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
