<?php

namespace App\Interfaces\User;

use App\Models\User;
use Illuminate\Http\Request;

interface IUserService
{
    public function getAll();
    public function getAllPaginate($paginate = 5);
    public function remove($request);
    public function update(Request $request, User $user);
    public function role($role = 'customer');

}
