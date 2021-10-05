<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($perrmissions)
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($perrmissions)) {
                return true;
            }
        }
        return false;
    }

    public function attachRoles(int $roleId)
    {
        return $this->roles()->attach($roleId);
    }

    public function detachRoles()
    {
        return $this->roles()->detach();
    }

    public function syncRoles(int $roleId)
    {
        return $this->roles()->sync($roleId);
    }

    public function search(array $data)
    {
        $userName = array_key_exists('key', $data) ? $data['key'] : null;

        return $this->searchUsername($userName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }

    public function scopeSearchUsername($query, $userName)
    {
        return $query->where('name', 'like', '%' . $userName . '%');
    }
}
