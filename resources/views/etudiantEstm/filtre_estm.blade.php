@extends('layout.appdata')

@section('title', '| Users')

@section('content')
    <?php
    function validation($bool){
        // $bool=$etudiant->validation;
        $res='';
        if($bool==0){
            $res='disabled';
        }
        if($bool==1){
            $res='active';
        }
        return $res;
    }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form action="" method ="post" id="deleteForm" >
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <div class="modal-body">

                        <div>
                            <input type="hidden" name="_method" value="DELETE">
                            <p> Are you sure ...? you want to delete data <span id="usr"></span></p>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">yes! delete data</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- PAGE CONTENT BEGINS -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                        <tr>
                            <!-- <th class="center">
                                 <label class="pos-rel">
                                     <input type="checkbox" class="ace" />
                                     <span class="lbl"></span>
                                 </label>
                             </th>-->
                            <th class="detail-col">Details</th>
                            <th>cne</th>
                            <th>code massar</th>
                            <th class="hidden-480">nom</th>

                            <th>
                                <!--  <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>-->
                                prenom
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

                                <td>{{ $etudiant->id_etudiant }}</td>
                                <td>{{$etudiant->code_massar}}</td>
                                <td class="hidden-480">{{$etudiant->nom_etudiant_fr}}</td>
                                <td>{{$etudiant->prenom_etudiant_fr}}</td>

                                <!-- <td class="hidden-480">
                            <span class="label label-sm label-warning">{{--$etudiant->validation--}}</span>
                        </td>-->

                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">


                                            <div class="hidden-sm hidden-xs btn-group">
                                                <a class="btn btn-xs btn-success" href="{{url('valider/'.$etudiant->id_etudiant)}}" title="validation">
                                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                                </a>

                                                <a class="btn btn-xs btn-info <?php echo validation($etudiant->validation)?>" href="{{url('profil_cne/'.$etudiant->id_etudiant)}}" title="voir l'etudiant">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </a>

                                                @can('Delete')
                                                <button  id="{{$etudiant->id_etudiant}}" data-toggle="modal" data-target="#deleteModal" class="btn btn-xs btn-danger <?php echo validation($etudiant->validation)?> delete" title="supprimer">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>
                                                @endcan

                                                <a class="btn btn-xs btn-warning <?php echo validation($etudiant->validation)?>" href="{{ url('/'.$etudiant->id_etudiant.'/dowcarte') }}" title="carte etudiant">
                                                    <i class="fa fa-file-pdf-o bigger-120"></i>
                                                </a>
                                                <!-- <a class="btn btn-xs btn-warning disabled" href="{{ url('/'.$etudiant->id_etudiant.'/viewcarte') }}">
                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                </a>-->
                                                <a class="btn btn-xs btn-warning <?php echo validation($etudiant->validation)?>" href="{{ url('/'.$etudiant->id_etudiant.'/recu') }}" title="recu inscription">
                                                    <i class="fa fa-file-text bigger-120"></i>
                                                </a>

                                                <a class="btn btn-xs btn-danger" href="{{url('retrait/'.$etudiant->id_etudiant)}}" title="retrait">
                                                    <i class="fa fa-ban bigger-120"></i>
                                                </a>

                                            </div>


                                    </div>

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
                                                    <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
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
                                            <div class="col-xs-12 col-sm-2">
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
                                                        <div class="profile-info-name">@lang('list.adresseperso')</div>

                                                        <div class="profile-info-value">
                                                            <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                            <span>{{$etudiant->adresse_personnelle_etud}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> @lang('list.ville')</div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->ville_naissance_etud}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> @lang('list.gsm') </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->tel_mobile_etudiant}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> @lang('list.email') </div>

                                                        <div class="profile-info-value">
                                                            <span>{{$etudiant->email_etudiant}}</span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <!--<div class="col-xs-12 col-sm-3">
                                                <div class="space visible-xs"></div>
                                                <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                <div class="space-6"></div>

                                                <form>
                                                    <fieldset>
                                                        <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                    </fieldset>

                                                    <div class="hr hr-dotted"></div>

                                                    <div class="clearfix">
                                                        <label class="pull-left">
                                                            <input type="checkbox" class="ace" />
                                                            <span class="lbl"> Email me a copy</span>
                                                        </label>

                                                        <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                            Submit
                                                            <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                        </button>
                                                    </div>-->
                                            </form>
                                        </div>
                                    </div>
                </div>
                </td>
                </tr>







                </tbody>
                @endforeach
                </table>
                {{ $etudiants->appends(request()->except('page'))->links() }}
            </div>

            <div class="col-md-3">
                <!--<div class="col-xs-12 col-sm-4">-->
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">@lang('list.titre_filtre')</h4>

													<span class="widget-toolbar">
														<a href="#" data-action="settings">
                                                            <i class="ace-icon fa fa-cog"></i>
                                                        </a>

														<a href="#" data-action="reload">
                                                            <i class="ace-icon fa fa-refresh"></i>
                                                        </a>

														<a href="#" data-action="collapse">
                                                            <i class="ace-icon fa fa-chevron-up"></i>
                                                        </a>

														<a href="#" data-action="close">
                                                            <i class="ace-icon fa fa-times"></i>
                                                        </a>
													</span>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <form class="form-horizontal" action="{{url('filtredip_estm')}}" method="get" style="width: 200px;margin-left: 20px;">
                                {{csrf_field()}}
                                <div>
                                    <label for="form-field-select-1"><b>@lang('list.filtre1')</b></label>
                                    <select class="chosen-select form-control" name="filiere_estm" id="form-field-select-3" style="margin-bottom: 10px;" data-placeholder="Choose a State...">
                                        <option  disabled selected value>@lang('list.lab_choix_fil')</option>
                                        @foreach($filieres as $filiere)
                                            <option value="{{$filiere->libelle_filiere}}" >{{$filiere->libelle_filiere}}</option>

                                            <!-- <option value="2" selected="selected">2</option>-->
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select class="form-control" name="diplome_estm" id="form-field-select-1" style="margin-bottom: 10px;">
                                        <option  disabled selected value>@lang('list.lab_choix_dip')</option>
                                        @foreach($diplomes as $diplome)
                                            <option value="{{$diplome->libelle_diplome_fr }}" >{{$diplome->libelle_diplome_fr }}</option>

                                            <!-- <option value="2" selected="selected">2</option>-->
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-info" type="submit" >
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Suivant
                                </button>
                            </form>
                            <hr />
                            <form class="form-horizontal" action="{{url('filtre_estm')}}" method="get" style="width: 200px;margin-left: 20px;">
                                {{csrf_field()}}
                                <div>
                                    <label for="form-field-select-2"><b>@lang('list.filtre2')</b></label>
                                    <!-- <label>@lang('list.choix_dip')</label>
                                    <select class="form-control" name="diplome_sl" id="form-field-select-1" style="margin-bottom: 10px;">
                                        <option  disabled selected value>@lang('list.lab_choix_dip')</option>

                                            <option value="{{--$diplome->libelle_diplome_fr--}}" >{{--$diplome->libelle_diplome_fr--}}</option>

                                            <!-- <option value="2" selected="selected">2</option>-->

                                    <!-- </select>-->
                                    <div>
                                        <label for="form-field-select-3">@lang('list.choix_fil')</label>
                                        <br />
                                        <select class="chosen-select form-control" name="filiere_estm" id="form-field-select-3" style="margin-bottom: 10px;" data-placeholder="Choose a State...">
                                            <option  disabled selected value>@lang('list.lab_choix_fil')</option>
                                            @foreach($filieres as $filiere)
                                                <option value="{{$filiere->libelle_filiere}}" >{{$filiere->libelle_filiere}}</option>

                                                <!-- <option value="2" selected="selected">2</option>-->
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                                <button class="btn btn-info" type="submit" style="margin-bottom: 10px;">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Filtrer
                                </button>
                            </form>

                            <form class="form-horizontal" action="{{url('filtre_estm')}}" method="get" style="width: 200px;margin-left: 20px;">
                                {{csrf_field()}}

                                <div>
                                    <label>@lang('list.choix_cin')</label>
                                    <input style="margin-bottom: 10px;" type="text" name="cin" class="form-control float-right" placeholder="@lang('list.choix_cin')">
                                </div>
                                <div>
                                    <div>
                                        <label>@lang('list.choix_valide')</label>
                                        <select class="chosen-select form-control" name="valide" id="form-field-select-3" style="margin-bottom: 10px;"data-placeholder="Choose a State..." >
                                            <option  disabled selected value>@lang('list.choix_valide')</option>
                                            <option value="1">Valide </option>
                                            <option value="7" >non valide</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Filtrer
                                </button>
                            </form>
                        </div><!-- /.span -->
                    </div><!-- /.row -->
                </div>


                <!-- inline scripts related to this page -->
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#deleteModal').on('show.bs.modal', function(e) {

                            //document.getElementById("usr").innerText=e.relatedTarget.id;
                            document.getElementById("deleteForm").action="list/"+e.relatedTarget.id;
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