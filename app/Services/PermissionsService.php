<?php

namespace App\Services;

use App\Repositories\PermissionsRepository;
use Illuminate\Http\Request;

class PermissionsService
{
    protected $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function search(Request $request)
    {
        return $this->permissionsRepository->search($request->all());
    }
}
