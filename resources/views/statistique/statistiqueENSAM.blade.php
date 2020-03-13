@extends('layout.app')

@section('title', '| Roles')

@section('content')


    <div class="row">
        <div class="col-sm-5">
            <div style="position: relative;top:250px;left:20px;">
                <?php $total_insc=$val_ensam+$nn_val_ensam;?>
                <div class="infobox infobox-red infobox-small infobox-dark" style="width: 150px">
                    <div class="infobox-chart">
                        <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content" style="width: 100px">Non Valide
                            <div style="font-size: 18px;font-weight: bold;margin-left: 10px;">{{$nn_val_ensam}}</div></div>
                    </div>
                </div>

                <div class="infobox infobox-green infobox-small infobox-dark" style="width: 150px">
                    <div class="infobox-chart">
                        <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content">Etat Valide</div>
                        <div class="infobox-content" style="font-size: 18px;font-weight: bold">{{$val_ensam}}</div>
                    </div>
                </div>
                <div class="infobox infobox-blue infobox-small infobox-dark" style="width: 150px">
                    <div class="infobox-chart">
                        <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
                    </div>

                    <div class="infobox-data">
                        <div class="infobox-content">Totale</div>
                        <div class="infobox-content" style="font-size: 18px;font-weight: bold">{{$total_insc}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7" >
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Traffic Sources
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                This Week
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <h4 style="margin-left: 10px ;" class="bigger pull-left">totale inscriptions sur les filieres</h4>
                <div class="widget-body" style="padding-top: 20px">
                    <div class="widget-main" >
                        <div id="piechart-placeholder"></div>

                        <div class="hr hr8 hr-double" ></div>

                        <div class="clearfix" style="margin-top: 20px;">
                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-check fa-2x green"></i>
																&nbsp; max valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('max_fil_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-times fa-2x red"></i>
																&nbsp; min valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('min_fil_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-calculator fa-2x blue"></i>
																&nbsp; Moyenne
															</span>

                                <h4 class="bigger pull-right">{{ Session::get('moy_fil_ensam')}}</h4>
                            </div>
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Traffic Sources
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                This Week
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <h4 style="margin-left: 10px ;" class="bigger pull-left">totale inscriptions sur les academies</h4>
                <div class="widget-body" style="padding-top: 20px">
                    <div class="widget-main" >
                        <div id="piechart-placeholder_acad" ></div>

                        <div class="hr hr8 hr-double" style="margin-top: 35px;margin-left: 20px"></div>

                        <div class="clearfix" style="margin-top: 20px;">
                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-check fa-2x green"></i>
																&nbsp; max valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('max_aca_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-times fa-2x red"></i>
																&nbsp; min Valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('min_aca_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-calculator fa-2x blue"></i>
																&nbsp; Moyenne
															</span>

                                <h4 class="bigger pull-right">{{ Session::get('moy_aca_ensam')}}</h4>
                            </div>
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="widget-box">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        Traffic Sources
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                This Week
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <h4 style="margin-left: 10px ;" class="bigger pull-left">totale inscriptions sur les provinces</h4>
                <div class="widget-body" style="padding-top: 20px">
                    <div class="widget-main" >
                        <div id="piechart-placeholder_prov" ></div>

                        <div class="hr hr8 hr-double" ></div>

                        <div class="clearfix" style="margin-top: 20px;">
                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-check fa-2x green"></i>
																&nbsp; max valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('max_pro_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-times fa-2x red"></i>
																&nbsp; non Valide
															</span>
                                <h4 class="bigger pull-right">{{ Session::get('min_pro_ensam')}}</h4>
                            </div>

                            <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-calculator fa-2x blue"></i>
																&nbsp; Moyenne
															</span>

                                <h4 class="bigger pull-right">{{ Session::get('moy_pro_ensam')}}</h4>
                            </div>
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->

        </div>
        <div class="col-sm-6"> </div>
    </div>

    <div class="row">


    </div>
    <div class="col-sm-7">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Traffic Sources
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            This Week
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li class="active">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                    This Week
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Last Week
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    This Month
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Last Month
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4 style="margin-left: 10px ;" class="bigger pull-left">totale inscriptions sur les filieres du bac</h4>
            <div class="widget-body" style="padding-top: 20px">
                <div class="widget-main" >
                    <div id="piechart-placeholder_bac" ></div>

                    <div class="hr hr8 hr-double" ></div>

                    <div class="clearfix" style="margin-top: 20px;">
                        <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-check fa-2x green"></i>
																&nbsp;max valide
															</span>
                            <h4 class="bigger pull-right">{{ Session::get('max_bac_ensam')}}</h4>
                        </div>

                        <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-times fa-2x red"></i>
																&nbsp; min valide
															</span>
                            <h4 class="bigger pull-right">{{ Session::get('min_bac_ensam')}}</h4>
                        </div>

                        <div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-calculator fa-2x blue"></i>
																&nbsp; Moyenne
															</span>

                            <h4 class="bigger pull-right">{{ Session::get('moy_bac_ensam')}}</h4>
                        </div>
                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->

    </div>
    </div>
    <div class="row">

        <div class="col-sm-5"> </div>
    </div>

    <!--<input type="text" id="valide" value="{{-- $t->name--}}"/>-->




    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


    <!-- <![endif]-->

    <!--[if IE]>
    <script src="{{asset('assets/js/jquery-1.11.3.min.js')}}'"></script>
    <![endif]-->

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{asset("assets/js/jquery.mobile.custom.min.js")}}'>"+"<"+"/script>");
    </script>


    <script src="{{asset('assets/js/jquery.sparkline.index.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/spinbox.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/daterangepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.knob.min.js')}}"></script>
    <script src="{{asset('assets/js/autosize.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.inputlimiter.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.maskedinput.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-tag.min.js')}}"></script>

    <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('assets/js/ace.min.js')}}"></script>
    <script src="{{asset('assets/js/ace-extra.min.js')}}"></script>


    <script type="text/javascript">

        jQuery(function($) {
            $('.easy-pie-chart.percentage').each(function () {
                var $box = $(this).closest('.infobox');
                var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                var size = parseInt($(this).data('size')) || 50;
                $(this).easyPieChart({
                    barColor: barColor,
                    trackColor: trackColor,
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: parseInt(size / 10),
                    animate: ace.vars['old_ie'] ? false : 1000,
                    size: size
                });
            })

            $('.sparkline').each(function () {
                var $box = $(this).closest('.infobox');
                var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                $(this).sparkline('html',
                        {
                            tagValuesAttribute: 'data-values',
                            type: 'bar',
                            barColor: barColor,
                            chartRangeMin: $(this).data('min') || 0
                        });
            });


            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
            //but sometimes it brings up errors with normal resize event handlers
            $.resize.throttleWindow = false;

            var placeholder = $('#piechart-placeholder').css({'width': '95%','min-height':'220px','height':'100%'});
            //   var va = document.getElementById("valide").value;
            //   var no_va = document.getElementById("non_valide").value;
            //var dt = document.getElementById("data").value;
            // var tot= document.getElementById("t").value;
            // var data=[];
            //  for (var i = 0; i < 8; i++) {

            var data=[
                @foreach($Data_ensam as $d)
                {
                    label: "".concat(<?php echo json_encode($d->name);?>),
                    data:<?php echo json_encode($d->value);?> },
                @endforeach
       /*for (var i = 1; i < 8; i++) {
                 {
                 document.getElementById("dt_f".concat(i).value),
                 document.getElementById("dt_n".concat(i)).value}
                 // }*/


            ]
            //}

            //for (var i = 0; i < tot; i++) {
            //   var dt = document.getElementById("dt".concat(i)).value;
            /* var data= [
             // items.forEach(function(dat){
             {label: "les étudiants de", data: 8},
             {label: "les étudiants de", data: 4},
             //   });
             ]*/


            // }
            function drawPieChart(placeholder, data, position) {
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt:0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin:[-30,15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }

                })
            }
            drawPieChart(placeholder, data);

            /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
            placeholder.data('chart', data);
            placeholder.data('draw', drawPieChart);


            //pie chart tooltip example
            var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
            var previousPoint = null;

            placeholder.on('plothover', function (event, pos, item) {
                if(item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent']+'%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

            });
            ////////////////
            $(document).one('ajaxloadstart.page', function(e) {
                $tooltip.remove();
            });




            var d1 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d1.push([i, Math.sin(i)]);
            }

            var d2 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.5) {
                d2.push([i, Math.cos(i)]);
            }

            var d3 = [];
            for (var i = 0; i < Math.PI * 2; i += 0.2) {
                d3.push([i, Math.tan(i)]);
            }


            var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
            $.plot("#sales-charts", [
                { label: "Domains", data: d1 },
                { label: "Hosting", data: d2 },
                { label: "Services", data: d3 }
            ], {
                hoverable: true,
                shadowSize: 0,
                series: {
                    lines: { show: true },
                    points: { show: true }
                },
                xaxis: {
                    tickLength: 0
                },
                yaxis: {
                    ticks: 10,
                    min: -2,
                    max: 2,
                    tickDecimals: 3
                },
                grid: {
                    backgroundColor: { colors: [ "#fff", "#fff" ] },
                    borderWidth: 1,
                    borderColor:'#555'
                }
            });


            $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('.tab-content')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                return 'left';
            }


            $('.dialogs,.comments').ace_scroll({
                size: 300
            });


            //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
            //so disable dragging when clicking on label
            var agent = navigator.userAgent.toLowerCase();
            if(ace.vars['touch'] && ace.vars['android']) {
                $('#tasks').on('touchstart', function(e){
                    var li = $(e.target).closest('#tasks li');
                    if(li.length == 0)return;
                    var label = li.find('label.inline').get(0);
                    if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
                });
            }

            $('#tasks').sortable({
                        opacity:0.8,
                        revert:true,
                        forceHelperSize:true,
                        placeholder: 'draggable-placeholder',
                        forcePlaceholderSize:true,
                        tolerance:'pointer',
                        stop: function( event, ui ) {
                            //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                            $(ui.item).css('z-index', 'auto');
                        }
                    }
            );
            $('#tasks').disableSelection();
            $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
                if(this.checked) $(this).closest('li').addClass('selected');
                else $(this).closest('li').removeClass('selected');
            });


            //show the dropdowns on top or bottom depending on window height and menu position
            $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
                var offset = $(this).offset();

                var $w = $(window)
                if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                    $(this).addClass('dropup');
                else $(this).removeClass('dropup');
            });

        })
        var placeholder2 = $('#piechart-placeholder_prov').css({'width':'95%' , 'min-height':'200px'});
        //    var vaa = document.getElementById("valide_prov").value;
        //   var no_vaa = document.getElementById("non_valide_prov").value;
        var dataa = [
            @foreach($Data_pro_ensam as $dp)
            {
                /*label: "Province : ".concat(<?php //echo json_encode($dp->name);?>),*/
                data:<?php echo json_encode($dp->value);?> },
            @endforeach
   ]
        function drawPieChart(placeholder2, dataa, position) {
            $.plot(placeholder2, dataa, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: 10,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                },
                pagingSymbols: {
                    prev: 'prev',
                    next: 'next'
                },
                pagingButtonsConfiguration: 'auto',
                pieSliceText : 'none'
            })
        }
        drawPieChart(placeholder2, dataa);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder2.data('chart', dataa);
        placeholder2.data('draw', drawPieChart);


        //pie chart tooltip example
        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder2.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);

                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });




        ///////////////////////////

        var placeholder3 = $('#piechart-placeholder_acad').css({'width':'90%' , 'min-height':'220px','height':'100%'});
        //var va_aca = document.getElementById("valide_aca").value;
        //var no_va_aca = document.getElementById("non_valide_aca").value;
        var data_aca = [
            @foreach($Data_aca_ensam as $da)
            {
                label: "Academie : ".concat(<?php echo json_encode($da->name);?>),
                data:<?php echo json_encode($da->value);?> },
            @endforeach
        ]
        function drawPieChart(placeholder3, data_aca, position) {
            $.plot(placeholder3, data_aca, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder3, data_aca);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder3.data('chart', data_aca);
        placeholder3.data('draw', drawPieChart);


        //pie chart tooltip example
        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder3.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });
        /////////////////////////////////////
        var placeholder4 = $('#piechart-placeholder_bac').css({'width':'97%' , 'min-height':'300px'});
        // var va_fil = document.getElementById("valide_fil").value;
        //  var no_va_fil = document.getElementById("non_valide_fil").value;
        var data_fil = [
            @foreach($Data_bac_ensam as $db)
            {
                label: "".concat(<?php echo json_encode($db->name);?>),
                data:<?php echo json_encode($db->value);?> },
            @endforeach
        ]
        function drawPieChart(placeholder4, data_fil, position) {
            $.plot(placeholder4, data_fil, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder4, data_fil);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder4.data('chart', data_fil);
        placeholder4.data('draw', drawPieChart);


        //pie chart tooltip example
        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder4.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });
        //////////////////////

        $(document).one('ajaxloadstart.page', function(e) {
            $tooltip.remove();
        });






    </script>
@endsection
