@extends('layout.app')

@section('title', '| Edit Permission')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> Editer {{$permission->name}}</h1>
        <br>
        {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

        <div class="form-group">
            {{ Form::label('name', 'Nom Permission') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::submit('Editer', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>

    <!-- <![endif]-->

    <!--[if IE]>

    <![endif]-->

    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- page specific plugin scripts -->



    <!-- ace scripts -->
    <script src="{{asset('assets/js/ace.min.js')}}"></script>

    <!-- inline scripts related to this page -->


@endsection