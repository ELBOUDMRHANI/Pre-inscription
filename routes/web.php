<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Opi;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('index', 'EtudiantController@index');

Route::get('list', 'EtudiantController@lists');
Route::get('list_estm', 'EtudiantController@listEstm');
Route::get('list_fs', 'EtudiantController@listFS');
Route::get('list_fst', 'EtudiantController@listFST');
Route::get('list_fpe', 'EtudiantController@listFPE');
Route::get('list_fslh', 'EtudiantController@listFSLH');
Route::get('list_ens', 'EtudiantController@listENS');
Route::get('list_ensam', 'EtudiantController@listENSAM');
Route::get('list_fsjes', 'EtudiantController@listFSJES');
Route::get('principal', 'HomeController@principal');
Route::get('lst', 'HomeController@redirect');
Route::get('lst_stat', 'HomeController@redirect_stat');
Route::get('lst_opi', 'HomeController@redirect_opi');
Route::get('lst_users', 'HomeController@redirect_users');

Route::get('err', 'StatistiqueController@error');
Route::delete('list/{id_etudiant}','EtudiantController@destroy');
Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);
    //App::setLocale($locale);
    //return redirect()->back();
    // Artisan::call('view:clear');
    //App::make('redirect')->refresh();
    return redirect(url()->previous());
    //var_dump(url()->previous());
    // return redirect()->back()->refrash();
    // App::make('redirect')->back();
    //return back();
    //  var_dump($locale);
});
Route::get('/{id_etudiant}/dowcarte','EtudiantController@dowcartepdf');
Route::get('/{id_etudiant}/recu','EtudiantController@recu');
Route::get('/{id_etudiant}/viewcarte','EtudiantController@viewcarte');
Route::match(['get', 'post'],'filtre','EtudiantController@filtre');
Route::match(['get', 'post'],'filtre_estm','EtudiantController@filtre_estm');
Route::match(['get', 'post'],'filtre_fs','EtudiantController@filtre_fs');
Route::match(['get', 'post'],'filtre_fst','EtudiantController@filtre_fst');
Route::match(['get', 'post'],'filtre_fpe','EtudiantController@filtre_fpe');
Route::match(['get', 'post'],'filtre_fslh','EtudiantController@filtre_fslh');
Route::match(['get', 'post'],'filtre_ens','EtudiantController@filtre_ens');
Route::match(['get', 'post'],'filtre_ensam','EtudiantController@filtre_ensam');
Route::match(['get', 'post'],'filtre_fsjes','EtudiantController@filtre_fsjes');
Route::match(['get', 'post'],'filtredip','EtudiantController@filtredip');
Route::match(['get', 'post'],'filtredip_estm','EtudiantController@filtredip_estm');
Route::match(['get', 'post'],'filtredip_fs','EtudiantController@filtredip_fs');
Route::match(['get', 'post'],'filtredip_fst','EtudiantController@filtredip_fst');
Route::match(['get', 'post'],'filtredip_fpe','EtudiantController@filtredip_fpe');
Route::match(['get', 'post'],'filtredip_fslh','EtudiantController@filtredip_fslh');
Route::match(['get', 'post'],'filtredip_ens','EtudiantController@filtredip_ens');
Route::match(['get', 'post'],'filtredip_ensam','EtudiantController@filtredip_ensam');
Route::match(['get', 'post'],'filtredip_fsjes','EtudiantController@filtredip_fsjes');
Route::match(['get', 'post'],'filtrefil','EtudiantController@filtrefil');
Route::match(['get', 'post'],'resultfiltre','EtudiantController@resultfiltre');
Route::get('list_opi','OpiController@index');
Route::get('export','OpiController@export');
//Route::get('data','OpiController@data');
Route::get('recherche','OpiController@recherche');
Route::get('transfert','OpiController@transfert');
Route::put('upd_transfert/{id_etudiant_opi}','OpiController@upd_transfert');

//Route::get('opi','OpiController@opi');
Route::resource('/opi','OpiController');
Route::resource('/filiere','FiliereController');

Route::get('cne','FiliereController@cne');
Route::get('dem','FiliereController@dem');
Route::put('updi/{id_etudiant}','FiliereController@updi');
Route::get('cneestm','FiliereController@cneestm');
Route::get('demestm','FiliereController@demestm');
Route::get('cneens','FiliereController@cneens');
Route::get('demens','FiliereController@demens');
Route::get('cneensam','FiliereController@cneensam');
Route::get('demensam','FiliereController@demensam');
Route::get('cnefpe','FiliereController@cnefpe');
Route::get('demfpe','FiliereController@demfpe');
Route::get('cnefst','FiliereController@cnefst');
Route::get('demfst','FiliereController@demfst');
Route::get('cnefs','FiliereController@cnefs');
Route::get('demfs','FiliereController@demfs');
Route::get('cneflsh','FiliereController@cneflsh');
Route::get('demefslh','FiliereController@demflsh');
Route::get('cnefsjes','FiliereController@cnefsjes');
Route::get('demefsjes','FiliereController@demfsjes');
Route::get('/sendemail', 'SendEmailController@index');
Route::match(['get', 'put','post'],'/sendemail/send', 'SendEmailController@sendmail');
Route::get('/recu_info', 'EtudiantController@info_recu');
Route::get('/valide_recu', 'EtudiantController@valide_recu');


Route::put('product-import','OpiController@import');
Route::get('profil','EtudiantController@profil');
Route::get('profil_cne/{id_etudiant}','EtudiantController@profil_cne');
Route::put('modif/{id_etudiant}','EtudiantController@upd');
Route::match(['get', 'post'],'upload', 'EtudiantController@upload');
Route::match(['get', 'put','post'],'retrait/{id_etudiant}','EtudiantController@retrait');
Route::match(['get', 'put','post'],'valider/{id_etudiant}','EtudiantController@valider');

//Route::post('upload/{id_etudiant}/{abreviation_etablissement}', 'EtudiantController@upload');
Route::get('/image', 'EtudiantController@image');


//// test

Route::get('/fi', 'OpiController@fi');
////

//////// routes sttistiques
Route::get('/statistique', 'StatistiqueController@stat');
Route::get('/statistique_all', 'StatistiqueController@stat_fil_all');
Route::get('/statistique_ens_all', 'StatistiqueController@stat_ens_all');
Route::get('/statistique_estm_all', 'StatistiqueController@stat_estm_all');
Route::get('/statistique_ensam_all', 'StatistiqueController@stat_ensam_all');
Route::get('/statistique_fs_all', 'StatistiqueController@stat_fs_all');
Route::get('/statistique_fsjes_all', 'StatistiqueController@stat_fsjes_all');
Route::get('/statistique_fst_all', 'StatistiqueController@stat_fst_all');
Route::get('/statistique_fpe_all', 'StatistiqueController@stat_fpe_all');
Route::get('/statistique_flsh_all', 'StatistiqueController@stat_flsh_all');

Route::get('/statistique_estm', 'StatistiqueController@stat_estm');
Route::get('/statistique_fs', 'StatistiqueController@stat_fs');
Route::get('/statistique_fsjes', 'StatistiqueController@stat_fsjes');
Route::get('/statistique_flsh', 'StatistiqueController@stat_flsh');
Route::get('/statistique_fst', 'StatistiqueController@stat_fst');
Route::get('/statistique_ensam', 'StatistiqueController@stat_ensam');
Route::get('/statistique_ens', 'StatistiqueController@stat_ens');
Route::get('/statistique_fpe', 'StatistiqueController@stat_fpe');
Route::get('/stat_prov', 'StatistiqueController@stat_prov');
Route::get('/stat_prov_estm', 'StatistiqueController@stat_prov_estm');
Route::get('/stat_prov_fsjes', 'StatistiqueController@stat_prov_fsjes');
Route::get('/stat_prov_fs', 'StatistiqueController@stat_prov_fs');
Route::get('/stat_prov_flsh', 'StatistiqueController@stat_prov_flsh');
Route::get('/stat_prov_fst', 'StatistiqueController@stat_prov_fst');
Route::get('/stat_prov_ensam', 'StatistiqueController@stat_prov_ensam');
Route::get('/stat_prov_ens', 'StatistiqueController@stat_prov_ens');
Route::get('/stat_prov_fpe', 'StatistiqueController@stat_prov_fpe');
Route::get('/stat_aca', 'StatistiqueController@stat_aca');
Route::get('/stat_aca_estm', 'StatistiqueController@stat_aca_estm');
Route::get('/stat_aca_fsjes', 'StatistiqueController@stat_aca_fsjes');
Route::get('/stat_aca_fs', 'StatistiqueController@stat_aca_fs');
Route::get('/stat_aca_flsh', 'StatistiqueController@stat_aca_flsh');
Route::get('/stat_aca_fst', 'StatistiqueController@stat_aca_fst');
Route::get('/stat_aca_ensam', 'StatistiqueController@stat_aca_ensam');
Route::get('/stat_aca_ens', 'StatistiqueController@stat_aca_ens');
Route::get('/stat_aca_fpe', 'StatistiqueController@stat_aca_fpe');
Route::get('/stat_fil', 'StatistiqueController@stat_fil');
Route::get('/stat_fil_estm', 'StatistiqueController@stat_fil_estm');
Route::get('/stat_fil_fsjes', 'StatistiqueController@stat_fil_fsjes');
Route::get('/stat_fil_fs', 'StatistiqueController@stat_fil_fs');
Route::get('/stat_fil_flsh', 'StatistiqueController@stat_fil_flsh');
Route::get('/stat_fil_fst', 'StatistiqueController@stat_fil_fst');
Route::get('/stat_fil_ensam', 'StatistiqueController@stat_fil_ensam');
Route::get('/stat_fil_ens', 'StatistiqueController@stat_fil_ens');
Route::get('/stat_fil_fpe', 'StatistiqueController@stat_fil_fpe');
Route::get('/stat_bac', 'StatistiqueController@stat_bac');
Route::get('/stat_bac_estm', 'StatistiqueController@stat_bac_estm');
Route::get('/stat_bac_fs', 'StatistiqueController@stat_bac_fs');
Route::get('/stat_bac_fsjes', 'StatistiqueController@stat_bac_fsjes');
Route::get('/stat_bac_flsh', 'StatistiqueController@stat_bac_flsh');
Route::get('/stat_bac_fst', 'StatistiqueController@stat_bac_fst');
Route::get('/stat_bac_ensam', 'StatistiqueController@stat_bac_ensam');
Route::get('/stat_bac_ens', 'StatistiqueController@stat_bac_ens');
Route::get('/stat_bac_fpe', 'StatistiqueController@stat_bac_fpe');

Route::get('err', 'StatistiqueController@error');
Route::get('listopi', function(){
    $data = Opi::all ();
    return view ( 'OPI.listopi' )->withData ( $data );
});
Route::post ( '/editItem', function (Request $request) {
/*
    $rules = array (
        'nom_prenom_etud_fr' => 'required|alpha',
        'nom_prenom_etud_ar' => 'required|alpha',
        'sex_etudiant' => 'required',

        'date_naissance_etud' => 'required|alpha',
        'cni_etudiant' => 'required|alpha',
        'annee_baccalaureat' => 'required|alpha'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (
            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {*/

        $data = Opi::find ($request->id_etudiant_opi);
        $data->nom_prenom_etud_fr= ($request->nom_prenom_etud_fr);
        $data->nom_prenom_etud_ar = ($request->nom_prenom_etud_ar);
        $data->cni_etudiant = ($request->cni_etudiant);
        $data->sex_etudiant = ($request->sex_etudiant);
        $data->annee_baccalaureat = ($request->annee_baccalaureat);
        $data->save ();
        return back();
   // }
} );

///////////////////////////////
Route::get('/test', 'EtudiantController@test');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create_role_permissoin',function(){
    $role = Role::create(['name' => 'SuperAdmin']);
    $permission = Permission::create(['name' => 'Admin all roles & permissions']);
    auth()->user()->assignRole('SuperAdmin');
    auth()->user()->givePermissionTo('Admin all roles & permissions');
});
Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

