<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function getRolesID($roles)
    {
        $getRoles = [];
        foreach ($roles as $role) {
            $getRoles[] = $role;
        }
        return $getRoles;
    }

    public function createUser(array $data)
    {
        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if (empty($data['roles'])) {
            $roles = [
                'client' => '70'
            ];
        } else {
            $roles = $this->getRolesID($data['roles']);
        }
        $user->roles()->attach($roles);
        return $user;
    }

    public function updateUser(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return $user;
    }

    public function deleteUser(User $user)
    {
        $user->roles()->detach();
        $user->delete();
    }

    public function search(array $data)
    {
        $userName = array_key_exists('key', $data) ? $data['key'] : null;
        return $this->model->searchUsername($userName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }
}
