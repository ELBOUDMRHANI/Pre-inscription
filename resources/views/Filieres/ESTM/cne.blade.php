@extends('layout.appdata')

@section('title', '| Filieres')

@section('content')




    <div class="row" style="margin:20px;">
        <div class="col-sm-8">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Default</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <form method="get" action="{{url('demestm')}}">
                            <!-- <legend>Form</legend> -->
                            <fieldset>
                                <span class="help-block">Taper le CNE d'etudiant qu'ademandé changement de la filiere.</span>
                                <label>CNE Etudiant</label>

                                <input type="text" name="id_etud" placeholder="Type something&hellip;" />

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
