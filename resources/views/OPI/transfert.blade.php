@extends('layout.appdata')

@section('title', '| Filieres')

@section('content')




    <div class="row" style="margin:20px;">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Transfert</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <form class="form-inline" action="{{url('upd_transfert/'.$opi[0]->id_etudiant_opi)}}" method="post" >
                            <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}
                            <!-- <legend>Form</legend> -->
                            <fieldset>
                                <span class="help-block"> Demande de transfert pour la filiere</span>
                                <label>Cne</label>
                                <input type="text" name="id_etudiant_opi" value="{{$opi[0]->id_etudiant_opi}}" placeholder="Type something&hellip;"  readonly="" />
                                <label style="margin-left: 15px;margin-right: 5px;">Code massar</label>
                                <input type="text" name="code_massar" value="{{$opi[0]->code_massar}}" placeholder="Type something&hellip;"  readonly="" />
                                <label style="margin-left: 15px; margin-right: 5px;">nom prenom</label>
                                <input type="text" name="nom_prenom_etud_fr" value="{{$opi[0]->nom_prenom_etud_fr}}" placeholder="Type something&hellip;"  readonly="" />
                                <label style="margin-left: 15px; margin-right: 5px;">province</label>
                                <input type="text" name="province" value="{{$lib_prov}}" placeholder="Type something&hellip;"  readonly="" />

                                <label style="margin-left: 280px;margin-top: 30px;margin-right: 10px;">Filiere Demandé</label>
                                <select class="form-control"  id="code_fil" name="code_fil" style="width: 250px">
                                    @foreach($filieres as $f)
                                        <option value="{{$f->code_filiere_stat}}" >{{$f->libelle_filiere}}</option>

                                    @endforeach
                                </select>


                                <label class="pull-right">

                                </label>
                            </fieldset>

                            <div class="form-actions center">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Envoyer
                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
