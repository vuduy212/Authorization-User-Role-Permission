<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Request;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permissions', 'id_role', 'id_permission');
    }

    public function hasPermission($permissions)
    {
        foreach($permissions as $permission)
        {
            if($this->permissions->contains('action', $permission)){
                return true;
            }
        }
        return false;
    }

    public function search(array $data)
    {
        $roleName = array_key_exists('key', $data) ? $data['key'] : null;

        return $this->searchRoleName($roleName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }

    public function scopeSearchRoleName($query, $roleName)
    {
        return $query->where('name','like','%'.$roleName.'%');
    }

    public function attachPermissions($permission)
    {
        return $this->permissions()->attach($permission);
    }

    public function syncPermissions($permission)
    {
        return $this->permissions()->sync($permission);
    }

    public function detachPermissions()
    {
        return $this->permissions()->detach();
    }
}
