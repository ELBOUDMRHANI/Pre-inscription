@extends('layout.appdata')

@section('title', '| Users')

@section('content')

<!-- Add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier table Opi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{action('OpiController@store')}}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <label>cne etudiant</label>
                            <input type="text" class="form-control" name="id_etudiant_opi" placeholder="Enter cne">
                        </div>
                        <div class="col-md-6">
                            <label>nom et prenom (fr)</label>
                            <input type="text" class="form-control" name="nom_prenom_etud_fr"   placeholder="entrer nom prenom (fr)" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>nom et prenom (ar)</label>
                            <input type="text" class="form-control" name="nom_prenom_etud_ar"   placeholder="entrer nom prenom (ar)" >
                        </div>
                        <div class="col-md-6">
                            <label>cin etudiant</label>
                            <input type="text" class="form-control"  name="cni_etudiant"   placeholder="entrer cni etudiant" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>date nassance</label>
                            <input type="text" class="form-control" name="date_naissance_etud"   placeholder="entrer la date naissance" >
                        </div>
                        <div class="col-md-6">
                            <label>Sexe</label>
                            <select  class="form-control" name="sexe_etudiant" >
                                <option value="F" >Féminin</option>
                                <option value="M" >Masculin</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>annee baccalaureat</label>
                            <input type="text" class="form-control"  name="annee_baccalaureat"   placeholder="entrer annee baccalaureat" >
                        </div>
                        <div class="col-md-6">
                            <label>moyenne baccalaureat</label>
                            <input type="text" class="form-control"  name="moyene_baccalaureat"   placeholder="entrer moyenne baccalaureat" >
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>province</label>
                            <select  class="form-control" name="province" >

                                @foreach($provinces as $p)
                                    <option value="{{$p->code_province_opi}}" >{{$p->libelle_province_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>code_academie</label>
                            <select  class="form-control"  name="code_academie" >
                                @foreach($academies as $a)
                                    <option value="{{$a->code_academie}}" >{{$a->libelle_academie_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>code serie baccalaureat</label>
                            <select class="form-control"  name="code_serie_baccalaureat" >
                                @foreach($serie as $s)
                                    <option value="{{$s->code_serie_baccalaureat_opi}}" >{{$s->libelle_baccalaureat_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>code massar</label>
                            <input type="text" class="form-control" name="code_massar"   placeholder="entrer le code massaar" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>lieu naissance en fr</label>
                            <input type="text" class="form-control" name="lieu_naissance_etud_fr"   placeholder="entrer le liue de naiss (fr)" >
                        </div>
                        <div class="col-md-6">
                            <label>lieu naissance en ar</label>
                            <input type="text" class="form-control" name="lieu_naissance_etud_ar"   placeholder="entrer le liue de naiss (ar)" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>prenom en fr</label>
                            <input type="text" class="form-control"  name="prenom_etud_fr"   placeholder="entrer le prenom en français" >
                        </div>
                        <div class="col-md-6">
                            <label>nom en fr</label>
                            <input type="text" class="form-control" name="nom_etud_fr"   placeholder="entrer le nom en français ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>prenom en ar</label>
                            <input type="text" class="form-control" name="prenom_etud_ar"   placeholder="entrer le prenom en arabe" >
                        </div>
                        <div class="col-md-6">
                            <label>nom en ar</label>
                            <input type="text" class="form-control" name="nom_etud_ar"   placeholder="entrer le nom en arabe" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Filiere</label>
                            <select class="form-control"  name="code_filiere" >
                                @foreach($filieres as $f)
                                    <option value="{{$f->code_filiere_stat}}" >{{$f->libelle_filiere}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>année import</label>
                            <input type="text" class="form-control" name="annee_import"   placeholder="entrer l'année d'import" >
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
                <h5 class="modal-title" id="exampleModalLabel">Modifier table Opi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/opi" method="post" id="editForm">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                     <div class="row">
                    <div class="col-md-6">
                        <label>cne etudiant</label>
                        <input type="text" class="form-control" id="id_etudiant_opi" name="id_etudiant_opi" placeholder="Enter cne">
                    </div>
                    <div class="col-md-6">
                        <label>nom et prenom (fr)</label>
                        <input type="text" class="form-control" id="nom_prenom_etud_fr" name="nom_prenom_etud_fr"   placeholder="entrer nom prenom (fr)" >
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label>nom et prenom (ar)</label>
                        <input type="text" class="form-control" id="nom_prenom_etud_ar" name="nom_prenom_etud_ar"   placeholder="entrer nom prenom (ar)" >
                    </div>
                    <div class="col-md-6">
                        <label>cin etudiant</label>
                        <input type="text" class="form-control" id="cni_etudiant" name="cni_etudiant"   placeholder="entrer cni etudiant" >
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <label>date nassance</label>
                        <input type="text" class="form-control" id="date_naissance_etud" name="date_naissance_etud"   placeholder="entrer la date naissance" >
                        </div>
                      <div class="col-md-6">
                            <label>Sexe</label>
                            <select  class="form-control" id="sexe_etudiant" name="sexe_etudiant" >
                                    <option value="F" >Féminin</option>
                                    <option value="M" >Masculin</option>

                            </select>
                        </div>
                     </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label>annee baccalaureat</label>
                        <input type="text" class="form-control" id="annee_baccalaureat" name="annee_baccalaureat"   placeholder="entrer annee baccalaureat" >
                    </div>
                        <div class="col-md-6">
                            <label>moyenne baccalaureat</label>
                            <input type="text" class="form-control" id="moyene_baccalaureat" name="moyene_baccalaureat"   placeholder="entrer moyenne baccalaureat" >
                        </div>
                        </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>province</label>
                            <select  class="form-control" id="province" name="province" >

                                @foreach($provinces as $p)
                                    <option value="{{$p->code_province_opi}}" >{{$p->libelle_province_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>code_academie</label>
                            <select  class="form-control" id="code_academie" name="code_academie" >
                                <option  disabled selected value>@lang('list.lab_choix_dip')</option>
                                @foreach($academies as $a)
                                    <option value="{{$a->code_academie}}" >{{$a->libelle_academie_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>code serie baccalaureat</label>
                            <select class="form-control" id="code_serie_baccalaureat" name="code_serie_baccalaureat" >
                                <option  disabled selected value>@lang('list.lab_choix_dip')</option>
                                @foreach($serie as $s)
                                    <option value="{{$s->code_serie_baccalaureat_opi}}" >{{$s->libelle_baccalaureat_fr}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>code massar</label>
                            <input type="text" class="form-control" id="code_massar" name="code_massar"   placeholder="entrer le code massaar" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>lieu naissance en fr</label>
                            <input type="text" class="form-control" id="lieu_naissance_etud_fr" name="lieu_naissance_etud_fr"   placeholder="entrer le liue de naiss (fr)" >
                        </div>
                        <div class="col-md-6">
                            <label>lieu naissance en ar</label>
                            <input type="text" class="form-control" id="lieu_naissance_etud_ar" name="lieu_naissance_etud_ar"   placeholder="entrer le liue de naiss (ar)" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>prenom en fr</label>
                            <input type="text" class="form-control" id="prenom_etud_fr" name="prenom_etud_fr"   placeholder="entrer le prenom en français" >
                        </div>
                        <div class="col-md-6">
                            <label>nom en fr</label>
                            <input type="text" class="form-control" id="nom_etud_fr" name="nom_etud_fr"   placeholder="entrer le nom en français ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>prenom en ar</label>
                            <input type="text" class="form-control" id="prenom_etud_ar" name="prenom_etud_ar"   placeholder="entrer le prenom en arabe" >
                        </div>
                        <div class="col-md-6">
                            <label>nom en ar</label>
                            <input type="text" class="form-control" id="nom_etud_ar" name="nom_etud_ar"   placeholder="entrer le nom en arabe" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Filiere</label>
                            <select class="form-control" id="code_filiere" name="code_filiere" >
                                <option  disabled selected value>@lang('list.lab_choix_dip')</option>
                                @foreach($filieres as $f)
                                    <option value="{{$f->code_filiere_stat}}" >{{$f->libelle_filiere}}</option>

                                    <!-- <option value="2" selected="selected">2</option>-->
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>année import</label>
                            <input type="text" class="form-control" id="annee_import" name="annee_import"   placeholder="entrer l'année d'import" >
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
            <form action="/opi" method="post" id="deleteForm">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <div class="modal-body">

                    <div>
                        <input type="hidden" name="_method" value="DELETE">
                        <p> Are you sure ...? you want to delete dara</p>
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
            Ajouter à l'OPI
        </button>
    <table id="datatable" class="table table-striped table-dark" style="font-size: 13px;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nom en fr</th>
            <th scope="col">nom en ar</th>
            <th scope="col">CIN</th>
            <th scope="col">date naissance</th>
            <th scope="col">sexe</th>
            <th scope="col">annee bac</th>
            <th scope="col" data-visible="false">moy bac</th>
            <th scope="col" data-visible="false">prov bac</th>
            <th scope="col" data-visible="false">code acad </th>
            <th scope="col" data-visible="false">code serie bac </th>
            <th scope="col" data-visible="false">code massar</th>
            <th scope="col" data-visible="false">lieu naiss fr</th>
            <th scope="col" data-visible="false">lieu naiss ar</th>
            <th scope="col" data-visible="false">prenom fr</th>
            <th scope="col" data-visible="false">nom fr </th>
            <th scope="col" data-visible="false">prenom ar</th>
            <th scope="col" data-visible="false">nom ar</th>
            <th scope="col" data-visible="false">code fil</th>
            <th scope="col" data-visible="false">annee imp</th>
            <th scope="col">Action</th>

        </tr>
        <tfoot>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nom en fr</th>
            <th scope="col">nom en ar</th>
            <th scope="col">CIN</th>
            <th scope="col">date naissance</th>
            <th scope="col">sexe</th>
            <th scope="col">annee bac</th>
            <th scope="col" data-visible="false">moy bac</th>
            <th scope="col" data-visible="false">prov bac</th>
            <th scope="col" data-visible="false">code acad </th>
            <th scope="col" data-visible="false">code serie bac </th>
            <th scope="col" data-visible="false">code massar</th>
            <th scope="col" data-visible="false">lieu naiss fr</th>
            <th scope="col" data-visible="false">lieu naiss ar</th>
            <th scope="col" data-visible="false">prenom fr</th>
            <th scope="col" data-visible="false">nom fr </th>
            <th scope="col" data-visible="false">prenom ar</th>
            <th scope="col" data-visible="false">nom ar</th>
            <th scope="col" data-visible="false">code fil</th>
            <th scope="col" data-visible="false">annee imp</th>
            <th scope="col">Action</th>

        </tr>
        </tfoot>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td style="width: 30px ;font-size: 12px;">{{$item->id_etudiant_opi}}</td>
                <td>{{$item->nom_prenom_etud_fr}}</td>
                <td>{{$item->nom_prenom_etud_ar}}</td>
                <td>{{$item->cni_etudiant}}</td>
                <td>{{$item->date_naissance_etud}}</td>
                <td>{{$item->sexe_etudiant}}</td>
                <td>{{$item->annee_baccalaureat}}</td>
                <td >{{$item->moyene_baccalaureat}}</td>
                <td >{{$item->province}}</td>
                <td >{{$item->code_academie}}</td>
                <td >{{$item->code_serie_baccalaureat}}</td>
                <td >{{$item->code_massar}}</td>
                <td >{{$item->lieu_naissance_etud_fr}}</td>
                <td >{{$item->lieu_naissance_etud_ar}}</td>
                <td >{{$item->prenom_etud_fr}}</td>
                <td >{{$item->nom_etud_fr}}</td>
                <td >{{$item->prenom_etud_ar}}</td>
                <td >{{$item->nom_etud_ar}}</td>
                <td >{{$item->code_filiere}}</td>
                <td >{{$item->annee_import}}</td>
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
            $('#id_etudiant_opi').val(data[0]);
            $('#nom_prenom_etud_fr').val(data[1]);
            $('#nom_prenom_etud_ar').val(data[2]);
            $('#cni_etudiant').val(data[3]);
            $('#date_naissance_etud').val(data[4]);
            $('#sexe_etudiant').val(data[5]);
            $('#annee_baccalaureat').val(data[6]);
            $('#moyene_baccalaureat').val(data[7]);
            $('#province').val(data[8]);
            $('#code_academie').val(data[9]);
            $('#code_serie_baccalaureat').val(data[10]);
            $('#code_massar').val(data[11]);
            $('#lieu_naissance_etud_fr').val(data[12]);
            $('#lieu_naissance_etud_ar').val(data[13]);
            $('#prenom_etud_fr').val(data[14]);
            $('#nom_etud_fr').val(data[15]);
            $('#nom_etud_ar').val(data[16]);
            $('#prenom_etud_ar').val(data[17]);
            $('#code_filiere').val(data[18]);
            $('#annee_import').val(data[19]);
            $('#editForm').attr('action','/opi/'+data[0]);
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

            $('#deleteForm').attr('action','/opi/'+data[0]);
            $('#deleteModal').modal('show');
        });
        // end delete record
    });

</script>

    @endsection