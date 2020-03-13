<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
        $this->middleware(function($request,$next){
            if(session('succ_msg')) {

                Alert::success('Success !!', session('succ_msg'));
            }
            if(session('del_msg')) {
                alert()->warning('Warning !!',session('del_msg'));

            }
            if(session('upd_msg')) {
                alert()->info('Info About your Update',session('upd_msg'));

            }

            return $next($request);

        });
    }
}
