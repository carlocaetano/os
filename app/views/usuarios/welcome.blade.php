@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        <h2>Seja bem-vindo(a) <strong>{{ Auth::user()->nome }}</strong></h2>
        <p>Você está logado no sistema!!!</p>
    </div>
@stop