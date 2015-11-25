@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar novo material
		<a href="{{ URL::to('material') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'material', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-md-4 {{ $errors->first('descricao') ? 'has-error' : '' }}">
			{{ Form::label('descricao', '* Descrição', array('class' => 'control-label')) }}
        	{{ Form::text('descricao', Input::old('descricao'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('descricao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-4 {{ $errors->first('fabricante_marca') ? 'has-error' : '' }}">
			{{ Form::label('fabricante_marca', '* Fabricante/marca', array('class' => 'control-label')) }}
        	{{ Form::text('fabricante_marca', Input::old('fabricante_marca'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('fabricante_marca', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('data_fabricacao') ? 'has-error' : '' }}">
			{{ Form::label('data_fabricacao', '* Data de fabricação', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_fabricacao', Input::old('data_fabricacao'), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_fabricacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-1 borda_situacao_ativo">
			{{ Form::label('ativo', '* Situação', array('class' => 'control-label'))}} <br/><br/>

			{{ Form::checkbox('ativo', true, true, array('id' => 'ativo')) . ' ' . Form::label('ativo', 'Ativo') }}
		</div>

		<div class="col-md-2 {{ $errors->first('unidade') ? 'has-error' : '' }}">
			{{ Form::label('unidade', '* Unidade', array('class' => 'control-label')) }}
			{{ Form::select('unidade', Material::unidade_mat(), Input::old('unidade'), array('class' => 'form-control', 'required')) }}
			{{ $errors->first('unidade', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-1 {{ $errors->first('qtde') ? 'has-error' : '' }}">
			{{ Form::label('qtde', '* QTDE.', array('class' => 'control-label')) }}
        	{{ Form::text('qtde', Input::old('qtde'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('qtde', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('estoque_min') ? 'has-error' : '' }}">
			{{ Form::label('estoque_min', '* Estoque Min.', array('class' => 'control-label')) }}
        	{{ Form::text('estoque_min', Input::old('estoque_min'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('estoque_min', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('estoque_max') ? 'has-error' : '' }}">
			{{ Form::label('estoque_max', '* Estoque Max.', array('class' => 'control-label')) }}
        	{{ Form::text('estoque_max', Input::old('estoque_max'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('estoque_max', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('peso_kg') ? 'has-error' : '' }}">
			{{ Form::label('peso_kg', '* Peso/Kg', array('class' => 'control-label')) }}
        	{{ Form::text('peso_kg', Input::old('peso_kg'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('peso_kg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('preco_custo') ? 'has-error' : '' }}">
			{{ Form::label('preco_custo', '* Preço custo', array('class' => 'control-label')) }}
        	{{ Form::text('preco_custo', Input::old('preco_custo'), array('class' => 'form-control input-md')) }}
        	{{ $errors->first('preco_custo', '<span class="text-danger">:message</span>') }}
		</div>

		

		<div class="col-md-2 {{ $errors->first('situacao') ? 'has-error' : '' }}">
			{{ Form::label('situacao', '* Status', array('class' => 'control-label')) }}
			{{ Form::select('situacao', Material::situacao_mat(), Input::old('situacao'), array('class' => 'form-control', 'required')) }}
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
		
		<div class="col-md-3 {{ $errors->first('categoria_id') ? 'has-error' : '' }}">
			{{ Form::label('categoria_id', '* Categoria', array('class' => 'control-label')) }}
        	{{ Form::select('categoria_id', CategoriaMateriais::options(), Input::old('categoria_id'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('categoria_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('localizacao_id') ? 'has-error' : '' }}">
			{{ Form::label('localizacao_id', '* Localização', array('class' => 'control-label')) }}
        	{{ Form::select('localizacao_id', LocalizacaoMateriais::options(), Input::old('localizacao_id'), array('class' => 'form-control', 'required')) }}
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
