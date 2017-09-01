<?php
/**
 * User: hitman
 * Date: 24/08/2017
 * Time: 4:08 PM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function postLogin(Request $request)
    {
        $name = $request->get('name');
        $password = $request->get('password');

        if($this->guard()->attempt(['name' => $name, 'password' => $password])) {
            return redirect()->intended('/admin/');
        }

        return redirect('/admin/login');
    }

    public function getLogin()
    {
        return view('vendor.toolbox.login');
    }
}
