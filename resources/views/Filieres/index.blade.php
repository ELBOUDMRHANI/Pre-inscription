@extends('layout.appdata')

@section('title', '| Filieres')

@section('content')

    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">L'ajoute d'une filière</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{action('FiliereController@store')}}" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <label>Code Filiere</label>
                                <input type="text" class="form-control"  name="code_filiere_stat" placeholder="Code filiere">
                            </div>
                            <div class="col-md-6">
                                <label>Libelle filiere</label>
                                <input type="text" class="form-control"  name="libelle_filiere"   placeholder="libelle filiere" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Etablissement</label>
                                <select class="form-control"  name="code_etablissement" >
                                    @foreach($etablissements as $e)
                                        <option value="{{$e->code_etablissement_stat}}" >{{$e->libelle_etablissement_fr}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Abreviation filiere</label>
                                <input type="text" class="form-control"  name="abreviation_filiere"   placeholder="abreviation filiere" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Code Ldap</label>
                                <input type="text" class="form-control"  name="code_ldap_filiere"   placeholder="Code ldap" >
                            </div>
                            <div class="col-md-6">
                                <label>Diplome</label>
                                <select class="form-control"  name="code_diplome" >
                                    @foreach($diplomes as $d)
                                        <option value="{{$d->code_diplome}}" >{{$d->libelle_diplome_fr}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    {{-- end modal --}}



    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier table Filiere</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/filiere" method="post" id="editForm">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        <div class="row">
                            <div class="col-md-6">
                                <label>Code Filiere</label>
                                <input type="text" class="form-control" id="code_filiere_stat" name="code_filiere_stat" placeholder="code filiere">
                            </div>
                            <div class="col-md-6">
                                <label>Libelle filiere</label>
                                <input type="text" class="form-control" id="libelle_filiere" name="libelle_filiere"   placeholder="libelle filiere" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Etablissement</label>
                                <select class="form-control"  id="code_etablissement" name="code_etablissement" >
                                    @foreach($etablissements as $e)
                                        <option value="{{$e->code_etablissement_stat}}" >{{$e->libelle_etablissement_fr}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Abreviation filiere</label>
                                <input type="text" class="form-control" id="abreviation_filiere" name="abreviation_filiere"   placeholder="abreviation filiere" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Code Ldap</label>
                                <input type="text" class="form-control" id="code_ldap_filiere" name="code_ldap_filiere"   placeholder="Code ldap" >
                            </div>
                            <div class="col-md-6">
                                <label>Diplome</label>
                                <select class="form-control"  id="code_diplome" name="code_diplome" >
                                    @foreach($diplomes as $d)
                                        <option value="{{$d->code_diplome}}" >{{$d->libelle_diplome_fr}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save update</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    {{-- end modal --}}


    {{--  test modal--}}
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form action="/filiere" method="post" id="deleteForm">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <div class="modal-body">

                        <div>
                            <input type="hidden" name="_method" value="DELETE">
                            <p> Êtes-vous sûr ...? vous voulez supprimer cette filière</p>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">yes! delete data</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- end test modal --}}




    <div class="container" >
        @if(count($errors) > 0)
            <?php alert()->error('ErrorAlert',' Data required !!!')->showConfirmButton('Ok', '#fa7268');?>
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Ajouter une Filière
        </button>
        <table id="datatable" class="table table-striped table-responsive" style="font-size: 14px;">
            <thead>
            <tr>
                <th scope="col" style=" width: 90px;">Code Filiere</th>
                <th scope="col" style=" width:350px;">Libelle Filiere</th>
                <th scope="col" data-visible="false">Etablissement</th>
                <th scope="col" style=" width:120px;">Delai d'inscription</th>
                <th scope="col" style=" width:120px;">Abreviation </th>
                <th scope="col" style=" width:120px;">Code ldap</th>
                <th scope="col" style=" width:120px;">numero dossier</th>
                <th scope="col" data-visible="false">Diplome</th>
                <th scope="col">Action</th>

            </tr>
            <tfoot>
            <tr>
                <th scope="col" style=" width: 90px;">Code Filiere</th>
                <th scope="col" style=" width:350px;">Libelle Filiere</th>
                <th scope="col" data-visible="false">Etablissement</th>
                <th scope="col" style=" width:120px;">Delai d'inscription</th>
                <th scope="col" style=" width:120px;">Abreviation </th>
                <th scope="col" style=" width:120px;">Code ldap</th>
                <th scope="col" style=" width:120px;">numero dossier</th>
                <th scope="col" data-visible="false">Diplome</th>
                <th scope="col">Action</th>

            </tr>
            </tfoot>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td style="">{{$item->code_filiere_stat}}</td>
                    <td>{{$item->libelle_filiere}}</td>
                    <td>{{$item->code_etablissement}}</td>
                    <td>{{$item->delai_inscription}}</td>
                    <td>{{$item->abreviation_filiere}}</td>
                    <td>{{$item->code_ldap_filiere}}</td>
                    <td>{{$item->valeur_numero_dossier}}</td>
                    <td >{{$item->code_diplome}}</td>

                    <td>
                        <a href="#" class="tooltip-success edit" data-rel="tooltip" title="Edit">
                            <span class="green">
                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                            </span>
                        </a>

                        <a  href="#" class="tooltip-error delete"  data-rel="tooltip" title="Delete">
                        <span class="red">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                         </span>
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




    <script type="text/javascript">
        $(document).ready(function(){
            var table =$('#datatable').DataTable();
            table.on('click','.edit',function(){
                $tr=$(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr=$tr.prev('.parent');
                }
                var data=table.row($tr).data();
                console.log(data);
                $('#code_filiere_stat').val(data[0]);
                $('#libelle_filiere').val(data[1]);
                $('#code_etablissement').val(data[2]);
                $('#delai_inscription').val(data[3]);
                $('#abreviation_filiere').val(data[4]);
                $('#code_ldap_filiere').val(data[5]);
                $('#valeur_numero_dossier').val(data[6]);
                $('#code_diplome').val(data[7]);
                $('#editForm').attr('action','/filiere/'+data[0]);
                $('#editModal').modal('show');
            });
            // start delete record
            table.on('click','.delete',function(){

                $tr=$(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr=$tr.prev('.parent');
                }

                var data=table.row($tr).data();
                console.log(data);

                $('#deleteForm').attr('action','/filiere/'+data[0]);
                $('#deleteModal').modal('show');
            });
            // end delete record
        });

    </script>

@endsection