<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\User\IUserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageUserController extends Controller
{
    protected $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $paginate = 5;
        $users = $this->userService->getAllPaginate($paginate);
        $role_list = [
            0 => [
                'id' => 'admin',
                'name' => 'Administrator'
            ],
            1 => [
                'id' => 'customer',
                'name' => 'Customer'
            ]
        ];
        return view('admin.users.list', [
            'title' => 'Danh sách người dùng',
            'users' => $users,
            'role_list' => $role_list,
            'total_records' => $users->total(),
        ])->with('userService', $this->userService);
    }
    public function destroy(Request $request)
    {
        $result = $this->userService->remove($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa người dùng thành công'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Có lỗi xảy ra khi xóa người dùng'
        ]);
    }
    public function update(Request $request, User $user)
    {
        $result = $this->userService->update($request, $user);
        if ($result) {
            $arr_result = ['status' => true, 'message' => Session::get('success')];
        }else{
            $arr_result = ['status' => false, 'message' => Session::get('error')];
        }
        return json_encode($arr_result);
    }
}
