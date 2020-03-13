@extends('layout.appdata')

@section('title', '| Users')

@section('content')


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/opi" method="post" id="editForm">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label>CNE</label>
                            <input type="text" class="form-control" id="id_etudiant_opi" name="id_etudiant_opi" placeholder="Enter cne">
                        </div>
                        <div class="form-group">
                            <label>nom et prenom (fr)</label>
                            <input type="text" class="form-control" id="nom_prenom_etud_fr" name="nom_prenom_etud_fr"   placeholder="entrer nom prenom (fr)" >
                        </div>
                        <div class="form-group">
                            <label>nom et prenom (ar)</label>
                            <input type="text" class="form-control" id="nom_prenom_etud_ar" name="nom_prenom_etud_ar"   placeholder="entrer nom prenom (ar)" >
                        </div>
                        <div class="form-group">
                            <label>cin etudiant</label>
                            <input type="text" class="form-control" id="cni_etudiant" name="cni_etudiant"   placeholder="entrer cni etudiant" >
                        </div>
                        <div class="form-group">
                            <label>date nassance</label>
                            <input type="text" class="form-control" id="date_naissance_etud" name="date_naissance_etud"   placeholder="entrer la ate naissance" >
                        </div>
                        <div class="form-group">
                            <label>sexe</label>
                            <input type="text" class="form-control" id="sexe_etudiant" name="sexe_etudiant"   placeholder="entrer le sexe" >
                        </div>
                        <div class="form-group">
                            <label>annee baccalaureat</label>
                            <input type="text" class="form-control" id="annee_baccalaureat" name="annee_baccalaureat"   placeholder="entrer la ate naissance" >
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
    <!-- PAGE CONTENT BEGINS -->
    <section class="content"  >
        <div class="container-fluid">

            <div class="row" >
                <div class="container" >
                    @if(count($errors) > 0)
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
                        Launch demo modal
                    </button>
                <!-- left column -->
                <div class="col-md-9">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="detail-col">@lang('list.detail')</th>
                            <th>@lang('list.cne')</th>
                            <th>Nom prenom en FR</th>
                            <th class="hidden-480">Nom prenom en AR</th>

                            <th>
                                <!--  <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>-->
                                Filiere
                            </th>
                            <!--<th class="hidden-480"></th>-->

                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($etudiants as $etudiant)
                            <tr>
                                <!--<td class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>-->

                                <td class="center">
                                    <div class="action-buttons">
                                        <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                            <span class="sr-only">Details</span>
                                        </a>
                                    </div>
                                </td>

                                <td>{{ $etudiant->id_etudiant_opi }}</td>
                                <td>{{$etudiant->nom_prenom_etud_fr}}</td>
                                <td class="hidden-480">{{$etudiant->nom_prenom_etud_ar}}</td>
                                <td>{{$etudiant->code_filiere}}</td>

                                <!-- <td class="hidden-480">
                            <span class="label label-sm label-warning">{{--$etudiant->validation--}}</span>
                        </td>-->

                                <td>
                                    <form action="{{url('list/'.$etudiant->id_etudiant_opi)}}" method ="post">
                                        <input type="hidden" name="_method" value="PUT">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}

                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a class="btn btn-xs btn-success" href="#" title="validation">
                                                <i class="ace-icon fa fa-check bigger-120"></i>
                                            </a>



                                            <a  href="#" class=" btn btn-success edit" title="Edit">
                                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                            </a>

                                            <button class="btn btn-xs btn-danger active" title="supprimer">
                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                            </button>


                                        </div>
                                    </form>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#" class="tooltip-success edit" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
                                                    </a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="detail-row">
                                <td colspan="8">
                                    <div class="table-detail">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="text-center">

                                                    <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="{{asset('assets/images/avatars/profile-pic.jpg')}}" />

                                                    <br />
                                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                        <div class="inline position-relative">
                                                            <a class="user-title-label" href="#">
                                                                <i class="ace-icon fa fa-circle light-green"></i>
                                                                &nbsp;
                                                                <span class="white">{{$etudiant->nom_prenom_etud_fr}}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-7">
                                                <div class="space visible-xs"></div>

                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> @lang('list.cin') </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->cni_etudiant}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> @lang('list.date_naissance')</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->date_naissance_etud}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Sexe F/M</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->sexe_etudiant}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Année du Baccalaureat</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->annee_baccalaureat}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Code Massar </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->code_massar}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Lieu de naissance d'etudiant en FR</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->lieu_naissance_etud_fr}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name">  Lieu de naissance d'etudiant en AR</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->lieu_naissance_etud_ar}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            </form>
                                        </div>
                                    </div>
                </div>
                </td>
                </tr>







                </tbody>
                @endforeach
                </table>


                {{ $etudiants->links() }}
            </div>
            </div>


                <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>


            <script src="{{asset('js/vue.js')}}"></script>
            <script src="{{asset('js/axios.js')}}"></script>

                <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

                <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
                <script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
                <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
                <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
                <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
                <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
                <script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
                <script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>

                <!-- ace scripts -->
                <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
                <script src="{{asset('assets/js/ace.min.js')}}"></script>

                <!-- inline scripts related to this page -->
                <script>
                    $(document).ready(function(){
                        var table =$('#simple-table').DataTable();
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
                            $('#editForm').attr('action','/opi/'+data[0]);
                            $('#editModal').modal('show');
                        });
                    });
                    jQuery(function($) {
                        //initiate dataTables plugin
                        var myTable =
                                $('#dynamic-table')
                                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                                        .DataTable( {
                                            bAutoWidth: false,
                                            "aoColumns": [
                                                { "bSortable": false },
                                                null, null,null, null, null,
                                                { "bSortable": false }
                                            ],
                                            "aaSorting": [],


                                            //"bProcessing": true,
                                            //"bServerSide": true,
                                            //"sAjaxSource": "http://127.0.0.1/table.php"	,

                                            //,
                                            //"sScrollY": "200px",
                                            //"bPaginate": false,

                                            //"sScrollX": "100%",
                                            //"sScrollXInner": "120%",
                                            //"bScrollCollapse": true,
                                            //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                                            //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                                            //"iDisplayLength": 50


                                            select: {
                                                style: 'multi'
                                            }
                                        } );




                        myTable.buttons().container().appendTo( $('.tableTools-container') );

                        //style the message box
                        var defaultCopyAction = myTable.button(1).action();
                        myTable.button(1).action(function (e, dt, button, config) {
                            defaultCopyAction(e, dt, button, config);
                            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                        });


                        var defaultColvisAction = myTable.button(0).action();
                        myTable.button(0).action(function (e, dt, button, config) {

                            defaultColvisAction(e, dt, button, config);


                            if($('.dt-button-collection > .dropdown-menu').length == 0) {
                                $('.dt-button-collection')
                                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                                        .find('a').attr('href', '#').wrap("<li />")
                            }
                            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
                        });

                        ////

                        setTimeout(function() {
                            $($('.tableTools-container')).find('a.dt-button').each(function() {
                                var div = $(this).find(' > div').first();
                                if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                                else $(this).tooltip({container: 'body', title: $(this).text()});
                            });
                        }, 500);





                        myTable.on( 'select', function ( e, dt, type, index ) {
                            if ( type === 'row' ) {
                                $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                            }
                        } );
                        myTable.on( 'deselect', function ( e, dt, type, index ) {
                            if ( type === 'row' ) {
                                $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                            }
                        } );




                        /////////////////////////////////
                        //table checkboxes
                        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

                        //select/deselect all rows according to table header checkbox
                        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                            var th_checked = this.checked;//checkbox inside "TH" table header

                            $('#dynamic-table').find('tbody > tr').each(function(){
                                var row = this;
                                if(th_checked) myTable.row(row).select();
                                else  myTable.row(row).deselect();
                            });
                        });

                        //select/deselect a row when the checkbox is checked/unchecked
                        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                            var row = $(this).closest('tr').get(0);
                            if(this.checked) myTable.row(row).deselect();
                            else myTable.row(row).select();
                        });



                        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                            e.stopImmediatePropagation();
                            e.stopPropagation();
                            e.preventDefault();
                        });



                        //And for the first simple table, which doesn't have TableTools or dataTables
                        //select/deselect all rows according to table header checkbox
                        var active_class = 'active';
                        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                            var th_checked = this.checked;//checkbox inside "TH" table header

                            $(this).closest('table').find('tbody > tr').each(function(){
                                var row = this;
                                if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                                else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                            });
                        });

                        //select/deselect a row when the checkbox is checked/unchecked
                        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                            var $row = $(this).closest('tr');
                            if($row.is('.detail-row ')) return;
                            if(this.checked) $row.addClass(active_class);
                            else $row.removeClass(active_class);
                        });



                        /********************************/
                        //add tooltip for small view action buttons in dropdown menu
                        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

                        //tooltip placement on right or left
                        function tooltip_placement(context, source) {
                            var $source = $(source);
                            var $parent = $source.closest('table')
                            var off1 = $parent.offset();
                            var w1 = $parent.width();

                            var off2 = $source.offset();
                            //var w2 = $source.width();

                            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                            return 'left';
                        }




                        /***************/
                        $('.show-details-btn').on('click', function(e) {
                            e.preventDefault();
                            $(this).closest('tr').next().toggleClass('open');
                            $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                        });
                        /***************/





                        /**
                         //add horizontal scrollbars to a simple table
                         $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
                         {
                           horizontal: true,
                           styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                           size: 2000,
                           mouseWheelLock: true
                         }
                         ).css('padding-top', '12px');
                         */


                    })
                </script>

@endsection