<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller {

    const USERNAME_KEY = "USERNAME";
    const EMPLOYEE_ID_KEY = "EMPLOYEE_ID";
    const SESSION_KEY = "SESSION";

    public function login(Request $request) {
        $username = $request->get('username');
        $employee = User::where("username", $username)->first();

        if ($employee) {
            $submittedPassword = $request->get('password');
            $submittedPasswordHash = bcrypt($submittedPassword);
            $employeePassword = $employee->password;
            if (strcmp($submittedPasswordHash, $employeePassword)) {
                $request->session()->put(self::USERNAME_KEY, $employee->username);
                $request->session()->put(self::EMPLOYEE_ID_KEY, $employee->id);
                return redirect(route('home'));
            }
        }

        return redirect(route('login'))->withErrors('كلمة المرور او اسم المستخدم غير صحيح');
    }

    public function logout(Request $request) {
        $employeeId = $request->session()->get(self::EMPLOYEE_ID_KEY);
        $employee = User::find($employeeId);
        $employee->session = null;
        $employee->save();
        $request->session()->remove(self::USERNAME_KEY);
        $request->session()->remove(self::EMPLOYEE_ID_KEY);
        $request->session()->remove(self::SESSION_KEY);
        return redirect(route("login"));
    }
}
