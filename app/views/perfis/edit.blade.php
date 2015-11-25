@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-edit"></span> Alterar perfil
		<a href="{{ URL::to('perfil') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{Form::open(array('url' => 'perfil/'. $perfil->id, 'method' => 'put', 'class' => 'form-horizontal row', 'role' => 'form'))}}

		<div class="col-xs-12 {{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::text('descricao', Input::old('descricao', $perfil->descricao), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>

		@foreach (Acao::options() as $key => $value)
			<div class="col-xs-4">
				{{ Form::checkbox('acoes_id[]', $key, in_array($key, $acoes_id), array('id' => $key)) . ' ' . Form::label($key, $value) }}
			</div>
		@endforeach

		<div class="col-btn">
			{{ Form::submit('Alterar', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
@stop