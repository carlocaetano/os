@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-plus-sign"></span> Adicionar novo cliente
		<a href="{{ URL::to('cliente') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'cliente', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-md-5 {{ $errors->first('razao_social') ? 'has-error' : '' }}">
			{{ Form::label('razao_social', '* Nome/Razão Social', array('class' => 'control-label')) }}
        	{{ Form::text('razao_social', Input::old('razao_social'), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('razao_social', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('data_cadastro') ? 'has-error' : '' }}">
			{{ Form::label('data_cadastro', '* Data do Cadastro', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_cadastro', Input::old('data_cadastro'), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_cadastro', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('tp_pessoa') ? 'has-error' : '' }}">
			{{ Form::label('tp_pessoa', '* Tipo Pessoa', array('class' => 'control-label')) }} <br/><br/>

			{{ Form::radio('tp_pessoa', 'F', null , array('id'=>'F') ) . ' ' . Form::label('tp_pessoa', 'Física') . '&nbsp&nbsp;' }}
			{{ Form::radio('tp_pessoa', 'J', null, array('id' => 'M') ). ' ' . Form::label('tp_pessoa', 'Jurídica') }}
		</div>
		
		<div class="col-md-1 borda_situacao_ativo">
			{{ Form::label('ativo', '* Situação', array('class' => 'control-label'))}} <br/><br/>

			{{ Form::checkbox('ativo', true, true, array('id' => 'ativo')) . ' ' . Form::label('ativo', 'Ativo') }}
		</div>

		<div class="col-md-5 {{ $errors->first('nome_fantasia') ? 'has-error' : '' }}">
			{{ Form::label('nome_fantasia', '* Apelido/Nome fantasia', array('class' => 'control-label')) }}
        	{{ Form::text('nome_fantasia', Input::old('nome_fantasia'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nome_fantasia', '<span class="text-danger">:message</span>') }}
		</div>
	
		<div class="col-md-3 {{ $errors->first('cnpj') ? 'has-error' : '' }}">
			{{ Form::label('cnpj', '* CNPJ', array('class' => 'control-label')) }}
        	{{ Form::text('cnpj', Input::old('cnpj'), array('data-mask' => '99.999.999/9999-99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('cnpj', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('cpf') ? 'has-error' : '' }}">
			{{ Form::label('cpf', '* CPF', array('class' => 'control-label')) }}
        	{{ Form::text('cpf', Input::old('cpf'), array('data-mask' => '999.999.999-99', 'class' => 'form-control')) }}
        	{{ $errors->first('cpf', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('data_nascimento') ? 'has-error' : '' }}">
			{{ Form::label('data_nascimento', '* Data de Nascimento', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_nascimento', Input::old('data_nascimento'), array('data-mask' => '99/99/9999', 'class' => 'form-control')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_nascimento', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('inscricao_est_rg') ? 'has-error' : '' }}">
			{{ Form::label('inscricao_est_rg', '* RG/Inscrição Estadual', array('class' => 'control-label')) }}
        	{{ Form::text('inscricao_est_rg', Input::old('inscricao_est_rg'), array('class' => 'form-control')) }}
        	{{ $errors->first('inscricao_est_rg', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('orgao_exp_rg') ? 'has-error' : '' }}">
			{{ Form::label('orgao_exp_rg', '* Órgão expedidor RG', array('class' => 'control-label')) }}
        	{{ Form::text('orgao_exp_rg', Input::old('orgao_exp_rg'), array('class' => 'form-control')) }}
        	{{ $errors->first('orgao_exp_rg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('data_exped_rg') ? 'has-error' : '' }}">
			{{ Form::label('data_exped_rg', '* Data Expedição RG', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_exped_rg', Input::old('data_exped_rg'), array('data-mask' => '99/99/9999', 'class' => 'form-control')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_exped_rg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-5 {{ $errors->first('endereco') ? 'has-error' : '' }}">
			{{ Form::label('endereco', '* Endereço', array('class' => 'control-label')) }}
        	{{ Form::text('endereco', Input::old('endereco'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('endereco', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-1 {{ $errors->first('numero') ? 'has-error' : '' }}">
			{{ Form::label('numero', '* Número', array('class' => 'control-label')) }}
        	{{ Form::text('numero', Input::old('numero'), array('data-mask' => '9999', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('numero', '<span class="text-danger">:message</span>') }}
		</div>
			
		<div class="col-md-5 {{ $errors->first('complemento') ? 'has-error' : '' }}">
			{{ Form::label('complemento', '* Complemento', array('class' => 'control-label')) }}
        	{{ Form::text('complemento', Input::old('complemento'), array('class' => 'form-control')) }}
        	{{ $errors->first('complemento', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-4 {{ $errors->first('bairro') ? 'has-error' : '' }}">
			{{ Form::label('bairro', '* Bairro', array('class' => 'control-label')) }}
        	{{ Form::text('bairro', Input::old('bairro'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('bairro', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('cidade') ? 'has-error' : '' }}">
			{{ Form::label('cidade', '* Cidade', array('class' => 'control-label')) }}
        	{{ Form::text('cidade', Input::old('cidade'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('cidade', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('uf') ? 'has-error' : '' }}">
			{{ Form::label('uf', '* UF', array('class' => 'control-label')) }}
			{{ Form::select('uf', Util::estados(), Input::old('uf'), array('class' => 'form-control', 'required')) }}
			{{ $errors->first('uf', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('cep') ? 'has-error' : '' }}">
			{{ Form::label('cep', '* CEP', array('class' => 'control-label')) }}
		    {{ Form::text('cep', Input::old('cep'), array('data-mask' => '99.999-999', 'class' => 'form-control', 'required')) }}
		    {{ $errors->first('cep', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-5 {{ $errors->first('ponto_referencia') ? 'has-error' : '' }}">
			{{ Form::label('ponto_referencia', 'Ponto de Referência', array('class' => 'control-label')) }}
        	{{ Form::text('ponto_referencia', Input::old('ponto_referencia'), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('ponto_referencia', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('tel_1') ? 'has-error' : '' }}">
			{{ Form::label('tel_1', '* Telefone 1', array('class' => 'control-label')) }}
		    {{ Form::text('tel_1', Input::old('tel_1'), array('data-mask' => '(99) 9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('tel_1', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('tel_2') ? 'has-error' : '' }}">
			{{ Form::label('tel_2', '* Telefone 2', array('class' => 'control-label')) }}
		    {{ Form::text('tel_2', Input::old('tel_2'), array('data-mask' => '(99) 9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('tel_2', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('tel_3') ? 'has-error' : '' }}">
			{{ Form::label('tel_3', '* Telefone 3', array('class' => 'control-label')) }}
		    {{ Form::text('tel_3', Input::old('tel_3'), array('data-mask' => '(99) 9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('tel_3', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('celular1') ? 'has-error' : '' }}">
			{{ Form::label('celular1', '* Celular 1', array('class' => 'control-label')) }}
		    {{ Form::text('celular1', Input::old('celular1'), array('data-mask' => '(99) 9-9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('celular1', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-3 {{ $errors->first('celular2') ? 'has-error' : '' }}">
			{{ Form::label('celular2', '* Celular 2', array('class' => 'control-label')) }}
		    {{ Form::text('celular2', Input::old('celular2'), array('data-mask' => '(99) 9-9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('celular2', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-5 {{ $errors->first('email') ? 'has-error' : '' }}">
			{{ Form::label('email', 'E-mail', array('class' => 'control-label')) }}
        	{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
        	{{ $errors->first('email', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-11 pull-left {{ $errors->first('observacao') ? 'has-error' : '' }}">
			{{ Form::label('observacao', 'Observação', array('class' => 'control-label')) }}
        	{{ Form::textarea('observacao', Input::old('observacao'), array('class' => 'form-control')) }}
        	{{ $errors->first('observacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop
