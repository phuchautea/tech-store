<?php

namespace App\Services;

use App\Interfaces\User\IUserService;
use App\Interfaces\User\IUserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserService implements IUserService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function getAllPaginate($paginate = 5)
    {
        return $this->userRepository->getAllPaginate($paginate);
    }

    public function remove($request)
    {
        $id = (int)$request->input('id');
        return $this->userRepository->remove($id);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->input();
        return $this->userRepository->update($data, $user);
    }

    public function role($role = 'customer'): string
    {
        return $role == 'admin' ? '<span class="btn btn-danger btn-xs">Admin</span>'
            : '<span class="btn btn-info btn-xs">Customer</span>';
    }


}
