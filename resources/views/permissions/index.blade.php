{{-- \resources\views\permissions\index.blade.php --}}
@extends('layout.appdata')

@section('title', '| Permissions')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">confirmation de la suppression</h4>
                </div>
                <form action="/permissions" method="post" id="deleteForm">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <div class="modal-body">

                        <div>
                            <input type="hidden" name="_method" value="DELETE">
                            <p> Êtes-vous sûr ...? vous voulez supprimer cette permission</p>
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

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i>Autorisations disponibles

            <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
        <hr>

            <table id="datatable" class="table table-striped table-responsive">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
                </tfoot>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                          <!--  <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editer</a>-->
                            <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}"  class="tooltip-success" style="margin-right: 3px;" title="Edit">
                             <span class="green">
                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                              </span>
                            </a>
                            <a  href="#" class="tooltip-error delete"  data-rel="tooltip" title="Delete">
                                <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                 </span>
                            </a>
                          {{--  {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            --}}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Ajouter Permission</a>

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

                $('#deleteForm').attr('action','/permissions/'+data[0]);
                $('#deleteModal').modal('show');
            });
            // end delete record
        });

    </script>


@endsection