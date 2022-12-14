<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller  
{

    public function redirectToLogin()
    {
        return redirect()->route('admin.login');
    }
        /**
     * Store a newly created resource in storage.
     * 驗證 email 格式，password required
     * 
     *
     * @return \Illuminate\Http\Response
     */
    //post login
    // public function store(Request $request)
    public function login()
    {

        Log::info("============= user login: =============");
        Log::info(request()->headers);
        $this->validate(request(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->ReturnJsonFailMsg(config("app.error_code.invalid_password_or_email"));
        }
        $user = auth()->user();

        return $this->ReturnJsonSuccessMsg([
            "_token" => $token,
            "id" => $user->id,
            "account" => $user->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // auth()->guard()->logout();

        return $this->ReturnJsonSuccessMsg('OK');
    }

    public function TokenVerify()
    {
        Log::info("=============TokenVerify user:=============");
        $user = auth()->user();
        Log::info($user);
        Log::info("=============TokenVerify header:=============");
        Log::info(request()->headers);
        // return $this->ReturnJsonSuccessMsg($user);
        // return "hello";

        if (!is_null($user))
            return $this->ReturnJsonSuccessMsg("");
        else
            return $this->ReturnJsonFailMsg("");

    }
}
