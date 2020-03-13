<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function principal(){
        return view('principal');
    }
    public function redirect()
    {
        // User role
        $role =  Auth::user()->roles()->pluck('name')->implode(' ');

        // Check user role
        switch ($role) {
            case 'SuperAdmin':
                return redirect('/list');
                break;
            case 'admin_ESTM':
                return redirect('/list_estm');
                break;
            case 'Agent_ESTM':
                return redirect('/list_estm');
                break;
            case 'admin_FS':
                return redirect('/list_fs');
                break;
            case 'admin_FST':
                return redirect('/list_fst');
                break;
            case 'admin_FSLH':
                return redirect('/list_fslh');
                break;
            case 'admin_ENS':
                return redirect('/list_ens');
                break;
            case 'admin_ENSAM':
                return redirect('/list_ensam');
                break;
            case 'admin_FSJES':
                return redirect('/list_fsjes');
                break;
            case 'admin_FPE':
                return redirect('/list_fpe');
                break;
            case 'Responsable':
                return redirect('/statistique_all');
                break;
            default:
                return redirect('/login');
                break;
        }
    }
    public function redirect_stat()
    {
        // User role
        $role =  Auth::user()->roles()->pluck('name')->implode(' ');

        // Check user role
        switch ($role) {
            case 'SuperAdmin':
                return redirect('/statistique_all');
                break;
            case 'admin_ESTM':
                return redirect('/statistique_estm_all');
                break;
            case 'Agent_ESTM':
                return redirect('/statistique_stm_all');
                break;
            case 'admin_FS':
                return redirect('/statistique_fs_all');
                break;
            case 'admin_FST':
                return redirect('/statistique_fst_all');
                break;
            case 'admin_FSLH':
                return redirect('/statistique_fslh_all');
                break;
            case 'admin_ENS':
                return redirect('/statistique_ens_all');
                break;
            case 'admin_ENSAM':
                return redirect('/statistique_ensam_all');
                break;
            case 'admin_FSJES':
                return redirect('/statistique_fsjes_all');
                break;
            case 'admin_FPE':
                return redirect('/statistique_fpe_all');
                break;
            case 'Responsable':
                return redirect('/statistique_all_all');
                break;
            default:
                return redirect('/login');
                break;
        }
    }
    public function redirect_opi()
    {
        // User role


        // Check user role
        return redirect('/opi');
    }
    public function redirect_users()
    {
        // User role


        // Check user role
        return redirect('/users');
    }
}
