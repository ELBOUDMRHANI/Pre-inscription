
@extends('layout.app')

@section('content')
    <div class='col-lg-4 col-lg-offset-4'>
        <h1><center>401</center><br>
                aucun etudiant dans la etalissement <b>{{$etablissement}}</b> <br> de <b>{{$diplome}}</b><br> pour la filiere <b>{{$filiere}}</b> </h1>
    </div>

@endsection