@extends('layout.app')

@section('title', '| Roles')

@section('content')
    <div class="widget-toolbar no-border">


    <label for="form-field-select-3">Chosen</label>

    <br />
        <select class="mdb-select md-form" searchable="Search here..">
            <option value="" disabled selected>Choose your country</option>
            <option value="">  </option>
        @foreach($province as $prov)

            <option ><a href="#" class="blue">
                    <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                    {{$prov->libelle_province_fr}}
                </a>
            </option>

        @endforeach
    </select>
        <label class="mdb-main-label">Label example</label>


</div>
    <select class="mdb-select md-form" searchable="Search here..">
        <option value="" disabled selected>Choose your country</option>
        <option value="1">USA</option>
        <option value="2">Germany</option>
        <option value="3">France</option>
        <option value="3">Poland</option>
        <option value="3">Japan</option>
    </select>
    <label class="mdb-main-label">Label example</label>
    <div class="col-lg-5">
    <div class="form-group">
        <label for="tokens">Key words (data-tokens)</label>
        <select class="selectpicker form-control" id="number" data-container="body" data-live-search="true" title="Select a number" data-hide-disabled="false">
            <option data-tokens="first">I actually</option>
            <option data-tokens="second">And me</option>
            <option data-tokens="last">three"</option>
        </select>
    </div>
</div>


    <?php

    /*$list_all = DB::table('etudiants')
            ->join('inscription_pedagogiques','etudiants.id_etudiant', '=','inscription_pedagogiques.id_etudiant')
            ->join('dossier_amos', 'etudiants.id_etudiant', '=', 'dossier_amos.id_etudiant')
            ->join('filieres','inscription_pedagogiques.code_filiere','=','filieres.code_filiere_stat')
            ->where('filieres.code_etablissement', 72)
            ->select('etudiants.*', 'inscription_pedagogiques.*', 'dossier_amos.*')
            ->orderBy('nom_etudiant_fr','ASC')
            ->get();
    var_dump($list_all);*/
            ?>





    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/mdb.js')}}"></script>
    <script src="{{asset('assets/js/mdb.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/js/bootstrap-select.js')}}"></script>



    <script>
    function createOptions(number) {
    var options = [], _options;

    for (var i = 0; i < number; i++) {
    var option = '<option value="' + i + '">Option ' + i + '</option>';
    options.push(option);
    }

    _options = options.join('');

    $('#number')[0].innerHTML = _options;
    $('#number-multiple')[0].innerHTML = _options;

    $('#number2')[0].innerHTML = _options;
    $('#number2-multiple')[0].innerHTML = _options;
    }

    var mySelect = $('#first-disabled2');

    createOptions(4000);

    $('#special').on('click', function () {
    mySelect.find('option:selected').prop('disabled', true);
    mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
    mySelect.find('option:disabled').prop('disabled', false);
    mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
    liveSearch: true,
    maxOptions: 1
    });
    </script>

@endsection