@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar novo equipamento
		<a href="{{ URL::to('equipamento') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'equipamento', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-md-4 {{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('modelo') ? 'has-error' : '' }}">
			{{ Form::label('modelo', '* Modelo', array('class' => 'control-label')) }}
        	{{ Form::text('modelo', Input::old('modelo'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('modelo', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('fabricante') ? 'has-error' : '' }}">
			{{ Form::label('fabricante', '* Fabricante', array('class' => 'control-label')) }}
        	{{ Form::text('fabricante', Input::old('fabricante'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('fabricante', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-1 borda_situacao_ativo">
			{{ Form::label('ativo', '* Situação', array('class' => 'control-label'))}} <br/><br/>

			{{ Form::checkbox('ativo', true, true, array('id' => 'ativo')) . ' ' . Form::label('ativo', 'Ativo') }}
		</div>

		<div class="col-md-2 {{ $errors->first('data_fabricacao') ? 'has-error' : '' }}">
			{{ Form::label('data_fabricacao', '* Data de fabricação', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_fabricacao', Input::old('data_fabricacao'), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_fabricacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('nr_patrimonio') ? 'has-error' : '' }}">
			{{ Form::label('nr_patrimonio', '* Nº Patrimônio', array('class' => 'control-label')) }}
        	{{ Form::text('nr_patrimonio', Input::old('nr_patrimonio'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('nr_patrimonio', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('situacao') ? 'has-error' : '' }}">
			{{ Form::label('situacao', '* Situação', array('class' => 'control-label')) }}
			{{ Form::select('situacao', Equipamento::situacao_equip(), Input::old('situacao'), array('class' => 'form-control', 'required')) }}
			{{ $errors->first('situacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('data_cadastro') ? 'has-error' : '' }}">
			{{ Form::label('data_cadastro', '* Data do Cadastro', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_cadastro', Input::old('data_cadastro'), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_cadastro', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('peso_kg') ? 'has-error' : '' }}">
			{{ Form::label('peso_kg', '* PESO KG', array('class' => 'control-label')) }}
        	{{ Form::text('peso_kg', Input::old('peso_kg'), array('data-mask' => '000.000.000.000.000,00',
        	'reverse' => 'true', 'class' => 'form-control')) }}
        	{{ $errors->first('peso_kg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('cliente_id') ? 'has-error' : '' }}">
			{{ Form::label('cliente_id', '* Cliente', array('class' => 'control-label')) }}
        	{{ Form::select('cliente_id', Cliente::options(), Input::old('cliente_id'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('cliente_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('categoria_id') ? 'has-error' : '' }}">
			{{ Form::label('categoria_id', '* Categoria', array('class' => 'control-label')) }}
        	{{ Form::select('categoria_id', CategoriaEquipamentos::options(), Input::old('categoria_id'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('categoria_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('localizacao_id') ? 'has-error' : '' }}">
			{{ Form::label('localizacao_id', '* Localização', array('class' => 'control-label')) }}
        	{{ Form::select('localizacao_id', LocalizacaoEquipamentos::options(), Input::old('localizacao_id'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('localizacao_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-11 pull-left {{ $errors->first('observacao') ? 'has-error' : '' }}">
			{{ Form::label('observacao', 'Características', array('class' => 'control-label')) }}
        	{{ Form::textarea('observacao', Input::old('observacao'), array('class' => 'form-control')) }}
        	{{ $errors->first('observacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop
