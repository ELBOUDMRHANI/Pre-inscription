{{-- \resources\views\users\edit.blade.php --}}

@extends('layout.app')

@section('title', '| Edit User')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-user-plus'></i> Editer {{$user->name}}</h1>
        <hr>

        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

        <div class="form-group">
            {{ Form::label('name', 'Nom') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>

        <h5><b>Affectation Role</b></h5>

        <div class='form-group'>
            @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

            @endforeach
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password') }}<br>
            {{ Form::password('password', array('class' => 'form-control')) }}

        </div>

        <div class="form-group">
            {{ Form::label('password', 'Confirmer Password') }}<br>
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

        </div>

        {{ Form::submit('Modifier', array('class' => 'btn btn-primary')) }}

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