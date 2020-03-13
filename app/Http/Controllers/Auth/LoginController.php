<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = '/list';

    public function redirectTo()
    {
        // User role
        $role =  Auth::user()->roles()->pluck('name')->implode(' ');

        // Check user role
       /* switch ($role) {
            case 'SuperAdmin':
                return '/list';
                break;
            case 'admin_ESTM':
                return '/list_estm';
                break;
            case 'Agent_ESTM':
                return '/list_estm';
                break;
            case 'admin_FS':
                return '/list_fs';
                break;
            case 'admin_FST':
                return '/list_fst';
                break;
            case 'admin_FSLH':
                return '/list_fslh';
                break;
            case 'admin_ENS':
                return '/list_ens';
                break;
            case 'admin_ENSAM':
                return '/list_ensam';
                break;
            case 'admin_FSJES':
                return '/list_fsjes';
                break;
            case 'admin_FPE':
                return '/list_fpe';
                break;
            case 'Responsable':
                return '/statistique_all';
                break;
            default:
                return '/login';
                break;
        }*/
        return '/principal';
    }
   public function logout()
    {
        Auth::logout();

        return view('auth.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */


}
