{{-- \resources\views\roles\index.blade.php --}}
@extends('layout.appdata')

@section('title', '| Roles')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form action="/roles" method="post" id="deleteForm">
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

    <div class="col-lg-12 ">
        <h1><i class="fa fa-key"></i> Roles

            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
        <hr>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th data-visible="false">ID</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                <tfoot>
                <tr>
                    <th data-visible="false">ID</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>
                </tfoot>
                </thead>

                <tbody>
                @foreach ($roles as $role)
                    <tr>

                        <td>{{ $role->id}}</td>
                        <td>{{ $role->name }}</td>

                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
                           <!-- <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editer</a>-->

                            <a href="{{ URL::to('roles/'.$role->id.'/edit') }}"  class="tooltip-success" style="margin-right: 3px;" title="Edit">
                             <span class="green">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                              </span>
                            </a>
                            <a  href="#" class="tooltip-error delete"  data-rel="tooltip" title="Delete">
                                <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                 </span>
                            </a>
                           {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            --}}

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <a href="{{ route('roles.create') }}" class="btn btn-success">Ajouter Role</a>

    </div>


    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function(){
            var table =$('#datatable').DataTable();

            // start delete record
            table.on('click','.delete',function(){

                $tr=$(this).closest('tr');
                if($($tr).hasClass('child')){
                    $tr=$tr.prev('.parent');
                }

                var data=table.row($tr).data();
                console.log(data);

                $('#deleteForm').attr('action','/roles/'+data[0]);
                $('#deleteModal').modal('show');
            });
            // end delete record
        });

    </script>


@endsection