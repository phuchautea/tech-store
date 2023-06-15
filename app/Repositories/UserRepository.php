<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\User\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserRepository implements IUserRepository
{
    public function getAll()
    {
        return User::all()->sortByDesc('created_at');
    }

    public function remove($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            if($user->id == Auth::user()->id)
            {
                Session::flash('error', 'Bạn không thể xoá chính bạn');
                return false;
            }else{
                return User::where('id', $id)->delete();
            }
        }
        return false;
    }

    public function update($data, User $user)
    {
        try {
            $user->updated_at = time();
            $user->fill($data);
            $user->save();
            Session::flash('success', 'Cập nhật user thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function getAllPaginate($paginate = 5)
    {
        return User::orderBy('created_at', 'desc')->paginate($paginate);
    }
}
