<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model implements Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['fullname', 'email', 'password', 'status', 'phone', 'address', 'avatar'];
    use HasFactory;
    use AuthenticatableTrait;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public static function attemptLogin($emailOrPhone, $password)
    {
        $user = self::where('email', $emailOrPhone)
            ->orWhere('phone', $emailOrPhone)
            ->first();
        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public static function checkUser($email, $phone)
    {
        $user = self::where('email', $email)
            ->orWhere('phone', $phone)
            ->get();
        return $user;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
