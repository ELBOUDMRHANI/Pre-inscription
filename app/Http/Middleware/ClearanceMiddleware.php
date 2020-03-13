<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('Admin all roles & permissions')) //If user has this //permission
        {

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
        }


        if ($request->is('posts/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Post'))
            {
                return view('error.401');
            }
            else {
                return $next($request);
            }
        }
        // test sur les routes des sttistiques
      //  ('statistique_estm|statistique_ensam|statistique_ens|statistique_flsh|statistique_fpe|statistique_fs|statistique_fsjes|statistique_fst'))//If user has permission to list
        if ($request->is('statistique_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_all'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('statistique_estm'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_estm_all'))
            {
                return redirect(URL::to('err'));
               // return redirect()->route('err');
            }
            else {
               // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('statistique_ensam'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_ensam_all'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
          if ($request->is('statistique_flsh_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_flsh'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
          if ($request->is('statistique_ens_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_ens'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('statistique_fpe_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_fpe'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('statistique_fs_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_fs'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
         if ($request->is('statistique_fst_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_fst'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('statistique_fsjes_all'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Statistique_fsjes'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }

///////////////////////////////////////
        // // test sur les routes des listes des étudiants
        if ($request->is('list'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_all'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_estm'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_estm'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_ensam'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_ensam'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_flsh'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_flsh'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_ens'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_ens'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_fpe'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_fpe'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_fs'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_fs'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_fst'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_fst'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('list_fsjes'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_fsjes'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }

 ///////////////////////////////////////
        // list changement filiere

        if ($request->is('cne'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_all'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cneestm'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_estm'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cneensam'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_ensam'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cneflsh'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_flsh'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cneens'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_ens'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cnefpe'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_fpe'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cnefs'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_fs'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cnefst'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_fst'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('cnefsjes'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Cne_fsjes'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }

/////////////////////////////////
         // gestion opi
        if ($request->is('opi'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_Opi'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('recherche'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Transfert'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
        if ($request->is('export'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('Export'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }
/////////////////////////////////////////////
        // gestion filieres
        if ($request->is('filiere'))//If user has permission to list estm
        {
            if (!Auth::user()->hasPermissionTo('List_filiere'))
            {
                return redirect(URL::to('err'));
                // return redirect()->route('err');
            }
            else {
                // var_dump(Auth::user()->hasPermissionTo('lister'));
                return $next($request);
            }
        }






        /////////////////////////////////////
        if ($request->is('posts/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                return view('error.401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete')) {
                return view('error.401');
            }
            else
            {
                return $next($request);
            }
        }

        return $next($request);
    }
}