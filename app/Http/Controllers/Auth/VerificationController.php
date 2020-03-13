<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    public function redirectTo()
    {
        // User role
        $role =  Auth::user()->roles()->pluck('name');;

        // Check user role
        switch ($role) {
            case 'SuperAdmin':
                return '/list';
                break;
            case 'admin_ESTM':
                return '/list_estm';
                break;
            default:
                return '/login';
                break;
        }
    }
   /* public function redirectTo()
    {
        // User role
        $role = Auth::user()->role->name;

        // Check user role
        switch ($role) {
            case 'SuperAdmin':
                return '/list';
                break;
            case 'admin_estm':
                return '/list_estm';
                break;
            default:
                return '/login';
                break;
        }
    }
*/
   /* public function authenticated($request , $user){
        switch ($user->rol){
            case 'SuperAdmin':
                return redirect()->route('list') ;
            case 'admin_estm':
                return redirect()->route('list_estm') ;
            default:
                return redirect()->route('home') ;
        }
    }*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
