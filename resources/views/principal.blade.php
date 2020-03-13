@extends('layout.appdata')

@section('title', '| Users')

@section('content')
    <?php
    $role =  Auth::user()->roles()->pluck('name')->implode(' ');
    //$res='';
   /* if($bool==0){
        $res='disabled';
    }
    if($bool==1){
        $res='active';
    }*/
    ?>
    <form style="margin-top: 20px;margin-left: 200px;margin-right: 100px;">
    <div class="row" style="margin-left: -100px;">
        <div class="col-md-2">


        </div>
         <div class="col-md-3">
             <?php $res="active"; if($role=='Responsable') $res="disabled"?>
            <a  href="{{url('lst')}}" class="btn btn-sm btn-success {{$res}}" style="width: 270px;height: 270px;;">

                <i style="margin-top: 100px" class="fa fa-graduation-cap bigger-300" aria-hidden="true"> Etudiants</i>
            </a>
         </div>
        <div class="col-md-3">
            <?php $res="active"; if($role=='Agent_ESTM'||$role=='Responsable' ) $res="disabled"?>
            <a  href="{{url('lst_opi')}}" class="btn btn-sm btn-warning {{$res}}" style="width: 270px;height: 270px;">

                <i style="margin-top: 100px" class="fa fa-wrench bigger-300" aria-hidden="true"> Edit OPI</i>
            </a>
        </div>


    </div>
        <div class="row" style="margin-left: -100px;margin-top: 5px;">
            <div class="col-md-2">


            </div>
            <div class="col-md-3">
                <?php $res="active"; if($role=='Agent_ESTM') $res="disabled"?>
                <a  href="{{url('lst_stat')}}" class="btn btn-sm btn-danger {{$res}}" style="width: 270px;height: 270px;">

                    <i style="margin-top: 100px" class="fa fa-pie-chart bigger-300"  aria-hidden="true"> Statistique</i>
                </a>
            </div>
            <div class="col-md-3">
                <?php $res="disabled"; if($role=='SuperAdmin') $res="active"?>
                <a href="{{url('lst_users')}}" class="btn btn-sm btn-info {{$res}}" style="width: 270px;height: 270px;">

                    <i style="margin-top: 100px" class="fa fa-users bigger-300" aria-hidden="true"> Profils</i>
                </a>
            </div>

            </div>

        </div>
    </form>

@endsection