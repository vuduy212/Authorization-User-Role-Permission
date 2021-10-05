<?php


namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function search(Request $request)
    {
        return $this->userRepository->search($request->all());
    }

    public function createUser(Request $request)
    {
        return $this->userRepository->createUser($request->all());
    }

    public function updateUser(Request $request, User $user)
    {
        return $this->userRepository->updateUser($request, $user);
    }

    public function deleteUser(User $user)
    {
        return $this->userRepository->deleteUser($user);
    }

}
