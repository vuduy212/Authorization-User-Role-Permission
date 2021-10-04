<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function create(array $data)
    {
        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if(empty($data['roles']))
        {
            $roles = [
                'client' => '70'
            ];
        }
        else
        {
            $roles = $this->getRolesID($data['roles']);
        }

        $user->roles()->attach($roles);

        return $user;
    }


    public function search(array $data)
    {
        $userName = array_key_exists('key', $data) ? $data['key'] : null;

        return $this->model->searchUsername($userName)->latest('id')->paginate(array_key_exists('number', $data) ? $data['number'] : 5);
    }
}