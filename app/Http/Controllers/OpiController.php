<?php

namespace App\Http\Controllers;

use App\Inscription_pedagogique;
use App\Opi;
use App\Opi_etab;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
class OpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'clearance']);
    }
    public function index()
    {
        //
        $list=DB::table('opis')->orderBy('nom_etud_fr','ASC')->get();

        $filieres = DB::table('filieres')->get();
       // $diplomes = DB::table('diplomes')->get();
        $province = DB::table('provinces')->get();
        $academie = DB::table('academies')->get();
        $serie = DB::table('serie_bacs')->get();
        $etablissements = DB::table('etablissements')->get();
        return view('OPI.opi',['data'=>$list,'filieres'=>$filieres,'provinces'=>$province,'serie'=>$serie,'academies'=>$academie]);
    }

     public function data(Request $request){

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
          else {

              $data = Opi::find($request->id_etudiant_opi);
              var_dump($data);
              /* $data->nom_prenom_etud_fr= ($request->nom_prenom_etud_fr);
               $data->nom_prenom_etud_ar = ($request->nom_prenom_etud_ar);
               $data->cni_etudiant = ($request->cni_etudiant);
               $data->sex_etudiant = ($request->sex_etudiant);
               $data->annee_baccalaureat = ($request->annee_baccalaureat);
               $data->save ();
               return response ()->json ( $data );*/
          }
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'nom_prenom_etud_fr' => 'required',
            'nom_prenom_etud_ar' => 'required',

            'cni_etudiant' => 'required',
            'date_naissance_etud' => 'required',
            'sexe_etudiant' => 'required',
            'annee_baccalaureat' => 'required',
        ]);

        $data =new Opi();
        $data->nom_prenom_etud_fr= ($request->input('nom_prenom_etud_fr'));
        $data->nom_prenom_etud_ar = ($request->input('nom_prenom_etud_ar'));
        $data->cni_etudiant = ($request->input('cni_etudiant'));
        $data->sexe_etudiant = ($request->input('sexe_etudiant'));
        $data->annee_baccalaureat = ($request->input('annee_baccalaureat'));
        $data->moyene_baccalaureat = ($request->input('moyene_baccalaureat'));
        $data->province = ($request->input('province'));
        $data->code_academie = ($request->input('code_academie'));
        $data->code_serie_baccalaureat = ($request->input('code_serie_baccalaureat'));
        $data->lieu_naissance_etud_fr = ($request->input('lieu_naissance_etud_fr'));
        $data->lieu_naissance_etud_ar = ($request->input('lieu_naissance_etud_ar'));
        $data->prenom_etud_fr = ($request->input('prenom_etud_fr'));
        $data->nom_etud_fr = ($request->input('nom_etud_fr'));
        $data->prenom_etud_ar = ($request->input('prenom_etud_ar'));
        $data->nom_etud_ar = ($request->input('nom_etud_ar'));

        $data->save ();
        return redirect('/opi')->withSuccMsg(' data saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'nom_prenom_etud_fr' => 'required',
            'nom_prenom_etud_ar' => 'required',

            'cni_etudiant' => 'required',
            'date_naissance_etud' => 'required',
            'sexe_etudiant' => 'required',
            'annee_baccalaureat' => 'required',
        ]);

        $data = Opi::find ($id);
        $data->nom_prenom_etud_fr= ($request->input('nom_prenom_etud_fr'));
        $data->nom_prenom_etud_ar = ($request->input('nom_prenom_etud_ar'));
        $data->cni_etudiant = ($request->input('cni_etudiant'));
        $data->sexe_etudiant = ($request->input('sexe_etudiant'));
        $data->annee_baccalaureat = ($request->input('annee_baccalaureat'));
        $data->moyene_baccalaureat = ($request->input('moyene_baccalaureat'));
        $data->province = ($request->input('province'));
        $data->code_academie = ($request->input('code_academie'));
        $data->code_serie_baccalaureat = ($request->input('code_serie_baccalaureat'));
        $data->lieu_naissance_etud_fr = ($request->input('lieu_naissance_etud_fr'));
        $data->lieu_naissance_etud_ar = ($request->input('lieu_naissance_etud_ar'));
        $data->prenom_etud_fr = ($request->input('prenom_etud_fr'));
        $data->nom_etud_fr = ($request->input('nom_etud_fr'));
        $data->prenom_etud_ar = ($request->input('prenom_etud_ar'));
        $data->nom_etud_ar = ($request->input('nom_etud_ar'));

        $data->save ();
        return redirect('/opi')->withUpdMsg('Data updaated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $opi=Opi::find($id);
        $opi->delete();
        return redirect('/opi')->withDelMsg(' data deleted successfully');
    }
    public function export(){
       // $filieres = DB::table('filieres')->get();
       // return view('OPI.export',['filieres'=>$filieres]);
        $user = Auth::user();
       $role =  $user->roles()->pluck('name')->implode(' ');
        $code_etab=0;
        switch ($role) {
            case 'SuperAdmin':
                $code_etab=666;
                break;
            case 'admin_ESTM':
                $code_etab=72;
                break;
            case 'admin_FS':
                $code_etab=47;
                break;
            case 'admin_FST':
                $code_etab=52;
                break;
            case 'admin_FSLH':
                $code_etab=35;
                break;
            case 'admin_ENS':
                $code_etab=203;
                break;
            case 'admin_ENSAM':
                $code_etab=145;
                break;
            case 'admin_FSJES':
                $code_etab=21;
                break;
            default:
                break;
        }
       if($code_etab!=666) {
           $filieres = DB::table('filieres')
               ->where('code_etablissement', $code_etab)
               ->get();
       }
        else{
            $filieres = DB::table('filieres')->get();
        }

        return view('OPI.export',['filieres'=>$filieres]);
    }

    public function import(Request $request){
        if($request->hasFile('etud')){
            $path=$request->file('etud')->getRealPath();
            $data= Excel::load($path)->get();
            if($data->count()){
                foreach($data as $key => $value){
                    $etud_list[] = ['code_massar' =>$value->code_massar,'nom_prenom_etud_fr' =>$value->nom_prenom_etud_fr];
                }
            }

            for($i =0;$i<sizeof($etud_list);$i++){
                $etud [] = DB::table('opis')
                    ->where('code_massar',$etud_list[$i]['code_massar'])
                    ->get();
                if($etud[$i]->count()==0){
                    $etud_not_found[]=['code_massar' =>$etud_list[$i]['code_massar'],'nom_prenom_etud_fr' =>$etud_list[$i]['nom_prenom_etud_fr']];
                }

            }
            for($i =0;$i<sizeof($etud);$i++){
                if($etud[$i]->count()) {
                    //var_dump($etud[$i][0]->code_massar);
                }
            }

            echo ' ------------value not found -----------';
            foreach($etud_not_found as  $etu){
              //  var_dump($etu['code_massar']);
                //  var_dump($etu['nom_prenom_etud_fr']);
            }
           $count_not_found =sizeof($etud_not_found);
            $count_found =0;
            for($i =0;$i<sizeof($etud);$i++) {
                if($etud[$i]->count()) {
                    $code = $etud[$i][0]->code_massar . "";
                    strtoupper($code);
                   // var_dump($code);
                    // $req="SELECT EXISTS (SELECT * FROM opi_tests WHERE code_massar='$code' ) AS article_exists ;";
                    //echo $req;
                    $test = DB::select("SELECT EXISTS (SELECT * FROM opi_etabs WHERE code_massar='$code' ) AS article_exists ;");
                    // echo ' vl: '.$test[0]->article_exists;
                   // var_dump($test[0]->article_exists);
                }
                //  break;
                if($etud[$i]->count() && $test[0]->article_exists==false ) {
                    $count_found++;
                    $opi = new Opi_etab();
                    $opi->id_etudiant_opi_etab = $etud[$i][0]->id_etudiant_opi;
                    $opi->code_filiere = $request->input('code_fil');
                    $opi->annee_import= date("Y-m-d");;
                    $opi->nom_prenom_etud_fr = $etud[$i][0]->nom_prenom_etud_fr;
                    $opi->nom_prenom_etud_fr= $etud[$i][0]->nom_prenom_etud_fr;
                    $opi->cni_etudiant= $etud[$i][0]->cni_etudiant;
                    $opi->sexe_etudiant= $etud[$i][0]->sexe_etudiant;
                    $opi->annee_baccalaureat= $etud[$i][0]->annee_baccalaureat;
                    $opi->moyene_baccalaureat= $etud[$i][0]->moyene_baccalaureat;
                    $opi->province= $etud[$i][0]->province;
                    $opi->code_academie= $etud[$i][0]->code_academie;
                    $opi->code_serie_baccalaureat= $etud[$i][0]->code_serie_baccalaureat;
                    $opi->code_massar= $etud[$i][0]->code_massar;
                    $opi->lieu_naissance_etud_fr= $etud[$i][0]->lieu_naissance_etud_fr;
                    $opi->lieu_naissance_etud_ar= $etud[$i][0]->lieu_naissance_etud_ar;
                    $opi->prenom_etud_fr= $etud[$i][0]->prenom_etud_fr;
                    $opi->nom_etud_fr= $etud[$i][0]->nom_etud_fr;
                    $opi->nom_etud_ar= $etud[$i][0]->nom_etud_ar;
                    $opi->prenom_etud_ar= $etud[$i][0]->prenom_etud_ar;
                    $opi->save();

                }
            }
            // var_dump($etud_not_found);

        }
        Session::put('etud_nf',$etud_not_found);
        Session::put('count_nf',$count_not_found);
        Session::put('count_f',$count_found);
        $count_exist_deja=sizeof($etud)-$count_not_found-$count_found;
        Session::put('count_deja',$count_exist_deja);
        return back();
    }

    public function recherche(){
        return view('OPI.recherche');
    }

    public function transfert(Request $request){
        // $filieres = DB::table('filieres')->get();
        // return view('OPI.export',['filieres'=>$filieres]);
        $user = Auth::user();
        $role =  $user->roles()->pluck('name')->implode(' ');
        $code_etab=0;
        switch ($role) {
            case 'SuperAdmin':
                $code_etab=666;
                break;
            case 'admin_ESTM':
                $code_etab=72;
                break;
            case 'admin_FS':
                $code_etab=47;
                break;
            case 'admin_FST':
                $code_etab=52;
                break;
            case 'admin_FSLH':
                $code_etab=35;
                break;
            case 'admin_ENS':
                $code_etab=203;
                break;
            case 'admin_ENSAM':
                $code_etab=145;
                break;
            case 'admin_FSJES':
                $code_etab=21;
                break;
            default:
                break;
        }
        if($code_etab!=666) {
            $filieres = DB::table('filieres')
                ->where('code_etablissement', $code_etab)
                ->get();
        }
        else{
            $filieres = DB::table('filieres')->get();
        }


        $id=$request->input('id_etud_opi');
        $list=DB::table('opis')
            ->where('id_etudiant_opi',$id)
            ->get();
        $province=DB::table('provinces')
            ->where('code_province_opi',$list[0]->province)
            ->get();
        $lib_prov=$province[0]->libelle_province_fr;

      return view('OPI.transfert',['filieres'=>$filieres,'opi'=>$list,'lib_prov'=>$lib_prov]);
    }

    public function upd_transfert(Request $request,$id){
        $data = Opi_etab::find ($id);
        $data->code_filiere= ($request->input('code_fil'));
        $data->save ();
        return redirect('/opi')->withUpdMsg('Data updaated successfully !!');

    }
    public function fi(){
        return view ('first');

    }
}
