<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Inscription_pedagogique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use PDF;
class FiliereController extends Controller
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
        $list=DB::table('filieres')->orderBy('libelle_filiere','ASC')->get();

       // $filieres = DB::table('filieres')->get();
        $diplomes = DB::table('diplomes')->get();
        $province = DB::table('provinces')->get();
        $academie = DB::table('academies')->get();
        $serie = DB::table('serie_bacs')->get();
        $etablissements = DB::table('etablissements')->get();
        return view('Filieres.index',['data'=>$list,'diplomes'=>$diplomes,'provinces'=>$province,'serie'=>$serie,'academies'=>$academie,'etablissements'=>$etablissements]);
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
            'code_filiere_stat' => 'required',
            'libelle_filiere' => 'required',

            'code_etablissement' => 'required',
            'code_diplome' => 'required',
        ]);

        $data =new Filiere();
        $data->code_filiere_stat= ($request->input('code_filiere_stat'));
        $data->libelle_filiere= ($request->input('libelle_filiere'));
        $data->code_etablissement= ($request->input('code_etablissement'));
        $data->delai_inscription= ($request->input('delai_inscription'));
        $data->abreviation_filiere= ($request->input('abreviation_filiere'));
        $data->code_ldap_filiere = ($request->input('code_ldap_filiere'));
        $data->valeur_numero_dossier = ($request->input('valeur_numero_dossier'));
        $data->code_diplome = ($request->input('code_diplome'));
        $data->save ();
        return redirect('/filiere')->withSuccMsg(' data saved successfully');
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
            'code_filiere_stat' => 'required',
            'libelle_filiere' => 'required',
            'code_etablissement' => 'required',
            'code_diplome' => 'required',
        ]);

        $data = Filiere::find ($id);
        $data->code_filiere_stat= ($request->input('code_filiere_stat'));
        $data->libelle_filiere= ($request->input('libelle_filiere'));
        $data->code_etablissement= ($request->input('code_etablissement'));
        $data->delai_inscription= ($request->input('delai_inscription'));
        $data->abreviation_filiere= ($request->input('abreviation_filiere'));
        $data->code_ldap_filiere = ($request->input('code_ldap_filiere'));
        $data->valeur_numero_dossier = ($request->input('valeur_numero_dossier'));
        $data->code_diplome = ($request->input('code_diplome'));
        $data->save ();

        return redirect('/filiere')->withUpdMsg('Data updaated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filiere=Filiere::find($id);
        $filiere->delete();
        return redirect('/filiere')->withDelMsg(' data deleted successfully');
    }
    public function cne(){
        return view('Filieres.cne');
    }
    public function cneestm(){
        return view('Filieres.ESTM.cne');
    }
    public function cneens(){
        return view('Filieres.ENS.cne');
    }
    public function cneenSAM(){
        return view('Filieres.ENSAM.cne');
    }
    public function cnefpe(){
        return view('Filieres.FPE.cne');
    }
    public function cnefst(){
        return view('Filieres.FST.cne');
    }
    public function cnefs(){
        return view('Filieres.FS.cne');
    }
    public function cnefsjes(){
        return view('Filieres.FSJES.cne');
    }
    public function cneflsh(){
        return view('Filieres.FLSH.cne');
    }

    public function demestm(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();

        return view('Filieres.ESTM.demande',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demENS(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();

        return view('Filieres.ENS.demande',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demENSAM(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();

        return view('Filieres.ENSAM.demande',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }

    public function demfpe(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();


       return view('Filieres.FPE.demande_fpe',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demfst(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();


        return view('Filieres.FST.demande_fpe',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demfs(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();


        return view('Filieres.FS.demande_fpe',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demfsjes(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();


        return view('Filieres.FSJES.demande_fpe',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function demflsh(Request $request){
        $cne= $request->input('id_etud');
        $filieres = DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();


        return view('Filieres.FLSH.demande_fpe',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function dem(Request $request){

        $cne= $request->input('id_etud');
        Session::put('etud_id',$cne);

        $filieres = DB::table('filieres')
            ->get();
        $list= DB::table('inscription_pedagogiques')
            ->where('inscription_pedagogiques.id_etudiant',$cne)
            ->get();

        $code_filiere=$list[0]->code_filiere;
        $filiere = DB::table('filieres')
            ->where('code_filiere_stat',$code_filiere)
            ->get();

        return view('Filieres.demande',['filieres'=>$filieres,'filiere'=>$filiere,'cne'=>$cne]);
    }
    public function updi(Request $request, $id)
    {
        $cne=Session::get('etud_id');
        $etud = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->where('etudiants.id_etudiant',$cne)
            ->get();

        $resultsF = DB::table('filieres')->where('code_filiere_stat', $etud[0]->code_filiere)->get();
        $etab=DB::table('etablissements')->where('code_etablissement_stat',$resultsF[0]->code_etablissement)->get();
        $dip=DB::table('diplomes')->where('code_diplome',$resultsF[0]->code_diplome)->get();
        $email=$etud[0]->email_etudiant;
      //var_dump($etudiants);
        $data["email"] = $email;
        $data["nom"]=$etud[0]->nom_etudiant_fr;
        $data["prenom"]=$etud[0]->prenom_etudiant_fr;
        $data["message"]=" test d'envoi email changement filière";
        $data["subject"]="état changement filière";
        $nv_fil= DB::table('filieres')->where('code_filiere_stat', $request->input('code_nv_fil'))->get();
        if($etud[0]->sexe_etudiant=='F')
          $data['sexe']="Mme";
        else
            $data["sexe"]="Mr";

      $data["nv_fl_name"]=$nv_fil[0]->libelle_filiere;
        mb_internal_encoding("UTF-8");
        $pdf =  PDF::loadView('Filieres.recu' ,['etudiant' => $etud,'filiere' => $resultsF,'nom_etab' => $etab[0]->libelle_etablissement_fr,'nom_dip' => $dip[0]->libelle_diplome_fr]);



        try{
            Mail::send('Filieres.mail',$data,function($message)use($data,$pdf) {
                $message->to($data["email"])
                        ->subject($data["subject"])
                    ->attachData($pdf->output(), "recu.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";

        }else{

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
      $data = Inscription_pedagogique::find ($id);
        $data->code_filiere= ($request->input('code_nv_fil'));
        $data->save();


       return redirect('/filiere')->withUpdMsg('Data updaated successfully !!');
    }
}
