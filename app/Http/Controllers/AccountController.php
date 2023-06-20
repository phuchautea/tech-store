<?php

namespace App\Http\Controllers;

use App\Interfaces\Order\IOrderService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    protected $orderService;
    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(){
        if (!Auth::check()) {
            return view('account.login', [
                'title' => 'Đăng nhập'
            ]);
        } else {
            $myOrders = $this->orderService->getByUserId(Auth::User()->id);
            return view('account.index', [
                'title' => 'Tài khoản của bạn',
                'orders' => $myOrders,
                'orderService' => $this->orderService
            ]);
        }

    }
    public function showLoginForm()
    {
        if (!Auth::check()) {
            return view('account.login', [
                'title' => 'Đăng nhập'
            ]);
        } else {
            return redirect()->route('account');
        }
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ], [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ]);

        if (Auth::attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $request->input('remember')
        )) {
            return redirect()->route('account');
        }
        Session::flash('error', 'Email hoặc mật khẩu không chính xác');
        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    public function showRegisterForm()
    {
        if (!Auth::check()) {
            return view('account.register', [
                'title' => 'Đăng ký'
            ]);
        } else {
            return redirect()->route('account');
        }
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'customer';
        $user->save();

        Auth::login($user);

        return redirect()->route('account');
    }
}
