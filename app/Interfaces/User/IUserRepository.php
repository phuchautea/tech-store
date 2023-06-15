<?php

namespace App\Interfaces\User;

use App\Models\User;

interface IUserRepository
{
    public function getAll();
    public function getAllPaginate($paginate);
    public function remove($id);
    public function update($data, User $user);

}
