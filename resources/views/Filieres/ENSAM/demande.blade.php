@extends('layout.appdata')

@section('title', '| Filieres')

@section('content')




    <div class="row" style="margin:20px;">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Default</h4>
                </div>
               <div class="widget-body">
                   <div class="widget-main no-padding">
            <form class="form-inline" action="{{url('updi/'.$cne)}}" method="post" >
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <!-- <legend>Form</legend> -->
                <fieldset>
                    <span class="help-block">Example block-level help text here.</span>
                    <label>CNE Etudiant</label>

                    <input type="text" name="id_etud" value="{{$cne}}" placeholder="Type something&hellip;"  readonly="" />
                    <label style="margin-left: 20px;">Filiere Actuel</label>

                    <input type="text" name="fil_actuel" value="{{$filiere[0]->libelle_filiere}}" placeholder="Type something&hellip;" readonly="" style="width: 250px;" />
                        <label style="margin-left: 20px;">Filiere Demandé</label>
                        <select class="form-control"  id="code_nv_fil" name="code_nv_fil" style="width: 250px">
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
