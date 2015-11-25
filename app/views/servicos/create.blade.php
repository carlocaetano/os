@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar novo serviço
		<a href="{{ URL::to('servico') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'servico', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-sm-3 {{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-sm-2  {{ $errors->first('min_hr') ? 'has-error' : '' }}">
			{{ Form::label('min_hr', '* Hora Min', array('class' => 'control-label')) }}
        	{{ Form::text('min_hr', Input::old('min_hr'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('min_hr', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-sm-2 {{ $errors->first('min_min') ? 'has-error' : '' }}">
			{{ Form::label('min_min', '* Minuto Min', array('class' => 'control-label')) }}
        	{{ Form::text('min_min', Input::old('min_min'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('min_min', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-sm-2 {{ $errors->first('max_hr') ? 'has-error' : '' }}">
			{{ Form::label('max_hr', '* Hora max', array('class' => 'control-label')) }}
        	{{ Form::text('max_hr', Input::old('max_hr'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('max_hr', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-sm-2 {{ $errors->first('max_min') ? 'has-error' : '' }}">
			{{ Form::label('max_min', '* Minuto Max', array('class' => 'control-label')) }}
        	{{ Form::text('max_min', Input::old('max_min'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('max_min', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-1 borda_situacao_ativo">
			{{ Form::label('ativo', '* Situação', array('class' => 'control-label'))}} <br/><br/>

			{{ Form::checkbox('ativo', true, true, array('id' => 'ativo')) . ' ' . Form::label('ativo', 'Ativo') }}
		</div>

		<div class="col-sm-2 {{ $errors->first('prioridade') ? 'has-error' : '' }}">
			{{ Form::label('prioridade', '* Prioridade', array('class' => 'control-label')) }}
			{{ Form::select('prioridade', Servico::prioridade(), Input::old('prioridade'), array('class' => 'form-control input-sm', 'required')) }}
			{{ $errors->first('prioridade', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-sm-2 {{ $errors->first('categoria_id') ? 'has-error' : '' }}">
			{{ Form::label('categoria_id', '* Categoria', array('class' => 'control-label')) }}
        	{{ Form::select('categoria_id', CategoriaServicos::options(), Input::old('categoria_id'), array('class' => 'form-control input-sm', 'required')) }}
        	{{ $errors->first('categoria_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop
