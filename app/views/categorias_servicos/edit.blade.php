@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-edit"></span> Alterar categorias de serviços
		<a href="{{ URL::to('categorias_servicos') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{Form::open(array('url' => 'categorias_servicos/'. $categoria->id, 'method' => 'put', 'class' => 'form-horizontal row', 'role' => 'form'))}}

		<div class="col-md-6{{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::text('descricao', Input::old('descricao', $categoria->descricao), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('ativo') ? 'has-error' : '' }}">
			{{ Form::label('ativo', '* Ativo', array('class' => 'control-label')) }}
        	{{ Form::select('ativo', array(0 => 'Não', 1 => 'Sim'), Input::old('ativo', $categoria->ativo), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('ativo', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Alterar', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
@stop