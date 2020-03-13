<?php

namespace App\Http\Controllers;
use App\Dossier_amo;
use App\Info_recu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Etudiant;
use App\Inscription_pedagogique;
use App\Filiere;
use Intervention\Image\Facades\Image;
use PDF;
use Dompdf\Dompdf;

class EtudiantController extends Controller
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
        return view('index');
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
      //  $etudiant = Etudiant::find($id);
        $etud = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->where('etudiants.id_etudiant',$id)
            ->get();
        $etudiant = Etudiant::find($id);
        $dossier_amo = Dossier_amo::find($id);
        $inscription_pedagogique = Inscription_pedagogique::find($id);
        if($dossier_amo)
        $dossier_amo->delete();
        if($inscription_pedagogique)
        $inscription_pedagogique->delete();
        $etudiant->delete();


        return back();
    }
    public function retrait(Request $request, $id)
    {
        $ins = Inscription_pedagogique::find($id);
        $ins->validation = false;;

        $ins->save();
        return back();
        //
    }
    public function valider(Request $request, $id)
    {
        $ins = Inscription_pedagogique::find($id);
        $ins->validation = true;

        $ins->save();
        return back();
        //
    }
     public function lists(){
         $list = DB::table('etudiants')
             ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
             ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
             ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
             ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
             ->orderBy('nom_etudiant_fr','ASC')
             ->paginate(10);
         $filieres = DB::table('filieres')->get();
         $diplomes = DB::table('diplomes')->get();
         $etablissements = DB::table('etablissements')->get();
         return view('etudiant.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);

     }
    public function listEstm(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        //var_dump($list_all);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',72)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
       // $role =  Auth::user()->roles()->pluck('name');
       /* echo $role;
        foreach($list as $l):
        var_dump($l->nom_etudiant_fr);
            endforeach;*/

        return view('etudiantEstm.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);

    }
    public function listFS(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',47 )
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        //var_dump($list_all);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',47)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();

        return view('etudiantFS.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);

    }
    public function listFST(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',52)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',52)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantFST.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }
    public function listFPE(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',166)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',166)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantFPE.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }
    public function listFSLH(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',35)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',35)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantFSLH.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }
    public function listENS(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',203)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',203)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantENS.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }
    public function listENSAM(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',145)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',145)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantENSAM.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }
    public function listFSJES(){
        $list= DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',21)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->paginate(10);
        $filieres=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',21)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        return view('etudiantFSJES.list',['etudiants'=>$list,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
    }

    function upload(Request $request)
    {
        /*$this->validate($request, [
            'image_profile'  => 'required|image|mimes:jpg,png,gif|max:2048'
        ]);*/

      $image = $request->file('image_profile');

       // $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image->getClientOriginalName());
        //echo dd(Input::all());
     //  echo dd(Request::file("logo"));
      //  echo dd($request->file('image_profile'));
        return back()->with('success', 'Image Uploaded Successfully')->with('path', $image->getClientOriginalName());
    }
    public function image(){
        return view('etudiant.image');
    }
    public function filtre(Request $request){
        //    var_dump($codediplome);
        //  $filieres = DB::table('filieres')->get();
        $filieres = DB::table('filieres')->get();
        $diplomes = DB::table('diplomes')->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
           // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
           // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
           // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement=$filiere[0]->code_etablissement;
            $codediplome=$filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat',$codeetablisement)->get();
            $abr_etab=$etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
           // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes= DB::table('diplomes')->get();
            $filieres= DB::table('filieres')->get();
            $academies= DB::table('academies')->get();
            $provinces= DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'filiere' => $filiere,'filieres' => $filieres,'diplome' => $diplome,'diplomes' => $diplomes,'etablissement' => $etablissement,'etablissements' => $etablissements,'academie' => $academie,'academies' => $academies,'province' => $province,'provinces' => $provinces,'abr_etab' => $abr_etab]);

            //  return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'region' => $region,'regions' => $regions]);

        }
        $reqDip=$request->input('diplome_sl');
        if (!empty($reqDip) and isset($reqDip)){

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_sl'))->get();
            $codediplome= $diplome[0]->code_diplome;
            Session::put('codedip',$codediplome);
            // var_dump($codeetablissement);
            $filieres = DB::table('filieres')
                ->where('code_diplome', $codediplome)
                ->get();

            if(sizeof($filieres)==0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for($i =0;$i<sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud,'filieres' => $filieres]);
        }
        $reqFil=$request->input('filiere_sl');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')-> where('libelle_filiere',$request->input('filiere_sl'))->get();
            // var_dump($filiere);
            $codefil=$filiere[0]->code_filiere_stat;


            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->paginate(10);

            //$result = DB::table('etudiants')->where('etablissement', $codeetablissement)->where('diplome', $codediplome)->where('filiere', $codefiliere)->paginate(8);


            if(sizeof($etud)==0){
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiant.resultfiltre', ['etudiants' => $etud]);
        }
        $reqEtab=$request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)){
            $etablissement = DB::table('etablissements')-> where('etab',$request->input('etablissement'))->get();
            $codeetablissement=$etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre',['etudiants'=>$result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)){
            if($validation==7){
                $validation=0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('validation', $validation)
                ->paginate(10);
            return view('etudiant.filtre',['etudiants'=>$etud,'filieres' => $filieres,'diplomes' => $diplomes,'etablissements' => $etablissements]);
        }


        //  return view('etudiant.filtre',['etudiants'=>$results,'filieres' => $filieres]);
        //   return view('etudiant.filtre',['etudiants'=>$result1,'filieres' => $filieres]);

    }
    public function filtre_estm(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',72)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
            // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
            // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

            //  return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'region' => $region,'regions' => $regions]);

        }
        $reqDip = $request->input('diplome_estm');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_estm'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',72)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement', 72)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_estm');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_estm'))->get();
            // var_dump($filiere);
            $codefil = $filiere[0]->code_filiere_stat;


            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement', 72)
                ->paginate(10);

            //$result = DB::table('etudiants')->where('etablissement', $codeetablissement)->where('diplome', $codediplome)->where('filiere', $codefiliere)->paginate(8);


            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantEstm.resultfiltre_estm', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement', 72)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantEstm.filtre_estm', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_fs(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',47)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
            // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
            // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

            //  return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'region' => $region,'regions' => $regions]);

        }
        $reqDip = $request->input('diplome_fs');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fs'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',47)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement', 47)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_fs');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fs'))->get();
            // var_dump($filiere);
            $codefil = $filiere[0]->code_filiere_stat;


            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement', 47)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantEstm.resultfiltre_fs', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement', 47)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantFS.filtre_fs', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_fst(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',52)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
            // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
            // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

            //  return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'region' => $region,'regions' => $regions]);

        }
        $reqDip = $request->input('diplome_fst');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fst'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',52)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement', 52)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_fst');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fst'))->get();
            // var_dump($filiere);
            $codefil = $filiere[0]->code_filiere_stat;


            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement', 52)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantFST.resultfiltre_fst', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement', 52)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantFST.filtre_fst', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }

    public function filtre_fpe(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',166)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
            // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
            // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

            //  return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'region' => $region,'regions' => $regions]);

        }
        $reqDip = $request->input('diplome_fpe');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fpe'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',166)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement',166)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_fpe');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fpe'))->get();
            // var_dump($filiere);
            $codefil = $filiere[0]->code_filiere_stat;


            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement', 166)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantFPE.resultfiltre_fpe', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement',166)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantFPE.filtre_fpe', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_fslh(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',35)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

        }
        $reqDip = $request->input('diplome_fslh');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fslh'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',35)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement',35)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_fslh');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fslh'))->get();
            $codefil = $filiere[0]->code_filiere_stat;

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement',35)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantFSLH.resultfiltre_fslh', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement',35)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantFSLH.filtre_fslh', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_ens(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',203)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

        }
        $reqDip = $request->input('diplome_ens');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_ens'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',203)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement',203)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
                //     array_push($etuds,$etud);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_ens');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_ens'))->get();
            $codefil = $filiere[0]->code_filiere_stat;

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement',203)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantENS.resultfiltre_ens', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement',203)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantENS.filtre_ens', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_ensam(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',145)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

        }
        $reqDip = $request->input('diplome_ensam');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_ensam'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',145)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement',145)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_ensam');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_ensam'))->get();
            $codefil = $filiere[0]->code_filiere_stat;

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement',145)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantENSAM.resultfiltre_ensam', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement',145)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantENSAM.filtre_ensam', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtre_fsjes(Request $request)
    {

        $filieres=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        $diplomes = DB::table('diplomes')
            ->leftjoin('filieres', 'diplomes.code_diplome', '=', 'filieres.code_diplome')
            ->where('filieres.code_etablissement',21)
            ->select('diplomes.*')
            ->distinct()
            ->get();
        $etablissements = DB::table('etablissements')->get();
        $cin = $request->input('cin');
        if (!empty($cin) and isset($cin)) {
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('cni_etudiant', $cin)
                ->get();

            $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement = $filiere[0]->code_etablissement;
            $codediplome = $filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
            $abr_etab = $etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes = DB::table('diplomes')->get();
            $filieres = DB::table('filieres')->get();
            $academies = DB::table('academies')->get();
            $provinces = DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);

        }
        $reqDip = $request->input('diplome_fsjes');
        if (!empty($reqDip) and isset($reqDip)) {

            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fsjes'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);
            // var_dump($codeetablissement);
            $filieres=DB::table('filieres')
                ->where('code_etablissement',21)
                ->get();

            if (sizeof($filieres) == 0)
                return view('error.zero_filiere', ['diplome' => $diplome[0]->libelle_diplome_fr]);
            for ($i = 0; $i < sizeof($filieres); $i++) {
                //  var_dump($filieres[$i]->code_filiere_stat);

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->where('filieres.code_etablissement',21)
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
            }

            return view('etudiant.filieres', ['etudiants' => $etud, 'filieres' => $filieres]);
        }
        $reqFil = $request->input('filiere_fsjes');
        if (!empty($reqFil) and isset($reqFil)) {
            $filiere = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fsjes'))->get();
            $codefil = $filiere[0]->code_filiere_stat;

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->where('filieres.code_etablissement',21)
                ->paginate(10);

            if (sizeof($etud) == 0) {
                return view('error.zero_etudiant_sl', ['filiere' => $filiere[0]->libelle_filiere]);
            }

            return view('etudiantFSJES.resultfiltre_fsjes', ['etudiants' => $etud]);
        }
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab)) {
            $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->codeetab;
            $result3 = DB::table('etudiants')->where('etablissement', $codeetablissement)->paginate(8);
            return view('etudiant.filtre', ['etudiants' => $result3]);
        }
        $validation = $request->input('valide');
        if (!empty($validation) and isset($validation)) {
            if ($validation == 7) {
                $validation = 0;
            }
            //$etud = DB::table('etudiants')->where('validation', $validation)->paginate(10);
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('filieres.code_etablissement',21)
                ->where('validation', $validation)

                ->paginate(10);
            return view('etudiantFSJES.filtre_fsjes', ['etudiants' => $etud, 'filieres' => $filieres, 'diplomes' => $diplomes, 'etablissements' => $etablissements]);
        }
    }
    public function filtredip(Request $request){
        $reqEtab = $request->input('etablissement');
        if (!empty($reqEtab) and isset($reqEtab) ) {
            $etablissement = DB::table('etablissements')->where('libelle_etablissement_fr', $request->input('etablissement'))->get();
            $codeetablissement = $etablissement[0]->code_etablissement_stat;
            Session::put('codeetab',$codeetablissement);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome'))->get();
            $codediplome= $diplome[0]->code_diplome;
            Session::put('codedip',$codediplome);
            // var_dump($codeetablissement);
            $filieres = DB::table('filieres')
                ->where('code_etablissement', $codeetablissement)
                ->where('code_diplome', $codediplome)
                ->get();

            if(sizeof($filieres)==0)
                return view('error.zero_filiere', ['etablissement' => $etablissement[0]->libelle_etablissement_fr, 'diplome' => $diplome[0]->libelle_diplome_fr]);
            for($i =0;$i<sizeof($filieres); $i++) {

                $etud = DB::table('etudiants')
                    ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                    ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                    ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                    ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                    ->paginate(10);
            }

            return view('etudiant.filieres', ['etudiants' => $etud,'filieres' => $filieres]);
        }

    }
    public function filtredip_estm(Request $request){
        $reqFil= $request->input('filiere_estm');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_estm'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_estm'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantEstm.filieres_estm', ['etudiants' => $etud]);
        }

    }
    public function filtredip_fs(Request $request){
        $reqFil= $request->input('filiere_fs');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fs'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fs'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantFS.filieres_fs', ['etudiants' => $etud]);
        }

    }
    public function filtredip_fst(Request $request){
        $reqFil= $request->input('filiere_fst');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fst'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fst'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantFST.filieres_fst', ['etudiants' => $etud]);
        }

    }
    public function filtredip_fpe(Request $request){
        $reqFil= $request->input('filiere_fpe');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fpe'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fpe'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantFPE.filieres_fpe', ['etudiants' => $etud]);
        }

    }
    public function filtredip_fslh(Request $request){
        $reqFil= $request->input('filiere_fslh');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fslh'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fslh'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantFSLH.filieres_fslh', ['etudiants' => $etud]);
        }

    }
    public function filtredip_ens(Request $request){
        $reqFil= $request->input('filiere_ens');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_ens'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_ens'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantENS.filieres_ens', ['etudiants' => $etud]);
        }

    }
    public function filtredip_ensam(Request $request){
        $reqFil= $request->input('filiere_ensam');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_ensam'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_ensam'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantENSAM.filieres_ensam', ['etudiants' => $etud]);
        }

    }
    public function filtredip_fsjes(Request $request){
        $reqFil= $request->input('filiere_fsjes');
        if (!empty($reqFil) and isset($reqFil) ) {
            $filieres = DB::table('filieres')->where('libelle_filiere', $request->input('filiere_fsjes'))->get();
            $codefiliere = $filieres[0]->code_filiere_stat;
            Session::put('codefil', $codefiliere);
            $diplome = DB::table('diplomes')->where('libelle_diplome_fr', $request->input('diplome_fsjes'))->get();
            $codediplome = $diplome[0]->code_diplome;
            Session::put('codedip', $codediplome);

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->join('diplomes', 'filieres.code_diplome', '=', 'diplomes.code_diplome')
                ->where('filieres.code_diplome', $codediplome)
                ->where('inscription_pedagogiques.code_filiere', $codefiliere)
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->paginate(10);
            return view('etudiantFSJES.filieres_fsjes', ['etudiants' => $etud]);
        }

    }
    public function filtrefil(Request $request){

        $reqDip=$request->input('diplome');
        if (!empty($reqDip) and isset($reqDip)){
            $diplome = DB::table('diplomes')-> where('diplome',$request->input('diplome'))->get();
            $codediplome=$diplome[0]->codediplome;
            Session::put('codedip',$codediplome);
            $result2 = DB::table('etudiants')->where('diplome', $codediplome)->paginate(8);
            $codeetablissement = Session::get('codeetab');
            $filieres= DB::table('filieres')->where('codeetab', $codeetablissement)->where('codediplome', $codediplome)->get();

            $test=0;
            for($i =0;$i<sizeof($filieres);$i++)
                $test++;
            if($test==0){
                echo' not found';
                return back();
            }
            else {
                $codefil = $filieres[0]->codefiliere;
                Session::put('codefil', $codefil);
                return view('etudiant.filtrefil', ['etudiants' => $result2, 'filieres' => $filieres]);
            }

        }


    }
    public function resultfiltre(Request $request)
    {
        $reqFil = $request->input('filiere');
        if (!empty($reqFil) and isset($reqFil)) {
           // var_dump($request->input('filiere'));
            //   $etablissement = DB::table('etablissements')->where('etab', $request->input('etablissement'))->get();

            //  $codeetablissement = $etablissement[0]->codeetab;
            $codeetablissement = Session::get('codeetab');
            $codediplome = Session::get('codedip');
            //$codefiliere = Session::get('codefil');
           $filiere = DB::table('filieres')-> where('libelle_filiere',$request->input('filiere'))->get();
         // var_dump($filiere);
           $codefil=$filiere[0]->code_filiere_stat;


           $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('inscription_pedagogiques.code_filiere', $codefil)
                ->paginate(10);

            //$result = DB::table('etudiants')->where('etablissement', $codeetablissement)->where('diplome', $codediplome)->where('filiere', $codefiliere)->paginate(8);
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablissement)->get();

             if(sizeof($etud)==0){
                 return view('error.zero_etudiant', ['etablissement' => $etablissement[0]->libelle_etablissement_fr, 'diplome' => $diplome[0]->libelle_diplome_fr, 'filiere' => $filiere[0]->libelle_filiere]);
             }

           return view('etudiant.resultfiltre', ['etudiants' => $etud]);
        }
    }
    public function profil(Request $request){
        $cne = $request->input('cne');
        if (!empty($cne) and isset($cne)) {
            // $etud = DB::table('etudiants')->where('cin', $cin)->get();
            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('etudiants.id_etudiant', $cne)
                ->get();
           if(sizeof($etud)>0) {
                $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
                //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
                // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
                // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
                $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
                $codeetablisement = $filiere[0]->code_etablissement;
                $codediplome = $filiere[0]->code_diplome;
                $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $codeetablisement)->get();
                $abr_etab = $etablissement[0]->abreviation_etablissement;
                $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

                $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
                $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
                // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

                $seriebacs = DB::table('serie_bacs')->get();
                $etablissements = DB::table('etablissements')->get();
                $diplomes = DB::table('diplomes')->get();
                $filieres = DB::table('filieres')->get();
                $academies = DB::table('academies')->get();
                $provinces = DB::table('provinces')->get();
                return view('etudiant.profil', ['etudiant' => $etud, 'seriebac' => $seriebac, 'seriebacs' => $seriebacs, 'filiere' => $filiere, 'filieres' => $filieres, 'diplome' => $diplome, 'diplomes' => $diplomes, 'etablissement' => $etablissement, 'etablissements' => $etablissements, 'academie' => $academie, 'academies' => $academies, 'province' => $province, 'provinces' => $provinces, 'abr_etab' => $abr_etab]);
            }else
               return view('error.notfound');
        }

    }
    public function profil_cne(Request $request,$id){

            $etud = DB::table('etudiants')
                ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
                ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
                ->where('etudiants.id_etudiant', $id)
                ->get();
           $seriebac = DB::table('serie_bacs')->where('code_serie_baccalaureat_opi', $etud[0]->code_serie_baccalaureat_opi)->get();
            //$region = DB::table('regions')->where('code_region_stat', $etud[0]->coderegion)->get();
            // $etablissement = DB::table('filieres')->where('code_etablissement_stat', $etud[0]->code_etablissement_stat)->get();
            // $diplome = DB::table('diplomes')->where('code_diplome', $etud[0]->code_diplome)->get();
            $filiere = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
            $codeetablisement=$filiere[0]->code_etablissement;
            $codediplome=$filiere[0]->code_diplome;
            $etablissement = DB::table('etablissements')->where('code_etablissement_stat',$codeetablisement)->get();
            $abr_etab=$etablissement[0]->abreviation_etablissement;
            $diplome = DB::table('diplomes')->where('code_diplome', $codediplome)->get();

            $academie = DB::table('academies')->where('code_academie', $etud[0]->code_academie)->get();
            $province = DB::table('provinces')->where('code_province_opi', $etud[0]->code_province_opi)->get();
            // $ville = DB::table('villes')->where('codeville', $etud[0]->villebac)->get();

            $seriebacs = DB::table('serie_bacs')->get();
            $etablissements = DB::table('etablissements')->get();
            $diplomes= DB::table('diplomes')->get();
            $filieres= DB::table('filieres')->get();
            $academies= DB::table('academies')->get();
            $provinces= DB::table('provinces')->get();
            return view('etudiant.profil', ['etudiant' => $etud,'seriebac' => $seriebac,'seriebacs' => $seriebacs,'filiere' => $filiere,'filieres' => $filieres,'diplome' => $diplome,'diplomes' => $diplomes,'etablissement' => $etablissement,'etablissements' => $etablissements,'academie' => $academie,'academies' => $academies,'province' => $province,'provinces' => $provinces,'abr_etab' => $abr_etab]);

        }

    public function upd(Request $request, $id)
    {
        /*$etudiant = DB::table('etudiants')
            ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->where('etudiants.id_etudiant', $id)
            ->get();*/
       // var_dump($etudiant);
        $etudiant = Etudiant::find($id);
        $dossier_amo = Dossier_amo::find($id);
        $inscription_pedagogique = Inscription_pedagogique::find($id);

        $etudiant->cni_etudiant = $request->input('cin');
        //$etudiant->cin = $request->input('code_massar');
        $etudiant->nom_etudiant_fr = $request->input('nom');
        $etudiant->prenom_etudiant_fr= $request->input('prenom');
        $etudiant->nom_prenom_etud_fr = $request->input('nom_prenom');
        $etudiant->nom_etudiant_ar = $request->input('nomar');
        $etudiant->prenom_etudiant_ar = $request->input('prenomar');
        $etudiant->date_naissance_etud = $request->input('datenaissance');
        $etudiant->ville_naissance_etud = $request->input('villenaiss');
        $etudiant->adresse_personnelle_etud = $request->input('adressperso');
        $etudiant->email_etudiant = $request->input('email');
        $etudiant->tel_mobile_etudiant = $request->input('gsm');
        $etudiant->tel_fixe_etudiant = $request->input('fixe');
        $dossier_amo->code_postal = $request->input('code_postal');
        $dossier_amo->nom_pere_etudiant = $request->input('nom_pere');
        $dossier_amo->prenom_pere_etudiant  = $request->input('prenom_pere');
        $dossier_amo->cni_pere_etudiant  = $request->input('cni_pere');
        $dossier_amo->nom_mere_etudiant  = $request->input('nom_mere');
        $dossier_amo->prenom_mere_etudiant  = $request->input('prenom_mere');
        $dossier_amo->cni_mere_etudiant  = $request->input('cni_mere');
        $dossier_amo->ville_parents = $request->input('villeparent');
        $dossier_amo->adresse_parents_etud = $request->input('adressparent');
        $inscription_pedagogique->lycee_obtention_baccalaureat = $request->input('lycee');
       // $inscription_pedagogique->villebac = $request->input('villebac');
        // $etudiant->coderegion=$request->input('coderegion');
        // $inscription_pedagogique->codeville=$request->input('villebac');
        $inscription_pedagogique->code_serie_baccalaureat_opi = $request->input('seriebac');
        //  $etudiant->codeetab=$request->input('etablissement');
        // $etudiant->codeprovince=$request->input('province');
        $inscription_pedagogique->code_academie = $request->input('academie');
        //$etudiant->codediplome=$request->input('diplome');
        //$inscription_pedagogique->codefiliere=$request->input('filiere');
        // $inscription_pedagogique->seriebac=$request->input('seriebac');
        $inscription_pedagogique->mention_baccalaureat = $request->input('mentionbac');
        $inscription_pedagogique->annee_baccalaureat = $request->input('anneebac');
        $inscription_pedagogique->moyenne_baccalaureat = $request->input('moyennebac');
        $dossier_amo->numero_dossier_inscription = $request->input('num_dosier');
        // $etudiant->num_dossier=$request->input('num_dossier');


      //  $etudiant->save();
        // return redirect('list');
        // var_dump($request->file('image_profile'));
        $img = $request->file('image_profile');
       if (!empty($img) and isset($img)) {
           $this->validate($request, [
               'image_profile' => 'required|image|mimes:jpg,jpeg,png|max:2048'
           ]);

           // $new_name = rand() . '.' . $image->getClientOriginalExtension();
           $filiere = DB::table('filieres')->where('code_filiere_stat', $inscription_pedagogique->code_filiere)->get();
           $etablissement = DB::table('etablissements')->where('code_etablissement_stat', $filiere[0]->code_etablissement)->get();
           var_dump($etablissement);
           $path = '';
           if ($etablissement[0]->abreviation_etablissement === 'FPE') {
               $path = 'uploads/FPE/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/FPE/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'FST') {
               $path = 'uploads/FST/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/FST/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'FSJES') {
               //  var_dump($request->file('image_profile')->get('uploads/FSJES/'.$etudiant->id_etudiant.'.'.$request->file('image_profile')->getClientOriginalExtension()));
               $path = 'uploads/FSJES/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/FSJES/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
               // $img->move(public_path('uploads/FSJES/'),'uploads/FSJES/'.$etudiant->id_etudiant.'.'.$img->getClientOriginalExtension());
           }
           if ($etablissement[0]->abreviation_etablissement === 'FLSH') {
               $path = 'uploads/FLSH/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();

               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);

               $img->save(public_path('uploads/FLSH/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'FS') {
               $path = 'uploads/FS/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/FS/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'ESTM') {
               $path = 'uploads/ESTM/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/ESTM/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'ENSAM') {
               $path = 'uploads/ENSAM/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/ENSAM/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           if ($etablissement[0]->abreviation_etablissement === 'ENS') {
               $path = 'uploads/ENS/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension();
               $img = Image::make($request->file('image_profile')->getRealPath())->resize(180, 200);
               $img->save(public_path('uploads/ENS/' . $etudiant->id_etudiant . '.' . $request->file('image_profile')->getClientOriginalExtension()));
           }
           $etudiant->photo_etudiant = $path;
       }

           $dossier_amo->save();
            $etudiant->save();
            $inscription_pedagogique->save();
        return redirect('list');

    }

     public function test(){
         $provinces=DB::table('provinces')->get();
         return view('statistique.test',['province'=>$provinces]);
     }
    public function dowcartepdf($id){

        $etud = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->where('etudiants.id_etudiant',$id)
            ->get();
        $resultsF = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
        $dip=DB::table('diplomes')->where('code_diplome',$resultsF[0]->code_diplome)->get();
        $pdf =  PDF::loadView('etudiant.testgr' ,['etudiant' => $etud,'filiere' => $resultsF,'nom_dip' => $dip[0]->libelle_diplome_fr]);


        return $pdf->download('etudiant.testgr'.$id.'.pdf');

    }
    public function recu($id){

        $etud = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->join('info_recus','filieres.code_etablissement','=','info_recus.id')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*','info_recus.*')
            ->where('etudiants.id_etudiant',$id)
            ->get();

        $resultsF = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
        $etab=DB::table('etablissements')->where('code_etablissement_stat',$resultsF[0]->code_etablissement)->get();
        $dip=DB::table('diplomes')->where('code_diplome',$resultsF[0]->code_diplome)->get();
        $cach=$etud[0]->cache;
       // return view('etudiant.recu' ,['etudiant' => $etud,'filiere' => $resultsF,'nom_etab' => $etab[0]->libelle_etablissement_fr,'nom_dip' => $dip[0]->libelle_diplome_fr]);
        mb_internal_encoding("UTF-8");
        $pdf =  PDF::loadView('etudiant.recu' ,['etudiant' => $etud,'filiere' => $resultsF,'nom_etab' => $etab[0]->libelle_etablissement_fr,'nom_dip' => $dip[0]->libelle_diplome_fr,'cach'=>$cach]);

        return $pdf->download('etudiant.testgr'.$id.'.pdf');

    }
    public function info_recu(){
        $etab = DB::table('etablissements')
            ->select('etablissements.*')
            ->get();

        return view('users.recu_admin_etab',['etab' => $etab]);
    }
    public function valide_recu(Request $request){
     //   var_dump( $request->all());7
        $id=$request->input('etablissement');
        $info = Info_recu::find($id);
        $info->id =$id;
      //  $info->nom_etab =$request->input('etablissement');
        $info->nom_prenom=$request->input('nom');
        $info->ville_naiss=$request->input('ville_naiss');
        $info->date_naiss=$request->input('date_naiss');
        $info->cne=$request->input('cne');
        $info->code_massar=$request->input('code_massar');
        $info->diplome=$request->input('diplome');
        $info->filiere=$request->input('filiere');
        $info->annee_univ=$request->input('annee_univ');
        $info->cache=$request->input('cache');
        $info->num_dossier=$request->input('nd');
        $info->save();
    }
    public function viewcarte($id)
    {

        $etud = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->where('etudiants.id_etudiant',$id)
            ->get();

        $resultsF = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();

        return view('etudiant.viewcarte' ,['etudiant' => $etud,'filiere' => $resultsF]);

       // return $pdf->download('etudiant.testgr'.$id.'.pdf');

    }

}
