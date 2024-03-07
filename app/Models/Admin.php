<?php

namespace App\Models;

// use Illuminate\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Admin extends Model implements Authenticatable
{
    protected $table = 'admins';
    protected $fillable = ['name', 'email', 'password', 'admin_status_id'];
    use HasFactory;
    use AuthenticatableTrait;

    public static function checkAdmin($email)
    {
        $user = self::where('email', $email)
            ->first();
        if ($user) {
            return $user;
        }
        return null;
    }

    public static function attemptLogin($email, $password)
    {
        $user = self::checkAdmin($email);

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function admin_status()
    {
        return $this->belongsTo(AdminStatus::class);
    }
}
