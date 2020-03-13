@extends('layout.app')

@section('title', '| Users')

@section('content')


<div class="container ">
    {{ csrf_field() }}
    <div class="table-responsive text-center">
<table class="table" id="table">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th class="text-center">First Name</th>
        <th class="text-center">Last Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Gender</th>
        <th class="text-center">Country</th>
        <th class="text-center">Salary ($)</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr class="item{{$item->id_etudiant_opi}}">
            <td>{{$item->id_etudiant_opi}}</td>
            <td>{{$item->nom_prenom_etud_fr}}</td>
            <td>{{$item->nom_prenom_etud_ar}}</td>
            <td>{{$item->cni_etudiant}}</td>
            <td>{{$item->date_naissance_etud}}</td>
            <td>{{$item->sexe_etudiant}}</td>
            <td>{{$item->annee_baccalaureat}}</td>
            <td><button class="edit-modal btn btn-info"
                        data-info="{{$item->id_etudiant_opi}},{{$item->nom_prenom_etud_fr}},{{$item->nom_prenom_etud_ar}},{{$item->cni_etudiant}},{{$item->date_naissance_etud}},{{$item->sexe_etudiant}},{{$item->annee_baccalaureat}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger"
                        data-info="{{$item->id_etudiant_opi}},{{$item->nom_prenom_etud_fr}},{{$item->nom_prenom_etud_ar}},{{$item->cni_etudiant}},{{$item->date_naissance_etud}},{{$item->sexe_etudiant}},{{$item->annee_baccalaureat}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
    @endforeach
    </tbody>
</table>
        </div>
    </div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_etudiant_opi" name="id_etudiant_opi" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nom_prenom_etud_fr">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom_prenom_etud_fr" name="nom_prenom_etud_fr">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lname">Last Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom_prenom_etud_ar" name="nom_prenom_etud_ar">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cni_etudiant" name="cni_etudiant">
                        </div>
                    </div>
                    <p class="email_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="gender">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="sexe_etudiant" name="sexe_etudiant">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="country">Country:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="date_naissance_etud" name="date_naissance_etud">
                        </div>
                    </div>
                    <p
                            class="country_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salary">Salary </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="annee_baccalaureat" name="annee_baccalaureat">
                        </div>
                    </div>
                    <p
                            class="salary_error error text-center alert alert-danger hidden"></p>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
    </script>
<script>
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');

    });

    function fillmodalData(details){
        $('#id_etudiant_opi').val(details[0]);
        $('#nom_prenom_etud_fr').val(details[1]);
        $('#nom_prenom_etud_ar').val(details[2]);
        $('#cni_etudiant').val(details[3]);
        $('#date_naissance_etud').val(details[4]);
        $('#sexe_etudiant').val(details[5]);
        $('#annee_baccalaureat').val(details[6]);
    }
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id_etudiant_opi': $("#id_etudiant_opi").val(),
                'nom_prenom_etud_fr': $('#nom_prenom_etud_fr').val(),
                'nom_prenom_etud_ar': $('#nom_prenom_etud_ar').val(),
                'cni_etudiant': $('#cni_etudiant').val(),
                'date_naissance_etud': $('#date_naissance_etud').val(),
                'sexe_etudiant': $('#sexe_etudiant').val(),
                'annee_baccalaureat': $('#annee_baccalaureat').val()
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.nom_prenom_etud_fr) {
                        $('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.nom_prenom_etud_ar) {
                        $('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.cni_etudiant) {
                        $('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.date_naissance_etud) {
                        $('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.sexe_etudiant) {
                        $('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
                else {

                    $('.error').addClass('hidden');
                    $('.item' + data.id_etudiant_opi).replaceWith("<tr class='item" + data.id_etudiant_opi + "'><td>" +
                    data.id_etudiant_opi + "</td><td>" + data.nom_prenom_etud_fr +
                    "</td><td>" + data.nom_prenom_etud_ar + "</td><td>" + data.cni_etudiant + "</td><td>" +
                    data.date_naissance_etud + "</td><td>" + data.sexe_etudiant + "</td><td>" + data.annee_baccalaureat +
                    "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id_etudiant_opi+","+data.nom_prenom_etud_fr+","+data.nom_prenom_etud_ar+","+data.cni_etudiant+","+data.date_naissance_etud+","+data.sexe_etudiant+","+data.annee_baccalaureat+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id_etudiant_opi+","+data.nom_prenom_etud_fr+","+data.nom_prenom_etud_ar+","+data.cni_etudiant+","+data.date_naissance_etud+","+data.sexe_etudiant+","+data.annee_baccalaureat+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }}
        });
    });
</script>

    @endsection

