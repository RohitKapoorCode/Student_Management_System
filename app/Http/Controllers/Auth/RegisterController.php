<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // Ye line dhyan se check karna (zaroori hai)

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Registration ke baad kahan bhejna hai
     */
    protected $redirectTo = '/login'; // Line 32: Ise humne '/login' kar diya hai

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * --- YE WALA FUNCTION SAARI GAME BADLEGA ---
     * Registration hote hi ye function chalega
     */
    protected function registered(Request $request, $user)
    {
        // 1. User ko logout kar do taaki auto-login na ho
        auth()->logout();

        // 2. Wapas login page par bhej do ek message ke saath
        return redirect('/login')->with('success', 'Account created! Please login now.');
    }
}