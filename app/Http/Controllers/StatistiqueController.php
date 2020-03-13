<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier_amo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Etudiant;
use App\Inscription_pedagogique;
use App\Filiere;
use Intervention\Image\Facades\Image;
use PDF;
use Dompdf\Dompdf;
use phpDocumentor\Reflection\Types\Object_;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware('auth');
        $this->middleware(['auth', 'clearance']);//->except('index', 'show');

    }
    public function error(){
        return  view('error.401');
    }
    public function index()
    {
        //
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
    }
    public function stat_fil_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();
        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            //->where('filieres.code_etablissement', 72)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();
        $data_etab = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->join('etablissements', 'filieres.code_etablissement', '=', 'etablissements.code_etablissement_stat')
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('etablissements.libelle_etablissement_fr as name'),
                DB::raw('count(*) as value'))
            ->distinct()
            ->groupBy('etablissements.libelle_etablissement_fr')
            ->get();

        Session::put('data_aca',$data_aca);
        Session::put('data_pro',$data_pro);
        Session::put('data_bac',$data_bac);
        Session::put('data_etab',$data_etab);
        Session::put('data',$data);

        $max_fil=$data[0]->value;
        $min_fil=$data[0]->value;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
        $sum_fil=$sum_fil+$d->value;
        $i++;
        endforeach;
        $moy_fil=$sum_fil/$i;
        Session::put('moy_fil',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil',$max_fil);
        Session::put('min_fil',$min_fil);
        $max_etab=$data_etab[0]->value;
        $min_etab=$data_etab[0]->value;
        $i=0;
        $sum_etab=0;
        $moy_etab=0;
        foreach($data_etab as $d):
            if($d->value >$max_etab)
                $max_etab=$d->value;
            if($d->value <$min_etab)
                $min_etab=$d->value;
            $sum_etab=$sum_etab+$d->value;
            $i++;
            endforeach;
        $moy_etab=$sum_etab/$i;
        Session::put('moy_etab',number_format($moy_etab, 2, ',', ''));
        Session::put('max_etab',$max_etab);
        Session::put('min_etab',$min_etab);
        $max_aca=$data_aca[0]->value;
        $min_aca=$data_aca[0]->value;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        $moy_aca=$sum_aca/$i;
        Session::put('moy_aca',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca',$max_aca);
        Session::put('min_aca',$min_aca);
        $max_prov=$data_pro[0]->value;
        $min_prov=$data_pro[0]->value;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        $moy_prov=$sum_prov/$i;
        Session::put('moy_pro',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro',$max_prov);
        Session::put('min_pro',$min_prov);
        $max_bac=$data_bac[0]->value;
        $min_bac=$data_bac[0]->value;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        $moy_bac=$sum_bac/$i;
        Session::put('moy_bac',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac',$max_bac);
        Session::put('min_bac',$min_bac);
//var_dump($number[1]->number);
     return view('statistique.statistiquetest')->with('Data',$data)->with('Data_pro',$data_pro)
         ->with('Data_aca',$data_aca)
         ->with('Data_bac',$data_bac)
         ->with('Data_etab',$data_etab)
         ->with('nn_val',$number[0]->number)
         ->with('val',$number[1]->number);

    }
    public function stat_ens_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 203)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

       $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 203)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_ens=0;
        $total_non_valide_ens=0;
        //foreach($number as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($number)==1){
                if($number[0]->validation==true)
                    $total_valide_ens=$total_valide_ens+$number[0]->number;
                if($number[0]->validation==false)
                    $total_non_valide_ens=$total_non_valide_ens+$number[0]->number;
            }

            if(sizeof($number)==2){
                $total_valide_ens=$total_valide_ens+$number[1]->number;
                $total_non_valide_ens=$total_non_valide_ens+$number[0]->number;
            }

      //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 203)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 203)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',203)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



       Session::put('data_aca_ens',$data_aca);
        Session::put('data_pro_ens',$data_pro);
        Session::put('data_bac_ens',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
        $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_ens',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_ens',$max_fil);
        Session::put('min_fil_ens',$min_fil);

       $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
        $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_ens',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_ens',$max_aca);
        Session::put('min_aca_ens',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
        $moy_prov=$sum_prov/$i;

       Session::put('moy_pro_ens',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_ens',$max_prov);
        Session::put('min_pro_ens',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
        $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_ens',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_ens',$max_bac);
        Session::put('min_bac_ens',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueENS')->with('Data_ens',$data)
            ->with('Data_pro_ens',$data_pro)
            ->with('Data_aca_ens',$data_aca)
            ->with('Data_bac_ens',$data_bac)
            ->with('nn_val_ens',$total_non_valide_ens)
            ->with('val_ens',$total_valide_ens);

    }

    public function stat_estm_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_estm=0;
        $total_non_valide_estm=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_estm=$total_valide_estm+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_estm=$total_non_valide_estm+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_estm=$total_valide_estm+$number[1]->number;
            $total_non_valide_estm=$total_non_valide_estm+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',72)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_estm',$data_aca);
        Session::put('data_pro_estm',$data_pro);
        Session::put('data_bac_estm',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_estm',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_estm',$max_fil);
        Session::put('min_fil_estm',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_estm',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_estm',$max_aca);
        Session::put('min_aca_estm',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_estm',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_estm',$max_prov);
        Session::put('min_pro_estm',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_estm',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_estm',$max_bac);
        Session::put('min_bac_estm',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueESTM')->with('Data_estm',$data)
            ->with('Data_pro_estm',$data_pro)
            ->with('Data_aca_estm',$data_aca)
            ->with('Data_bac_estm',$data_bac)
            ->with('nn_val_estm',$total_non_valide_estm)
            ->with('val_estm',$total_valide_estm);

    }
    public function stat_ensam_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 145)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 145)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_ensam=0;
        $total_non_valide_ensam=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_ensam=$total_valide_ensam+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_ensam=$total_non_valide_ensam+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_ensam=$total_valide_ensam+$number[1]->number;
            $total_non_valide_ensam=$total_non_valide_ensam+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 145)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 145)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',145)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_ensam',$data_aca);
        Session::put('data_pro_ensam',$data_pro);
        Session::put('data_bac_ensam',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_ensam',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_ensam',$max_fil);
        Session::put('min_fil_ensam',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_ensam',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_ensam',$max_aca);
        Session::put('min_aca_ensam',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_ensam',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_ensam',$max_prov);
        Session::put('min_pro_ensam',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_ensam',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_ensam',$max_bac);
        Session::put('min_bac_ensam',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueENSAM')->with('Data_ensam',$data)
            ->with('Data_pro_ensam',$data_pro)
            ->with('Data_aca_ensam',$data_aca)
            ->with('Data_bac_ensam',$data_bac)
            ->with('nn_val_ensam',$total_non_valide_ensam)
            ->with('val_ensam',$total_valide_ensam);

    }
    public function stat_fs_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 47)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 47)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_fs=0;
        $total_non_valide_fs=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_fss=$total_valide_fs+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_fs=$total_non_valide_fs+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_fs=$total_valide_fs+$number[1]->number;
            $total_non_valide_fs=$total_non_valide_fs+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 47)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 47)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',47)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_fs',$data_aca);
        Session::put('data_pro_fs',$data_pro);
        Session::put('data_bac_fs',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_fs',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_fs',$max_fil);
        Session::put('min_fil_fs',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_fs',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_fs',$max_aca);
        Session::put('min_aca_fs',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_fs',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_fs',$max_prov);
        Session::put('min_pro_fs',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_fs',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_fs',$max_bac);
        Session::put('min_bac_fs',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueFS')->with('Data_fs',$data)
            ->with('Data_pro_fs',$data_pro)
            ->with('Data_aca_fs',$data_aca)
            ->with('Data_bac_fs',$data_bac)
            ->with('nn_val_fs',$total_non_valide_fs)
            ->with('val_fs',$total_valide_fs);

    }
    public function stat_fsjes_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 21)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 21)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_fsjes=0;
        $total_non_valide_fsjes=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_fsjes=$total_valide_fsjes+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_fsjes=$total_non_valide_fsjes+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_fsjes=$total_valide_fsjes+$number[1]->number;
            $total_non_valide_fsjes=$total_non_valide_fsjes+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 21)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 21)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',21)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_fsjes',$data_aca);
        Session::put('data_pro_fsjes',$data_pro);
        Session::put('data_bac_fsjes',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_fsjes',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_fsjes',$max_fil);
        Session::put('min_fil_fsjes',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_fsjes',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_fsjes',$max_aca);
        Session::put('min_aca_fsjes',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_fsjes',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_fsjes',$max_prov);
        Session::put('min_pro_fsjes',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_fsjes',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_fsjes',$max_bac);
        Session::put('min_bac_fsjes',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueFSJES')->with('Data_fsjes',$data)
            ->with('Data_pro_fsjes',$data_pro)
            ->with('Data_aca_fsjes',$data_aca)
            ->with('Data_bac_fsjes',$data_bac)
            ->with('nn_val_fsjes',$total_non_valide_fsjes)
            ->with('val_fsjes',$total_valide_fsjes);

    }
    public function stat_fst_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 52)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 52)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_fst=0;
        $total_non_valide_fst=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_fst=$total_valide_fst+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_fst=$total_non_valide_fst+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_fst=$total_valide_fst+$number[1]->number;
            $total_non_valide_fst=$total_non_valide_fst+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 52)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 52)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',52)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_fst',$data_aca);
        Session::put('data_pro_fst',$data_pro);
        Session::put('data_bac_fst',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_fst',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_fst',$max_fil);
        Session::put('min_fil_fst',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_fst',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_fst',$max_aca);
        Session::put('min_aca_fst',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_fst',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_fst',$max_prov);
        Session::put('min_pro_fst',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_fst',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_fst',$max_bac);
        Session::put('min_bac_fst',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueFST')->with('Data_fst',$data)
            ->with('Data_pro_fst',$data_pro)
            ->with('Data_aca_fst',$data_aca)
            ->with('Data_bac_fst',$data_bac)
            ->with('nn_val_fst',$total_non_valide_fst)
            ->with('val_fst',$total_valide_fst);

    }
    public function stat_fpe_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 166)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 166)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_fpe=0;
        $total_non_valide_fpe=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_fpe=$total_valide_fpe+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_fpe=$total_non_valide_fpe+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_fpe=$total_valide_fpe+$number[1]->number;
            $total_non_valide_fpe=$total_non_valide_fpe+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 166)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 166)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',166)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_fpe',$data_aca);
        Session::put('data_pro_fpe',$data_pro);
        Session::put('data_bac_fpe',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_fpe',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_fpe',$max_fil);
        Session::put('min_fil_fpe',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_fpe',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_fpe',$max_aca);
        Session::put('min_aca_fpe',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_fpe',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_fpe',$max_prov);
        Session::put('min_pro_fpe',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_fpe',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_fpe',$max_bac);
        Session::put('min_bac_fpe',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueFPE')->with('Data_fpe',$data)
            ->with('Data_pro_fpe',$data_pro)
            ->with('Data_aca_fpe',$data_aca)
            ->with('Data_bac_fpe',$data_bac)
            ->with('nn_val_fpe',$total_non_valide_fpe)
            ->with('val_fpe',$total_valide_fpe);

    }
    public function stat_flsh_all(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 35)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('filieres.libelle_filiere as name'),
                DB::raw('count(*) as value'))
            ->groupBy('filieres.libelle_filiere')
            ->get();

        $number = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 35)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $total_valide_flsh=0;
        $total_non_valide_flsh=0;
        //foreach($number as $d):
        //  if($t==sizeof($data)-1) break;
        if(sizeof($number)==1){
            if($number[0]->validation==true)
                $total_valide_flsh=$total_valide_flsh+$number[0]->number;
            if($number[0]->validation==false)
                $total_non_valide_flsh=$total_non_valide_flsh+$number[0]->number;
        }

        if(sizeof($number)==2){
            $total_valide_flsh=$total_valide_flsh+$number[1]->number;
            $total_non_valide_flsh=$total_non_valide_flsh+$number[0]->number;
        }

        //  endforeach;
        $data_pro = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('provinces', 'inscription_pedagogiques.code_province_opi', '=', 'provinces.code_province_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 35)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('provinces.libelle_province_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('provinces.libelle_province_fr')
            ->get();
        //var_dump($data_pro);
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('academies', 'inscription_pedagogiques.code_academie', '=', 'academies.code_academie')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 35)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('academies.libelle_academie_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('academies.libelle_academie_fr')
            ->get();
        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('serie_bacs', 'inscription_pedagogiques.code_serie_baccalaureat_opi', '=', 'serie_bacs.code_serie_baccalaureat_opi')
            ->join('filieres', 'inscription_pedagogiques.code_filiere', '=', 'filieres.code_filiere_stat')
            ->where('filieres.code_etablissement',35)
            ->where('inscription_pedagogiques.validation', true)
            ->select(
                DB::raw('serie_bacs.libelle_baccalaureat_fr as name'),
                DB::raw('count(*) as value'))
            ->groupBy('serie_bacs.libelle_baccalaureat_fr')
            ->get();



        Session::put('data_aca_flsh',$data_aca);
        Session::put('data_pro_flsh',$data_pro);
        Session::put('data_bac_flsh',$data_bac);


        $max_fil=0;
        $min_fil=0;
        $i=0;
        $sum_fil=0;
        $moy_fil=0;
        foreach($data as $d):
            if($d->value >$max_fil)
                $max_fil=$d->value;
            if($d->value<$max_fil)
                $min_fil=$d->value;
            $sum_fil=$sum_fil+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_fil=$sum_fil/$i;

        Session::put('moy_fil_flsh',number_format($moy_fil, 2, ',', ''));
        Session::put('max_fil_flsh',$max_fil);
        Session::put('min_fil_flsh',$min_fil);

        $max_aca=0;
        $min_aca=0;
        $i=0;
        $sum_aca=0;
        $moy_aca=0;
        foreach($data_aca as $d):
            if($d->value >$max_aca)
                $max_aca=$d->value;
            if($d->value <$min_aca)
                $min_aca=$d->value;
            $sum_aca=$sum_aca+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_aca=$sum_aca/$i;
        Session::put('moy_aca_flsh',number_format($moy_aca, 2, ',', ''));
        Session::put('max_aca_flsh',$max_aca);
        Session::put('min_aca_flsh',$min_aca);
        $max_prov=0;
        $min_prov=0;
        $i=0;
        $sum_prov=0;
        $moy_prov=0;
        foreach($data_pro as $d):
            if($d->value >$max_prov)
                $max_prov=$d->value;
            if($d->value<$min_prov)
                $min_prov=$d->value;
            $sum_prov=$sum_prov+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_prov=$sum_prov/$i;

        Session::put('moy_pro_flsh',number_format($moy_prov, 2, ',', ''));
        Session::put('max_pro_flsh',$max_prov);
        Session::put('min_pro_flsh',$min_prov);
        $max_bac=0;
        $min_bac=0;
        $i=0;
        $sum_bac=0;
        $moy_bac=0;
        foreach($data_bac as $d):
            if($d->value >$max_bac)
                $max_bac=$d->value;
            if($d->value <$min_bac)
                $min_bac=$d->value;
            $sum_bac=$sum_bac+$d->value;
            $i++;
        endforeach;
        if($i!=0)
            $moy_bac=$sum_bac/$i;
        Session::put('moy_bac_flsh',number_format($moy_bac, 2, ',', ''));
        Session::put('max_bac_flsh',$max_bac);
        Session::put('min_bac_flsh',$min_bac);
//var_dump($number[1]->number);
        return view('statistique.statistiqueFLSH')->with('Data_flsh',$data)
            ->with('Data_pro_flsh',$data_pro)
            ->with('Data_aca_flsh',$data_aca)
            ->with('Data_bac_flsh',$data_bac)
            ->with('nn_val_flsh',$total_non_valide_flsh)
            ->with('val_flsh',$total_valide_flsh);

    }
    public function Piechart()
    {
        $Data = array
        (
            "0" => array
            (
                "value" => 335,
                "name" => "Apple",
            ),
            "1" => array
            (
                "value" => 310,
                "name" => "Orange",
            )
        ,
            "2" => array
            (
                "value" => 234,
                "name" => "Grapes",
            )
        ,
            "3" => array
            (
                "value" => 135,
                "name" => "Banana",
            )
        );
        return view('statistique.statistiquetest',['Data' => $Data]);
    }

    public function stat(Request $request){
        //return view('statistique.index');
        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $province=DB::table('provinces')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',21)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();

        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $seriebac=DB::table('serie_bacs')->get();
        // $data_province;
        $data_prov = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_province_opi',21)
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $data_aca = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_academie','R')
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $data_fil = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_filiere','DUT103')
            ->groupBy('inscription_pedagogiques.validation')
            ->get();

        $data_bac = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',23)
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        //var_dump($bac);
        Session::put('non_valid',$data[0]->number);
        Session::put('valid',$data[1]->number);
        Session::put('non_valide_prov',$data_prov[0]->number);
        Session::put('valide_prov',$data_prov[1]->number);
        Session::put('non_valide_aca',$data_aca[0]->number);
        Session::put('valide_aca',$data_aca[1]->number);
        Session::put('non_valide_fil',$data_fil[0]->number);
        Session::put('valide_fil',$data_fil[1]->number);
        Session::put('non_valide_bac',$data_bac[0]->number);
        Session::put('valide_bac',$data_bac[1]->number);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.index')->with('non_valide', json_encode($data[0]->number))
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
        /* ->with('valide', json_encode($data[1]->number))
         ->with('non_valide_prov', json_encode($data_prov[0]->number))
         ->with('valide_prov', json_encode($data_prov[1]->number))
         ->with('province',$province);*/
    }

    public function stat_estm(Request $request){
        //return view('statistique.index');
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
       /* $data_all= DB::table('etudiants')
            ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->where('inscription_pedagogiques.code_filiere', 900)
            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();*/
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        $total_valide=0;
        $total_non_valide=0;
        foreach($data as $d):
          //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
            if($d[0]->validation==true)
                    $total_valide=$total_valide+$d[0]->number;
            if($d[0]->validation==false)
                    $total_non_valide=$total_non_valide+$d[0]->number;
            }

            if(sizeof($d)==2){
                    $total_valide=$total_valide+$d[1]->number;
                    $total_non_valide=$total_non_valide+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();

        $academie = DB::table('academies')
                ->get();

        $filiere=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();

        $seriebac= DB::table('serie_bacs')
                ->get();


        // $data_province;
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov=0;
        $total_non_valide_prov=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov=$total_valide_prov+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov=$total_non_valide_prov+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov=$total_valide_prov+$d_p[1]->number;
                $total_non_valide_prov=$total_non_valide_prov+$d_p[0]->number;
            }

        endforeach;
       // echo ' totla province : \n' ;
       // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca=0;
        $total_non_valide_aca=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca=$total_valide_aca+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca=$total_non_valide_aca+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca=$total_valide_aca+$d_p[1]->number;
                $total_non_valide_aca=$total_non_valide_aca+$d_p[0]->number;
            }

        endforeach;
      //  echo ' totla province : \n' ;
      //  var_dump($total_valide_aca);
       // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil=0;
        $total_non_valide_fil=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil=$total_valide_fil+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil=$total_non_valide_fil+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil=$total_valide_fil+$d_p[1]->number;
                $total_non_valide_fil=$total_non_valide_fil+$d_p[0]->number;
            }

        endforeach;
    //    echo ' totla province : \n' ;
       // var_dump($total_valide_fil);
      //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac=0;
        $total_non_valide_bac=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac=$total_valide_bac+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac=$total_non_valide_bac+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac=$total_valide_bac+$d_p[1]->number;
                $total_non_valide_bac=$total_non_valide_bac+$d_p[0]->number;
            }

        endforeach;
     //   echo ' totla province : \n' ;
      //  var_dump($total_valide_bac);
      //  var_dump($total_non_valide_bac);
        //var_dump($bac);
        Session::put('non_valid_estm',$total_non_valide);
        Session::put('valid_estm',$total_valide);
        Session::put('non_valide_prov_estm',$total_non_valide_prov);
        Session::put('valide_prov_estm',$total_valide_prov);
        Session::put('non_valide_aca_estm',$total_non_valide_aca);
        Session::put('valide_aca_estm',$total_valide_aca);
        Session::put('non_valide_fil_estm',$total_non_valide_fil);
        Session::put('valide_fil_estm',$total_valide_fil);
        Session::put('non_valide_bac_estm',$total_non_valide_bac);
        Session::put('valide_bac_estm',$total_valide_bac);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.estm')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
        /* ->with('valide', json_encode($data[1]->number))
         ->with('non_valide_prov', json_encode($data_prov[0]->number))
         ->with('valide_prov', json_encode($data_prov[1]->number))
         ->with('province',$province);*/
    }

    public function stat_fs(Request $request){
        //return view('statistique.index');
        $filiere_fs=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }

        $total_valide_fs=0;
        $total_non_valide_fs=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fs=$total_valide_fs+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fs=$total_non_valide_fs+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fs=$total_valide_fs+$d[1]->number;
                $total_non_valide_fs=$total_non_valide_fs+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fs=0;
        $total_non_valide_prov_fs=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_fs=$total_valide_prov_fs+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_fs=$total_non_valide_prov_fs+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_fs=$total_valide_prov_fs+$d_p[1]->number;
                $total_non_valide_prov_fs=$total_non_valide_prov_fs+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_fs=0;
        $total_non_valide_aca_fs=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_fs=$total_valide_aca_fs+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_fs=$total_non_valide_aca_fs+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_fs=$total_valide_aca_fs+$d_p[1]->number;
                $total_non_valide_aca_fs=$total_non_valide_aca_fs+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fs=0;
        $total_non_valide_fil_fs=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_fs=$total_valide_fil_fs+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_fs=$total_non_valide_fil_fs+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_fs=$total_valide_fil_fs+$d_p[1]->number;
                $total_non_valide_fil_fs=$total_non_valide_fil_fs+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_fs=0;
        $total_non_valide_bac_fs=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_fs=$total_valide_bac_fs+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_fs=$total_non_valide_bac_fs+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_fs=$total_valide_bac_fs+$d_p[1]->number;
                $total_non_valide_bac_fs=$total_non_valide_bac_fs+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);
        Session::put('non_valid_fs',$total_non_valide_fs);
        Session::put('valid_fs',$total_valide_fs);
        Session::put('non_valide_prov_fs',$total_non_valide_prov_fs);
        Session::put('valide_prov_fs',$total_valide_prov_fs);
        Session::put('non_valide_aca_fs',$total_non_valide_aca_fs);
        Session::put('valide_aca_fs',$total_valide_aca_fs);
        Session::put('non_valide_fil_fs',$total_non_valide_fil_fs);
        Session::put('valide_fil_fs',$total_valide_fil_fs);
        Session::put('non_valide_bac_fs',$total_non_valide_bac_fs);
        Session::put('valide_bac_fs',$total_valide_bac_fs);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fs')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }
    public function stat_fsjes(Request $request){
        //return view('statistique.index');
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_fsjes=0;
        $total_non_valide_fsjes=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fsjes=$total_valide_fsjes+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fsjes=$total_non_valide_fsjes+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fsjes=$total_valide_fsjes+$d[1]->number;
                $total_non_valide_fsjes=$total_non_valide_fsjes+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fsjes=0;
        $total_non_valide_prov_fsjes=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_fsjes=$total_valide_prov_fsjes+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_fsjes=$total_non_valide_prov_fsjes+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_fsjes=$total_valide_prov_fsjes+$d_p[1]->number;
                $total_non_valide_prov_fsjes=$total_non_valide_prov_fsjes+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_fsjes=0;
        $total_non_valide_aca_fsjes=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_fsjes=$total_valide_aca_fsjes+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_fsjes=$total_non_valide_aca_fsjes+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_fsjes=$total_valide_aca_fsjes+$d_p[1]->number;
                $total_non_valide_aca_fsjes=$total_non_valide_aca_fsjes+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fsjes=0;
        $total_non_valide_fil_fsjes=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_fsjes=$total_valide_fil_fsjes+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_fsjes=$total_non_valide_fil_fsjes+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_fsjes=$total_valide_fil_fsjes+$d_p[1]->number;
                $total_non_valide_fil_fsjes=$total_non_valide_fil_fsjes+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_fsjes=0;
        $total_non_valide_bac_fsjes=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_fsjes=$total_valide_bac_fsjes+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_fsjes=$total_non_valide_bac_fsjes+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_fsjes=$total_valide_bac_fsjes+$d_p[1]->number;
                $total_non_valide_bac_fsjes=$total_non_valide_bac_fsjes+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_fsjes',$total_non_valide_fsjes);
        Session::put('valid_fsjes',$total_valide_fsjes);
        Session::put('non_valide_prov_fsjes',$total_non_valide_prov_fsjes);
        Session::put('valide_prov_fsjes',$total_valide_prov_fsjes);
        Session::put('non_valide_aca_fsjes',$total_non_valide_aca_fsjes);
        Session::put('valide_aca_fsjes',$total_valide_aca_fsjes);
        Session::put('non_valide_fil_fsjes',$total_non_valide_fil_fsjes);
        Session::put('valide_fil_fsjes',$total_valide_fil_fsjes);
        Session::put('non_valide_bac_fsjes',$total_non_valide_bac_fsjes);
        Session::put('valide_bac_fsjes',$total_valide_bac_fsjes);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fsjes')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }

    public function stat_flsh(Request $request){
        //return view('statistique.index');
        $filiere_flsh=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_flsh=0;
        $total_non_valide_flsh=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_flsh=$total_valide_flsh+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_flsh=$total_non_valide_flsh+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_flsh=$total_valide_flsh+$d[1]->number;
                $total_non_valide_flsh=$total_non_valide_flsh+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_flsh=0;
        $total_non_valide_prov_flsh=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_flsh=$total_valide_prov_flsh+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_flsh=$total_non_valide_prov_flsh+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_flsh=$total_valide_prov_flsh+$d_p[1]->number;
                $total_non_valide_prov_flsh=$total_non_valide_prov_flsh+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_flsh=0;
        $total_non_valide_aca_flsh=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_flsh=$total_valide_aca_flsh+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_flsh=$total_non_valide_aca_flsh+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_flsh=$total_valide_aca_flsh+$d_p[1]->number;
                $total_non_valide_aca_flsh=$total_non_valide_aca_flsh+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_flsh=0;
        $total_non_valide_fil_flsh=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_flsh=$total_valide_fil_flsh+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_flsh=$total_non_valide_fil_flsh+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_flsh=$total_valide_fil_flsh+$d_p[1]->number;
                $total_non_valide_fil_flsh=$total_non_valide_fil_flsh+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_flsh=0;
        $total_non_valide_bac_flsh=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_flsh=$total_valide_bac_flsh+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_flsh=$total_non_valide_bac_flsh+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_flsh=$total_valide_bac_flsh+$d_p[1]->number;
                $total_non_valide_bac_flsh=$total_non_valide_bac_flsh+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_flsh',$total_non_valide_flsh);
        Session::put('valid_flsh',$total_valide_flsh);
        Session::put('non_valide_prov_flsh',$total_non_valide_prov_flsh);
        Session::put('valide_prov_flsh',$total_valide_prov_flsh);
        Session::put('non_valide_aca_flsh',$total_non_valide_aca_flsh);
        Session::put('valide_aca_flsh',$total_valide_aca_flsh);
        Session::put('non_valide_fil_flsh',$total_non_valide_fil_flsh);
        Session::put('valide_fil_flsh',$total_valide_fil_flsh);
        Session::put('non_valide_bac_flsh',$total_non_valide_bac_flsh);
        Session::put('valide_bac_flsh',$total_valide_bac_flsh);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.flsh')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }

    public function stat_fst(Request $request){
        //return view('statistique.index');
        $filiere_fst=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_fst=0;
        $total_non_valide_fst=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fst=$total_valide_fst+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fst=$total_non_valide_fst+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fst=$total_valide_fst+$d[1]->number;
                $total_non_valide_fst=$total_non_valide_fst+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fst=0;
        $total_non_valide_prov_fst=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_fst=$total_valide_prov_fst+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_fst=$total_non_valide_prov_fst+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_fst=$total_valide_prov_fst+$d_p[1]->number;
                $total_non_valide_prov_fst=$total_non_valide_prov_fst+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_fst=0;
        $total_non_valide_aca_fst=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_fst=$total_valide_aca_fst+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_fst=$total_non_valide_aca_fst+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_fst=$total_valide_aca_fst+$d_p[1]->number;
                $total_non_valide_aca_fst=$total_non_valide_aca_fst+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fst=0;
        $total_non_valide_fil_fst=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_fst=$total_valide_fil_fst+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_fst=$total_non_valide_fil_fst+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_fst=$total_valide_fil_fst+$d_p[1]->number;
                $total_non_valide_fil_fst=$total_non_valide_fil_fst+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_fst=0;
        $total_non_valide_bac_fst=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_fst=$total_valide_bac_fst+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_fst=$total_non_valide_bac_fst+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_fst=$total_valide_bac_fst+$d_p[1]->number;
                $total_non_valide_bac_fst=$total_non_valide_bac_fst+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_fst',$total_non_valide_fst);
        Session::put('valid_fst',$total_valide_fst);
        Session::put('non_valide_prov_fst',$total_non_valide_prov_fst);
        Session::put('valide_prov_fst',$total_valide_prov_fst);
        Session::put('non_valide_aca_fst',$total_non_valide_aca_fst);
        Session::put('valide_aca_fst',$total_valide_aca_fst);
        Session::put('non_valide_fil_fst',$total_non_valide_fil_fst);
        Session::put('valide_fil_fst',$total_valide_fil_fst);
        Session::put('non_valide_bac_fst',$total_non_valide_bac_fst);
        Session::put('valide_bac_fst',$total_valide_bac_fst);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fst')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }
    public function stat_ensam(Request $request){
        //return view('statistique.index');
        $filiere_ensam=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_ensam=0;
        $total_non_valide_ensam=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_ensam=$total_valide_ensam+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_ensam=$total_non_valide_ensam+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_ensam=$total_valide_ensam+$d[1]->number;
                $total_non_valide_ensam=$total_non_valide_ensam+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_ensam=0;
        $total_non_valide_prov_ensam=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_ensam=$total_valide_prov_ensam+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_ensam=$total_non_valide_prov_ensam+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_ensam=$total_valide_prov_ensam+$d_p[1]->number;
                $total_non_valide_prov_ensam=$total_non_valide_prov_ensam+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_ensam=0;
        $total_non_valide_aca_ensam=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_ensam=$total_valide_aca_ensam+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_ensam=$total_non_valide_aca_ensam+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_ensam=$total_valide_aca_ensam+$d_p[1]->number;
                $total_non_valide_aca_ensam=$total_non_valide_aca_ensam+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_ensam=0;
        $total_non_valide_fil_ensam=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_ensam=$total_valide_fil_ensam+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_ensam=$total_non_valide_fil_ensam+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_ensam=$total_valide_fil_ensam+$d_p[1]->number;
                $total_non_valide_fil_ensam=$total_non_valide_fil_ensam+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_ensam=0;
        $total_non_valide_bac_ensam=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_ensam=$total_valide_bac_ensam+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_ensam=$total_non_valide_bac_ensam+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_ensam=$total_valide_bac_ensam+$d_p[1]->number;
                $total_non_valide_bac_ensam=$total_non_valide_bac_ensam+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_ensam',$total_non_valide_ensam);
        Session::put('valid_ensam',$total_valide_ensam);
        Session::put('non_valide_prov_ensam',$total_non_valide_prov_ensam);
        Session::put('valide_prov_ensam',$total_valide_prov_ensam);
        Session::put('non_valide_aca_ensam',$total_non_valide_aca_ensam);
        Session::put('valide_aca_ensam',$total_valide_aca_ensam);
        Session::put('non_valide_fil_ensam',$total_non_valide_fil_ensam);
        Session::put('valide_fil_ensam',$total_valide_fil_ensam);
        Session::put('non_valide_bac_ensam',$total_non_valide_bac_ensam);
        Session::put('valide_bac_ensam',$total_valide_bac_ensam);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.ensam')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }
    public function stat_ens(Request $request){
        //return view('statistique.index');
        $filiere_ens=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_ens=0;
        $total_non_valide_ens=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_ens=$total_valide_ens+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_ens=$total_non_valide_ens+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_ens=$total_valide_ens+$d[1]->number;
                $total_non_valide_ens=$total_non_valide_ens+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_ens=0;
        $total_non_valide_prov_ens=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_ens=$total_valide_prov_ens+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_ens=$total_non_valide_prov_ens+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_ens=$total_valide_prov_ens+$d_p[1]->number;
                $total_non_valide_prov_ens=$total_non_valide_prov_ens+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_ens=0;
        $total_non_valide_aca_ens=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_ens=$total_valide_aca_ens+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_ens=$total_non_valide_aca_ens+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_ens=$total_valide_aca_ens+$d_p[1]->number;
                $total_non_valide_aca_ens=$total_non_valide_aca_ens+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_ens=0;
        $total_non_valide_fil_ens=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_ens=$total_valide_fil_ens+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_ens=$total_non_valide_fil_ens+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_ens=$total_valide_fil_ens+$d_p[1]->number;
                $total_non_valide_fil_ens=$total_non_valide_fil_ens+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_ens=0;
        $total_non_valide_bac_ens=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_ens=$total_valide_bac_ens+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_ens=$total_non_valide_bac_ens+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_ens=$total_valide_bac_ens+$d_p[1]->number;
                $total_non_valide_bac_ens=$total_non_valide_bac_ens+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_ens',$total_non_valide_ens);
        Session::put('valid_ens',$total_valide_ens);
        Session::put('non_valide_prov_ens',$total_non_valide_prov_ens);
        Session::put('valide_prov_ens',$total_valide_prov_ens);
        Session::put('non_valide_aca_ens',$total_non_valide_aca_ens);
        Session::put('valide_aca_ens',$total_valide_aca_ens);
        Session::put('non_valide_fil_ens',$total_non_valide_fil_ens);
        Session::put('valide_fil_ens',$total_valide_fil_ens);
        Session::put('non_valide_bac_ens',$total_non_valide_bac_ens);
        Session::put('valide_bac_ens',$total_valide_bac_ens);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.ens')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }

    public function stat_fpe(Request $request){
        //return view('statistique.index');
        $filiere_fpe=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();

        }
        /*foreach($filiere_fsjes as $f):
  var_dump($f->code_filiere_stat);
        endforeach;*/
        //var_dump($data);
        $total_valide_fpe=0;
        $total_non_valide_fpe=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fpe=$total_valide_fpe+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fpe=$total_non_valide_fpe+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fpe=$total_valide_fpe+$d[1]->number;
                $total_non_valide_fpe=$total_non_valide_fpe+$d[0]->number;
            }

        endforeach;

        $prov=DB::table('provinces')
            ->where('code_province_opi',41)
            ->get();

        $acad=DB::table('academies')
            ->where('code_academie','R')
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat','DUT103')
            ->get();
        $bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',23)
            ->get();
        $province = DB::table('provinces')
            ->get();
        $academie = DB::table('academies')
            ->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        $seriebac= DB::table('serie_bacs')
            ->get();
        // $data_province;
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data_prov[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', 41)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))

                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fpe=0;
        $total_non_valide_prov_fpe=0;
        foreach($data_prov as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_prov_fpe=$total_valide_prov_fpe+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_prov_fpe=$total_non_valide_prov_fpe+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_prov_fpe=$total_valide_prov_fpe+$d_p[1]->number;
                $total_non_valide_prov_fpe=$total_non_valide_prov_fpe+$d_p[0]->number;
            }

        endforeach;
        // echo ' totla province : \n' ;
        // var_dump($total_valide_prov);
        //var_dump($total_non_valide_prov);
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data_aca[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie', 'R')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_fpe=0;
        $total_non_valide_aca_fpe=0;
        foreach($data_aca as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_aca_fpe=$total_valide_aca_fpe+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_aca_fpe=$total_non_valide_aca_fpe+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_aca_fpe=$total_valide_aca_fpe+$d_p[1]->number;
                $total_non_valide_aca_fpe=$total_non_valide_aca_fpe+$d_p[0]->number;
            }

        endforeach;
        //  echo ' totla province : \n' ;
        //  var_dump($total_valide_aca);
        // var_dump($total_non_valide_aca);
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data_fil[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->where('inscription_pedagogiques.code_filiere', 'DUT103')
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fpe=0;
        $total_non_valide_fil_fpe=0;
        foreach($data_fil as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_fil_fpe=$total_valide_fil_fpe+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_fil_fpe=$total_non_valide_fil_fpe+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_fil_fpe=$total_valide_fil_fpe+$d_p[1]->number;
                $total_non_valide_fil_fpe=$total_non_valide_fil_fpe+$d_p[0]->number;
            }

        endforeach;
        //    echo ' totla province : \n' ;
        // var_dump($total_valide_fil);
        //  var_dump($total_non_valide_fil);
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data_bac[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi', 23)
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_bac_fpe=0;
        $total_non_valide_bac_fpe=0;
        foreach($data_bac as $d_p):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d_p)==1){
                if($d_p[0]->validation==true)
                    $total_valide_bac_fpe=$total_valide_bac_fpe+$d_p[0]->number;
                if($d_p[0]->validation==false)
                    $total_non_valide_bac_fpe=$total_non_valide_bac_fpe+$d_p[0]->number;
            }

            if(sizeof($d_p)==2){
                $total_valide_bac_fpe=$total_valide_bac_fpe+$d_p[1]->number;
                $total_non_valide_bac_fpe=$total_non_valide_bac_fpe+$d_p[0]->number;
            }

        endforeach;
        //   echo ' totla province : \n' ;
        //  var_dump($total_valide_bac);
        //  var_dump($total_non_valide_bac);
        //var_dump($bac);

        Session::put('non_valid_fpe',$total_non_valide_fpe);
        Session::put('valid_fpe',$total_valide_fpe);
        Session::put('non_valide_prov_fpe',$total_non_valide_prov_fpe);
        Session::put('valide_prov_fpe',$total_valide_prov_fpe);
        Session::put('non_valide_aca_fpe',$total_non_valide_aca_fpe);
        Session::put('valide_aca_fpe',$total_valide_aca_fpe);
        Session::put('non_valide_fil_fpe',$total_non_valide_fil_fpe);
        Session::put('valide_fil_fpe',$total_valide_fil_fpe);
        Session::put('non_valide_bac_fpe',$total_non_valide_bac_fpe);
        Session::put('valide_bac_fpe',$total_valide_bac_fpe);
        Session::put('nom_province',$prov[0]->libelle_province_fr);
        Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        Session::put('nom_filiere',$fil[0]->libelle_filiere);
        Session::put('nom_seriebac',$bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fpe')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$seriebac);
    }
    public function stat_prov(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));

        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_province_opi',$request->input('prov'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov')) {
            Session::pull('non_valide_prov');
            Session::put('non_valide_prov',$data[0]->number);
        }else{
            Session::put('non_valide_prov',$data[0]->number);
        }
        if ($request->session()->exists('valide_prov')) {
            //
            Session::pull('valide_prov');
            Session::put('valide_prov',$data[1]->number);
        }else{
            Session::put('valide_prov',$data[1]->number);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.index')->with('non_valide_prov', json_encode($data[0]->number))
            ->with('valide_prov', json_encode($data[1]->number))
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_prov_estm(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_estm'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_estm=0;
        $total_non_valide_prov_estm=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_estm=$total_valide_prov_estm+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_estm=$total_non_valide_prov_estm+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_estm=$total_valide_prov_estm+$d[1]->number;
                $total_non_valide_prov_estm=$total_non_valide_prov_estm+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_estm'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_estm')) {
            Session::pull('non_valide_prov_estm');
            Session::put('non_valide_prov_estm',$total_non_valide_prov_estm);
        }else{
            Session::put('non_valide_prov_estm',$total_non_valide_prov_estm);
        }
        if ($request->session()->exists('valide_prov_estm')) {
            //
            Session::pull('valide_prov_estm');
            Session::put('valide_prov_estm',$total_valide_prov_estm);
        }else{
            Session::put('valide_prov_estm',$total_valide_prov_estm);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.estm')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_prov_fs(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fs=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_fs'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fs=0;
        $total_non_valide_prov_fs=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_fs=$total_valide_prov_fs+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_fs=$total_non_valide_prov_fs+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_fs=$total_valide_prov_fs+$d[1]->number;
                $total_non_valide_prov_fs=$total_non_valide_prov_fs+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_fs'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_fs')) {
            Session::pull('non_valide_prov_fs');
            Session::put('non_valide_prov_fs',$total_non_valide_prov_fs);
        }else{
            Session::put('non_valide_prov_fs',$total_non_valide_prov_fs);
        }
        if ($request->session()->exists('valide_prov_fs')) {
            //
            Session::pull('valide_prov_fs');
            Session::put('valide_prov_fs',$total_valide_prov_fs);
        }else{
            Session::put('valide_prov_fs',$total_valide_prov_fs);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.fs')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_prov_fsjes(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_fsjes'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fsjes=0;
        $total_non_valide_prov_fsjes=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_fsjes=$total_valide_prov_fsjes+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_fsjes=$total_non_valide_prov_fsjes+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_fsjes=$total_valide_prov_fsjes+$d[1]->number;
                $total_non_valide_prov_fsjes=$total_non_valide_prov_fsjes+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_fsjes'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_fsjes')) {
            Session::pull('non_valide_prov_fsjes');
            Session::put('non_valide_prov_fsjes',$total_non_valide_prov_fsjes);
        }else{
            Session::put('non_valide_prov_fsjes',$total_non_valide_prov_fsjes);
        }
        if ($request->session()->exists('valide_prov_fsjes')) {
            //
            Session::pull('valide_prov_fsjes');
            Session::put('valide_prov_fsjes',$total_valide_prov_fsjes);
        }else{
            Session::put('valide_prov_fsjes',$total_valide_prov_fsjes);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.fsjes')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_prov_flsh(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_flsh'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_flsh=0;
        $total_non_valide_prov_flsh=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_flsh=$total_valide_prov_flsh+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_flsh=$total_non_valide_prov_flsh+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_flsh=$total_valide_prov_flsh+$d[1]->number;
                $total_non_valide_prov_flsh=$total_non_valide_prov_flsh+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_flsh'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_flsh')) {
            Session::pull('non_valide_prov_flsh');
            Session::put('non_valide_prov_flsh',$total_non_valide_prov_flsh);
        }else{
            Session::put('non_valide_prov_flsh',$total_non_valide_prov_flsh);
        }
        if ($request->session()->exists('valide_prov_flsh')) {
            //
            Session::pull('valide_prov_flsh');
            Session::put('valide_prov_flsh',$total_valide_prov_flsh);
        }else{
            Session::put('valide_prov_flsh',$total_valide_prov_flsh);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.flsh')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_prov_fst(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fst=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_fst'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fst=0;
        $total_non_valide_prov_fst=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_fst=$total_valide_prov_fst+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_fst=$total_non_valide_prov_fst+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_fst=$total_valide_prov_fst+$d[1]->number;
                $total_non_valide_prov_fst=$total_non_valide_prov_fst+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_fst'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_fst')) {
            Session::pull('non_valide_prov_fst');
            Session::put('non_valide_prov_fst',$total_non_valide_prov_fst);
        }else{
            Session::put('non_valide_prov_fst',$total_non_valide_prov_fst);
        }
        if ($request->session()->exists('valide_prov_fst')) {
            //
            Session::pull('valide_prov_fst');
            Session::put('valide_prov_fst',$total_valide_prov_fst);
        }else{
            Session::put('valide_prov_fst',$total_valide_prov_fst);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.fst')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_prov_ensam(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ensam=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_ensam'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_ensam=0;
        $total_non_valide_prov_ensam=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_ensam=$total_valide_prov_ensam+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_ensam=$total_non_valide_prov_ensam+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_ensam=$total_valide_prov_ensam+$d[1]->number;
                $total_non_valide_prov_ensam=$total_non_valide_prov_ensam+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_ensam'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_ensam')) {
            Session::pull('non_valide_prov_ensam');
            Session::put('non_valide_prov_ensam',$total_non_valide_prov_ensam);
        }else{
            Session::put('non_valide_prov_ensam',$total_non_valide_prov_ensam);
        }
        if ($request->session()->exists('valide_prov_ensam')) {
            //
            Session::pull('valide_prov_ensam');
            Session::put('valide_prov_ensam',$total_valide_prov_ensam);
        }else{
            Session::put('valide_prov_ensam',$total_valide_prov_ensam);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.ensam')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_prov_ens(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ens=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_ens'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_ens=0;
        $total_non_valide_prov_ens=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_ens=$total_valide_prov_ens+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_ens=$total_non_valide_prov_ens+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_ens=$total_valide_prov_ens+$d[1]->number;
                $total_non_valide_prov_ens=$total_non_valide_prov_ens+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_ens'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_ens')) {
            Session::pull('non_valide_prov_ens');
            Session::put('non_valide_prov_ens',$total_non_valide_prov_ens);
        }else{
            Session::put('non_valide_prov_ens',$total_non_valide_prov_ens);
        }
        if ($request->session()->exists('valide_prov_ens')) {
            //
            Session::pull('valide_prov_ens');
            Session::put('valide_prov_ens',$total_valide_prov_ens);
        }else{
            Session::put('valide_prov_ens',$total_valide_prov_ens);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.ens')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_prov_fpe(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fpe=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_province_opi', $request->input('prov_ens'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_prov_fpe=0;
        $total_non_valide_prov_fpe=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_prov_fpe=$total_valide_prov_fpe+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_prov_fpe=$total_non_valide_prov_fpe+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_prov_fpe=$total_valide_prov_fpe+$d[1]->number;
                $total_non_valide_prov_fpe=$total_non_valide_prov_fpe+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        $bac=DB::table('serie_bacs')->get();
        $prov=DB::table('provinces')
            ->where('code_province_opi',$request->input('prov_fpe'))
            ->get();
        // var_dump($data);

        // $data_province;
        if ($request->session()->exists('non_valide_prov_fpe')) {
            Session::pull('non_valide_prov_fpe');
            Session::put('non_valide_prov_fpe',$total_non_valide_prov_fpe);
        }else{
            Session::put('non_valide_prov_fpe',$total_non_valide_prov_fpe);
        }
        if ($request->session()->exists('valide_prov_fpe')) {
            //
            Session::pull('valide_prov_fpe');
            Session::put('valide_prov_fpe',$total_valide_prov_fpe);
        }else{
            Session::put('valide_prov_fpe',$total_valide_prov_fpe);
        }
        if ($request->session()->exists('nom_province')) {
            Session::pull('nom_province');
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }else{
            Session::put('nom_province',$prov[0]->libelle_province_fr);
        }

        return view('statistique.fpe')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_aca(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));

        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_academie',$request->input('aca'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();
        // var_dump($data);
        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca'))
            ->get();
        // $data_province;
        if ($request->session()->exists('non_valide_aca')) {
            Session::pull('non_valide_aca');
            Session::put('non_valide_aca',$data[0]->number);
        }else{
            Session::put('non_valide_aca',$data[0]->number);
        }
        if ($request->session()->exists('valide_aca')) {
            //
            Session::pull('valide_aca');
            Session::put('valide_aca',$data[1]->number);
        }
        else{
            Session::put('valide_aca',$data[1]->number);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_province',$acad[0]->libelle_academie_fr);
        }
        return view('statistique.index')->with('non_valide_aca', json_encode($data[0]->number))
            ->with('valide_aca', json_encode($data[1]->number))
            ->with('province',$province)
            ->with('filiere',$filiere)
            ->with('academie',$academie)
            ->with('seriebac',$bac);
    }
    public function stat_aca_estm(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_estm'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_estm=0;
        $total_non_valide_aca_estm=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_estm=$total_valide_aca_estm+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_estm=$total_non_valide_aca_estm+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_estm=$total_valide_aca_estm+$d[1]->number;
                $total_non_valide_aca_estm=$total_non_valide_aca_estm+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_estm'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_estm')) {
            Session::pull('non_valide_aca_estm');
            Session::put('non_valide_aca_estm',$total_non_valide_aca_estm);
        }else{
            Session::put('non_valide_aca_estm',$total_non_valide_aca_estm);
        }
        if ($request->session()->exists('valide_aca_estm')) {
            //
            Session::pull('valide_aca_estm');
            Session::put('valide_aca_estm',$total_valide_aca_estm);
        }else{
            Session::put('valide_aca_estm',$total_valide_aca_estm);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.estm')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_aca_fs(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_fs'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_aca_fs=0;
        $total_non_valide_aca_fs=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_fs=$total_valide_aca_fs+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_fs=$total_non_valide_aca_fs+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_fs=$total_valide_aca_fs+$d[1]->number;
                $total_non_valide_aca_fs=$total_non_valide_aca_fs+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_fs'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_fs')) {
            Session::pull('non_valide_aca_fs');
            Session::put('non_valide_aca_fs',$total_non_valide_aca_fs);
        }else{
            Session::put('non_valide_aca_fs',$total_non_valide_aca_fs);
        }
        if ($request->session()->exists('valide_aca_fs')) {
            //
            Session::pull('valide_aca_fs');
            Session::put('valide_aca_fs',$total_valide_aca_fs);
        }else{
            Session::put('valide_aca_fs',$total_valide_aca_fs);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.fs')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_aca_fsjes(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_fsjes'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

       $total_valide_aca_fsjes=0;
        $total_non_valide_aca_fsjes=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_fsjes=$total_valide_aca_fsjes+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_fsjes=$total_non_valide_aca_fsjes+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_fsjes=$total_valide_aca_fsjes+$d[1]->number;
                $total_non_valide_aca_fsjes=$total_non_valide_aca_fsjes+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_fsjes'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_fsjes')) {
            Session::pull('non_valide_aca_fsjes');
            Session::put('non_valide_aca_fsjes',$total_non_valide_aca_fsjes);
        }else{
            Session::put('non_valide_aca_fsjes',$total_non_valide_aca_fsjes);
        }
        if ($request->session()->exists('valide_aca_fsjes')) {
            //
            Session::pull('valide_aca_fsjes');
            Session::put('valide_aca_fsjes',$total_valide_aca_fsjes);
        }else{
            Session::put('valide_aca_fsjes',$total_valide_aca_fsjes);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.fsjes')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_aca_flsh(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_flsh=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_flsh'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_aca_flsh=0;
        $total_non_valide_aca_flsh=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_flsh=$total_valide_aca_flsh+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_flsh=$total_non_valide_aca_flsh+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_flsh=$total_valide_aca_flsh+$d[1]->number;
                $total_non_valide_aca_flsh=$total_non_valide_aca_flsh+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_flsh'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_flsh')) {
            Session::pull('non_valide_aca_flsh');
            Session::put('non_valide_aca_flsh',$total_non_valide_aca_flsh);
        }else{
            Session::put('non_valide_aca_flsh',$total_non_valide_aca_flsh);
        }
        if ($request->session()->exists('valide_aca_flsh')) {
            //
            Session::pull('valide_aca_flsh');
            Session::put('valide_aca_flsh',$total_valide_aca_flsh);
        }else{
            Session::put('valide_aca_flsh',$total_valide_aca_flsh);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.flsh')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_aca_fst(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fst=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_fst'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_aca_fst=0;
        $total_non_valide_aca_fst=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_fst=$total_valide_aca_fst+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_flsh=$total_non_valide_aca_fst+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_fst=$total_valide_aca_fst+$d[1]->number;
                $total_non_valide_aca_fst=$total_non_valide_aca_fst+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_fst'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_fst')) {
            Session::pull('non_valide_aca_fst');
            Session::put('non_valide_aca_fst',$total_non_valide_aca_fst);
        }else{
            Session::put('non_valide_aca_fst',$total_non_valide_aca_fst);
        }
        if ($request->session()->exists('valide_aca_fst')) {
            //
            Session::pull('valide_aca_fst');
            Session::put('valide_aca_fst',$total_valide_aca_fst);
        }else{
            Session::put('valide_aca_fst',$total_valide_aca_fst);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.fst')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_aca_ensam(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ensam=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_ensam'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_aca_ensam=0;
        $total_non_valide_aca_ensam=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_ensam=$total_valide_aca_ensam+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_ensam=$total_non_valide_aca_ensam+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_ensam=$total_valide_aca_ensam+$d[1]->number;
                $total_non_valide_aca_ensam=$total_non_valide_aca_ensam+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_ensam'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_ensam')) {
            Session::pull('non_valide_aca_ensam');
            Session::put('non_valide_aca_ensam',$total_non_valide_aca_ensam);
        }else{
            Session::put('non_valide_aca_ensam',$total_non_valide_aca_ensam);
        }
        if ($request->session()->exists('valide_aca_ensam')) {
            //
            Session::pull('valide_aca_ensam');
            Session::put('valide_aca_ensam',$total_valide_aca_ensam);
        }else{
            Session::put('valide_aca_ensam',$total_valide_aca_ensam);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.ensam')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_aca_ens(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ens=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_ens'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_aca_ens=0;
        $total_non_valide_aca_ens=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_ens=$total_valide_aca_ens+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_ens=$total_non_valide_aca_ens+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_ens=$total_valide_aca_ens+$d[1]->number;
                $total_non_valide_aca_ens=$total_non_valide_aca_ens+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_ens'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_ens')) {
            Session::pull('non_valide_aca_ens');
            Session::put('non_valide_aca_ens',$total_non_valide_aca_ens);
        }else{
            Session::put('non_valide_aca_ens',$total_non_valide_aca_ens);
        }
        if ($request->session()->exists('valide_aca_ens')) {
            //
            Session::pull('valide_aca_ens');
            Session::put('valide_aca_ens',$total_valide_aca_ens);
        }else{
            Session::put('valide_aca_ens',$total_valide_aca_ens);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.ens')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_aca_fpe(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fpe=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_academie',$request->input('aca_fpe'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_aca_fpe=0;
        $total_non_valide_aca_fpe=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_aca_fpe=$total_valide_aca_fpe+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_aca_fpe=$total_non_valide_aca_fpe+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_aca_fpe=$total_valide_aca_fpe+$d[1]->number;
                $total_non_valide_aca_fpe=$total_non_valide_aca_fpe+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $acad=DB::table('academies')
            ->where('code_academie',$request->input('aca_fpe'))
            ->get();


        // $data_province;
        if ($request->session()->exists('non_valide_aca_fpe')) {
            Session::pull('non_valide_aca_fpe');
            Session::put('non_valide_aca_fpe',$total_non_valide_aca_fpe);
        }else{
            Session::put('non_valide_aca_fpe',$total_non_valide_aca_fpe);
        }
        if ($request->session()->exists('valide_aca_fpe')) {
            //
            Session::pull('valide_aca_fpe');
            Session::put('valide_aca_fpe',$total_valide_aca_fpe);
        }else{
            Session::put('valide_aca_fpe',$total_valide_aca_fpe);
        }
        if ($request->session()->exists('nom_academie')) {
            Session::pull('nom_academie');
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }else{
            Session::put('nom_academie',$acad[0]->libelle_academie_fr);
        }

        return view('statistique.fpe')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));

        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_filiere',$request->input('fil'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();
        // var_dump($data);
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil'))
            ->get();
        // $data_province;
        if ($request->session()->exists('non_valide_fil')) {
            Session::pull('non_valide_fil');
            Session::put('non_valide_fil',$data[0]->number);
        }else{
            Session::put('non_valide_fil',$data[0]->number);
        }
        if ($request->session()->exists('valide_fil')) {
            //
            Session::pull('valide_fil');
            Session::put('valide_fil',$data[1]->number);
        }
        else{
            Session::put('valide_fil',$data[1]->number);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }
        return view('statistique.index')->with('non_valide_aca', json_encode($data[0]->number))
            ->with('valide_aca', json_encode($data[1]->number))
            ->with('province',$province)
            ->with('filiere',$filiere)
            ->with('academie',$academie)
            ->with('seriebac',$bac);
    }
    public function stat_fil_estm(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_estm'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_estm=0;
        $total_non_valide_fil_estm=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_estm=$total_valide_fil_estm+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_estm=$total_non_valide_fil_estm+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_estm=$total_valide_fil_estm+$d[1]->number;
                $total_non_valide_fil_estm=$total_non_valide_fil_estm+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_estm'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_estm')) {
            Session::pull('non_valide_fil_estm');
            Session::put('non_valide_fil_estm',$total_non_valide_fil_estm);
        }else{
            Session::put('non_valide_fil_estm',$total_non_valide_fil_estm);
        }
        if ($request->session()->exists('valide_fil_estm')) {
            //
            Session::pull('valide_fil_estm');
            Session::put('valide_fil_estm',$total_valide_fil_estm);
        }else{
            Session::put('valide_fil_estm',$total_valide_fil_estm);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.estm')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_fs(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fs=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_fs'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fs=0;
        $total_non_valide_fil_fs=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_fs=$total_valide_fil_fs+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_fs=$total_non_valide_fil_fs+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_fs=$total_valide_fil_fs+$d[1]->number;
                $total_non_valide_fil_fs=$total_non_valide_fil_fs+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_fs'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_fs')) {
            Session::pull('non_valide_fil_fs');
            Session::put('non_valide_fil_fs',$total_non_valide_fil_fs);
        }else{
            Session::put('non_valide_fil_fs',$total_non_valide_fil_fs);
        }
        if ($request->session()->exists('valide_fil_fs')) {
            //
            Session::pull('valide_fil_fs');
            Session::put('valide_fil_fs',$total_valide_fil_fs);
        }else{
            Session::put('valide_fil_fs',$total_valide_fil_fs);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.fs')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_fsjes(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_fsjes'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fsjes=0;
        $total_non_valide_fil_fsjes=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_fsjes=$total_valide_fil_fsjes+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_fsjes=$total_non_valide_fil_fsjes+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_fsjes=$total_valide_fil_fsjes+$d[1]->number;
                $total_non_valide_fil_fsjes=$total_non_valide_fil_fsjes+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_fsjes'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_fsjes')) {
            Session::pull('non_valide_fil_fsjes');
            Session::put('non_valide_fil_fsjes',$total_non_valide_fil_fsjes);
        }else{
            Session::put('non_valide_fil_fsjes',$total_non_valide_fil_fsjes);
        }
        if ($request->session()->exists('valide_fil_fsjes')) {
            //
            Session::pull('valide_fil_fsjes');
            Session::put('valide_fil_fsjes',$total_valide_fil_fsjes);
        }else{
            Session::put('valide_fil_fsjes',$total_valide_fil_fsjes);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.fsjes')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_flsh(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_flsh=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_flsh'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_flsh=0;
        $total_non_valide_fil_flsh=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_flsh=$total_valide_fil_flsh+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_flsh=$total_non_valide_fil_flsh+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_flsh=$total_valide_fil_flsh+$d[1]->number;
                $total_non_valide_fil_flsh=$total_non_valide_fil_flsh+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_flsh'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_flsh')) {
            Session::pull('non_valide_fil_flsh');
            Session::put('non_valide_fil_flsh',$total_non_valide_fil_flsh);
        }else{
            Session::put('non_valide_fil_flsh',$total_non_valide_fil_flsh);
        }
        if ($request->session()->exists('valide_fil_flsh')) {
            //
            Session::pull('valide_fil_flsh');
            Session::put('valide_fil_flsh',$total_valide_fil_flsh);
        }else{
            Session::put('valide_fil_flsh',$total_valide_fil_flsh);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.flsh')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_fil_fst(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fst=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_fst'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fst=0;
        $total_non_valide_fil_fst=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_fst=$total_valide_fil_fst+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_fst=$total_non_valide_fil_fst+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_fst=$total_valide_fil_fst+$d[1]->number;
                $total_non_valide_fil_fst=$total_non_valide_fil_fst+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_fst'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_fst')) {
            Session::pull('non_valide_fil_fst');
            Session::put('non_valide_fil_fst',$total_non_valide_fil_fst);
        }else{
            Session::put('non_valide_fil_fst',$total_non_valide_fil_fst);
        }
        if ($request->session()->exists('valide_fil_fst')) {
            //
            Session::pull('valide_fil_fst');
            Session::put('valide_fil_fst',$total_valide_fil_fst);
        }else{
            Session::put('valide_fil_fst',$total_valide_fil_fst);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.fst')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_ensam(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ensam=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_fst'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_ensam=0;
        $total_non_valide_fil_ensam=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_ensam=$total_valide_fil_ensam+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_ensam=$total_non_valide_fil_ensam+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_ensam=$total_valide_fil_ensam+$d[1]->number;
                $total_non_valide_fil_ensam=$total_non_valide_fil_ensam+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_ensam'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_ensam')) {
            Session::pull('non_valide_fil_ensam');
            Session::put('non_valide_fil_ensam',$total_non_valide_fil_ensam);
        }else{
            Session::put('non_valide_fil_ensam',$total_non_valide_fil_ensam);
        }
        if ($request->session()->exists('valide_fil_ensam')) {
            //
            Session::pull('valide_fil_ensam');
            Session::put('valide_fil_ensam',$total_valide_fil_ensam);
        }else{
            Session::put('valide_fil_ensam',$total_valide_fil_ensam);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.ensam')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_ens(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ens=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_ens'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_ens=0;
        $total_non_valide_fil_ens=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_ens=$total_valide_fil_ens+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_ens=$total_non_valide_fil_ens+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_ens=$total_valide_fil_ens+$d[1]->number;
                $total_non_valide_fil_ens=$total_non_valide_fil_ens+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_ens'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_ens')) {
            Session::pull('non_valide_fil_ens');
            Session::put('non_valide_fil_ens',$total_non_valide_fil_ens);
        }else{
            Session::put('non_valide_fil_ens',$total_non_valide_fil_ens);
        }
        if ($request->session()->exists('valide_fil_ens')) {
            //
            Session::pull('valide_fil_ens');
            Session::put('valide_fil_ens',$total_valide_fil_ens);
        }else{
            Session::put('valide_fil_ens',$total_valide_fil_ens);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.ens')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_fil_fpe(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fpe=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_filiere',$request->input('fil_fpe'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }
        $total_valide_fil_fpe=0;
        $total_non_valide_fil_fpe=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_fil_fpe=$total_valide_fil_fpe+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_fil_fpe=$total_non_valide_fil_fpe+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_fil_fpe=$total_valide_fil_fpe+$d[1]->number;
                $total_non_valide_fil_fpe=$total_non_valide_fil_fpe+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();

        $bac=DB::table('serie_bacs')->get();

        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('fil_fpe'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_fil_fpe')) {
            Session::pull('non_valide_fil_fpe');
            Session::put('non_valide_fil_fpe',$total_non_valide_fil_fpe);
        }else{
            Session::put('non_valide_fil_fpe',$total_non_valide_fil_fpe);
        }
        if ($request->session()->exists('valide_fil_fpe')) {
            //
            Session::pull('valide_fil_fpe');
            Session::put('valide_fil_fpe',$total_valide_fil_fpe);
        }else{
            Session::put('valide_fil_fpe',$total_valide_fil_fpe);
        }
        if ($request->session()->exists('nom_filiere')) {
            Session::pull('nom_filiere');
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }else{
            Session::put('nom_filiere',$fil[0]->libelle_filiere);
        }

        return view('statistique.fpe')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));

        $data = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')

            ->select(
                DB::raw('inscription_pedagogiques.validation as validation'),
                DB::raw('count(*) as number'))
            ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac'))
            ->groupBy('inscription_pedagogiques.validation')
            ->get();
        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')->get();
        $bac=DB::table('serie_bacs')->get();

        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac'))
            ->get();
        if ($request->session()->exists('non_valide_bac')) {
            Session::pull('non_valide_bac');
            Session::put('non_valide_bac',$data[0]->number);
        }else{
            Session::put('non_valide_bac',$data[0]->number);
        }
        if ($request->session()->exists('valide_bac')) {
            //
            Session::pull('valide_bac');
            Session::put('valide_bac',$data[1]->number);
        }
        else{
            Session::put('valide_bac',$data[1]->number);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        return view('statistique.index')->with('non_valide_aca', json_encode($data[0]->number))
            ->with('valide_aca', json_encode($data[1]->number))
            ->with('province',$province)
            ->with('filiere',$filiere)
            ->with('academie',$academie)
            ->with('seriebac',$bac);
    }
    public function stat_bac_estm(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_estm=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();
        for($i=0;$i<sizeof($filiere_estm);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_estm[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_estm'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

       $total_valide_bac_estm=0;
        $total_non_valide_bac_estm=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_estm=$total_valide_bac_estm+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_estm=$total_non_valide_bac_estm+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_estm=$total_valide_bac_estm+$d[1]->number;
                $total_non_valide_bac_estm=$total_non_valide_bac_estm+$d[0]->number;
            }

        endforeach;


        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',72)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_estm'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_estm'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_estm')) {
            Session::pull('non_valide_bac_estm');
            Session::put('non_valide_bac_estm',$total_non_valide_bac_estm);
        }else{
            Session::put('non_valide_bac_estm',$total_non_valide_bac_estm);
        }
        if ($request->session()->exists('valide_bac_estm')) {
            //
            Session::pull('valide_bac_estm');
            Session::put('valide_bac_estm',$total_valide_bac_estm);
        }else{
            Session::put('valide_bac_estm',$total_valide_bac_estm);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_fseriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }

        return view('statistique.estm')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_fs(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fs=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();
        for($i=0;$i<sizeof($filiere_fs);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fs[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_fs'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_fs=0;
        $total_non_valide_bac_fs=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_fs=$total_valide_bac_fs+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_fs=$total_non_valide_bac_fs+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_fs=$total_valide_bac_fs+$d[1]->number;
                $total_non_valide_bac_fs=$total_non_valide_bac_fs+$d[0]->number;
            }

        endforeach;


        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',47)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_fs'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_fs'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_fs')) {
            Session::pull('non_valide_bac_fs');
            Session::put('non_valide_bac_fs',$total_non_valide_bac_fs);
        }else{
            Session::put('non_valide_bac_fs',$total_non_valide_bac_fs);
        }
        if ($request->session()->exists('valide_bac_fs')) {
            //
            Session::pull('valide_bac_fs');
            Session::put('valide_bac_fs',$total_valide_bac_fs);
        }else{
            Session::put('valide_bac_fs',$total_valide_bac_fs);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_fseriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }

        return view('statistique.fs')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_fsjes(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fsjes=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();
        for($i=0;$i<sizeof($filiere_fsjes);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fsjes[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_fsjes'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_fsjes=0;
        $total_non_valide_bac_fsjes=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_fsjes=$total_valide_bac_fsjes+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_fsjes=$total_non_valide_bac_fsjes+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_fsjes=$total_valide_bac_fsjes+$d[1]->number;
                $total_non_valide_bac_fsjes=$total_non_valide_bac_fsjes+$d[0]->number;
            }

        endforeach;


        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',21)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_fsjes'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_fs'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_fsjes')) {
            Session::pull('non_valide_bac_fsjes');
            Session::put('non_valide_bac_fsjes',$total_non_valide_bac_fsjes);
        }else{
            Session::put('non_valide_bac_fsjes',$total_non_valide_bac_fsjes);
        }
        if ($request->session()->exists('valide_bac_fsjes')) {
            //
            Session::pull('valide_bac_fsjes');
            Session::put('valide_bac_fsjes',$total_valide_bac_fsjes);
        }else{
            Session::put('valide_bac_fsjes',$total_valide_bac_fsjes);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
    // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fsjes')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_flsh(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_flsh=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();
        for($i=0;$i<sizeof($filiere_flsh);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_flsh[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_flsh'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_flsh=0;
        $total_non_valide_bac_flsh=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_flsh=$total_valide_bac_flsh+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_flsh=$total_non_valide_bac_flsh+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_flsh=$total_valide_bac_flsh+$d[1]->number;
                $total_non_valide_bac_flsh=$total_non_valide_bac_flsh+$d[0]->number;
            }

        endforeach;


        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',35)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_flsh'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_flsh'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_flsh')) {
            Session::pull('non_valide_bac_flsh');
            Session::put('non_valide_bac_flsh',$total_non_valide_bac_flsh);
        }else{
            Session::put('non_valide_bac_flsh',$total_non_valide_bac_flsh);
        }
        if ($request->session()->exists('valide_bac_flsh')) {
            //
            Session::pull('valide_bac_flsh');
            Session::put('valide_bac_flsh',$total_valide_bac_flsh);
        }else{
            Session::put('valide_bac_flsh',$total_valide_bac_flsh);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.flsh')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }

    public function stat_bac_fst(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fst=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();
        for($i=0;$i<sizeof($filiere_fst);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fst[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_fst'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_fst=0;
        $total_non_valide_bac_fst=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_fst=$total_valide_bac_fst+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_fst=$total_non_valide_bac_fst+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_fst=$total_valide_bac_fst+$d[1]->number;
                $total_non_valide_bac_fst=$total_non_valide_bac_fst+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',52)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_fst'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_fst'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_fst')) {
            Session::pull('non_valide_bac_fst');
            Session::put('non_valide_bac_fst',$total_non_valide_bac_fst);
        }else{
            Session::put('non_valide_bac_fst',$total_non_valide_bac_fst);
        }
        if ($request->session()->exists('valide_bac_fst')) {
            //
            Session::pull('valide_bac_fst');
            Session::put('valide_bac_fst',$total_valide_bac_fst);
        }else{
            Session::put('valide_bac_fst',$total_valide_bac_fst);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fst')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_ensam(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ensam=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();
        for($i=0;$i<sizeof($filiere_ensam);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ensam[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_ensam'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_ensam=0;
        $total_non_valide_bac_ensam=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_ensam=$total_valide_bac_ensam+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_ensam=$total_non_valide_bac_ensam+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_ensam=$total_valide_bac_ensam+$d[1]->number;
                $total_non_valide_bac_ensam=$total_non_valide_bac_ensam+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',145)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_ensam'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_ensam'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_ensam')) {
            Session::pull('non_valide_bac_ensam');
            Session::put('non_valide_bac_ensam',$total_non_valide_bac_ensam);
        }else{
            Session::put('non_valide_bac_ensam',$total_non_valide_bac_ensam);
        }
        if ($request->session()->exists('valide_bac_ensam')) {
            //
            Session::pull('valide_bac_ensam');
            Session::put('valide_bac_ensam',$total_valide_bac_ensam);
        }else{
            Session::put('valide_bac_ensam',$total_valide_bac_ensam);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.ensam')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_ens(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_ens=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();
        for($i=0;$i<sizeof($filiere_ens);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_ens[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_ens'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_ens=0;
        $total_non_valide_bac_ens=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_ens=$total_valide_bac_ens+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_ens=$total_non_valide_bac_ens+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_ens=$total_valide_bac_ens+$d[1]->number;
                $total_non_valide_bac_ens=$total_non_valide_bac_ens+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',203)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_ens'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_ens'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_ens')) {
            Session::pull('non_valide_bac_ens');
            Session::put('non_valide_bac_ens',$total_non_valide_bac_ens);
        }else{
            Session::put('non_valide_bac_ens',$total_non_valide_bac_ens);
        }
        if ($request->session()->exists('valide_bac_ens')) {
            //
            Session::pull('valide_bac_ens');
            Session::put('valide_bac_ens',$total_valide_bac_ens);
        }else{
            Session::put('valide_bac_ens',$total_valide_bac_ens);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.ens')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
    public function stat_bac_fpe(Request $request ){
        //return view('statistique.index');
        // var_dump($request->input('prov'));
        $filiere_fpe=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();
        for($i=0;$i<sizeof($filiere_fpe);$i++) {
            $data[$i] = DB::table('etudiants')
                ->join('inscription_pedagogiques', 'etudiants.id_etudiant', '=', 'inscription_pedagogiques.id_etudiant')
                ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
                ->where('inscription_pedagogiques.code_filiere', $filiere_fpe[$i]->code_filiere_stat)
                ->where('inscription_pedagogiques.code_serie_baccalaureat_opi',$request->input('bac_fpe'))
                ->select(
                    DB::raw('inscription_pedagogiques.validation as validation'),
                    DB::raw('count(*) as number'))
                ->groupBy('inscription_pedagogiques.validation')
                ->get();
        }

        $total_valide_bac_fpe=0;
        $total_non_valide_bac_fpe=0;
        foreach($data as $d):
            //  if($t==sizeof($data)-1) break;
            if(sizeof($d)==1){
                if($d[0]->validation==true)
                    $total_valide_bac_fpe=$total_valide_bac_fpe+$d[0]->number;
                if($d[0]->validation==false)
                    $total_non_valide_bac_fpe=$total_non_valide_bac_fpe+$d[0]->number;
            }

            if(sizeof($d)==2){
                $total_valide_bac_fpe=$total_valide_bac_fpe+$d[1]->number;
                $total_non_valide_bac_fpe=$total_non_valide_bac_fpe+$d[0]->number;
            }

        endforeach;

        $province=DB::table('provinces')->get();
        $academie=DB::table('academies')->get();
        $filiere=DB::table('filieres')
            ->where('code_etablissement',166)
            ->get();

        $bac=DB::table('serie_bacs')->get();
        $s_bac=DB::table('serie_bacs')
            ->where('code_serie_baccalaureat_opi',$request->input('bac_fpe'))
            ->get();
        $fil=DB::table('filieres')
            ->where('code_filiere_stat',$request->input('bac_fpe'))
            ->get();

        // $data_province;
        if ($request->session()->exists('non_valide_bac_fpe')) {
            Session::pull('non_valide_bac_fpe');
            Session::put('non_valide_bac_fpe',$total_non_valide_bac_fpe);
        }else{
            Session::put('non_valide_bac_fpe',$total_non_valide_bac_fpe);
        }
        if ($request->session()->exists('valide_bac_ens')) {
            //
            Session::pull('valide_bac_fpe');
            Session::put('valide_bac_fpe',$total_valide_bac_fpe);
        }else{
            Session::put('valide_bac_fpe',$total_valide_bac_fpe);
        }
        if ($request->session()->exists('nom_seriebac')) {
            Session::pull('nom_seriebac');
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }else{
            Session::put('nom_seriebac',$s_bac[0]->libelle_baccalaureat_fr);
        }
        // var_dump($s_bac[0]->libelle_baccalaureat_fr);
        return view('statistique.fpe')
            ->with('province',$province)
            ->with('academie',$academie)
            ->with('filiere',$filiere)
            ->with('seriebac',$bac);
    }
}
