@extends('layout.appdata')

@section('title', '| Users')

@section('content')

            <form class="form-horizontal" action="{{url('valide_recu')}}" method="get" style="padding-left: 50px;padding-top: 50px;">
                {{csrf_field()}}
                <div class="clearfix">
                    <div class="pull-left alert alert-success no-margin alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>

                        <i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
                        Personnaliser les informations à générer dans le reçu d'inscription concernant les étudiants dans votre établissement
                    </div>


                </div>
                <div class="row" style="width: 600px;margin-top: 40px;">
                    <div class="col-md-6" >
                 <div>
                    <label for="form-field-select-1"><b> établissement</b></label>
                    <select class="form-control" name="etablissement" id="form-field-select-1" style="margin-bottom: 10px;">
                        @foreach($etab as $etab)
                            <option value="{{$etab->code_etablissement_stat}}" >{{$etab->libelle_etablissement_fr }}</option>

                            <!-- <option value="2" selected="selected">2</option>-->
                        @endforeach
                    </select>
                 </div>
                <div>
                    <label for="form-field-select-1"><b>nom et prenom étudiant</b></label>
                    <select class="form-control" name="nom" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>cne étudiant</b></label>
                    <select class="form-control" name="cne" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>code massar étudiant</b></label>
                    <select class="form-control" name="code_massar" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>date naissance étudiant</b></label>
                    <select class="form-control" name="date_naiss" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>ville naissance</b></label>
                    <select class="form-control" name="ville_naiss" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                        </div>


                    <div class="col-md-6">
                <div>
                    <label for="form-field-select-1"><b>diplôme étudiant</b></label>
                    <select class="form-control" name="diplome" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>filière étudiant</b></label>
                    <select class="form-control" name="filiere" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>année universitiare</b></label>
                    <select class="form-control" name="annee_univ" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>le caché</b></label>
                    <select class="form-control" name="cache" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                    <label for="form-field-select-1"><b>numéro de dossiere</b></label>
                    <select class="form-control" name="nd" id="form-field-select-1" style="margin-bottom: 10px;">
                        <option  value="1" >oui</option>
                        <option  value="0" >non</option>
                    </select>
                </div>
                <div>
                </div>
                    </div>
                        <button style=" margin-top: 80px;margin-left: -40px;" type="submit" class="btn btn-info" >
                            enregistrer
                        </button>
                    </div>

                </form>



    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>



    <script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('assets/js/bootbox.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.hotkeys.index.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/spinbox.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>
    <script src="{{asset('assets/js/ace-editable.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.maskedinput.min.js')}}"></script>

    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>
    <!-- <![endif]-->

    <!--[if IE]>

    <![endif]-->
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


@endsection