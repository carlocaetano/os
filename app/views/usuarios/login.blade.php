@extends('layouts.admin')

@section('content')
    @if(Session::has('flash_error'))
    	<div class="alert alert-danger alert-dismissable">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    		{{ Session::get('flash_error') }}
    	</div>
    @endif

    @if(Session::has('flash_notice'))
    	<div class="alert alert-info alert-dismissable">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    		{{ Session::get('flash_notice') }}
    	</div>
    @endif
    {{ Form::open(array('url' => 'login', 'class' => 'form-signin')) }}
        {{ HTML::image('assets/img/content/logo.png','OSPRIME', array('id' => 'LOGO')) }}
        <h2 class="form-signin-heading text-center">ORDEM DE SERVIÇOS WEB</h2>
        <div class="well">
            <p class="text-muted text-center">
                Identifique-se para efetuar o seu login e utilizar o sistema.
            </p>
            {{ Form::text('username', Input::old('username'), array('placeholder' => 'Usuário',
                'class' => 'form-control', 'required', 'autofocus')) }}

            {{ Form::password('password', array('placeholder' => 'Senha', 'class' => 'form-control', 'required')) }}

            {{ Form::submit('Enviar', array('class' => 'btn btn-primary btn-lg btn-block')) }}
            </br>
            {{Form::checkbox('rememberme', "rememberme", null, array('id' => "rememberme")) . ' ' . Form::label("rememberme", "Lembrar")}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{HTML::link('user/profile', 'Esqueceu sua senha?', array('class' => 'text-right')) }}
        </div>
        <p class="form-signin-footer text-center">Copyright &copy; 2014 - Todos os direitos reservados<br/>
            Desenvolvido por: artisanweb
        </p>
    {{ Form::close() }}
    
@stop