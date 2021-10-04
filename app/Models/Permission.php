<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'action'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_permissions', 'id_permission', 'id_role');
    }

    public function search(array $data)
    {
        $permissionName = array_key_exists('key', $data) ? $data['key'] : null;

        return $this->searchRoleName($permissionName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }

    public function scopeSearchRoleName($query, $permissionName)
    {
        return $query->where('name','like','%'.$permissionName.'%');
    }

}
