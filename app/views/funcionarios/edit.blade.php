@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-edit"></span> Alterar funcionário
		<a href="{{ URL::to('funcionario') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'funcionario/' . $funcionario->id, 'method' => 'put', 'class' => 'form-horizontal row', 'role' => 'form')) }}

		<div class="col-md-2 {{ $errors->first('matricula') ? 'has-error' : '' }}">
			{{ Form::label('matricula', '* Matrícula', array('class' => 'control-label')) }}
        	{{ Form::text('matricula', Input::old('matricula', $funcionario->matricula), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('matricula', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-4 {{ $errors->first('nome') ? 'has-error' : '' }}">
			{{ Form::label('nome', '* Nome', array('class' => 'control-label')) }}
        	{{ Form::text('nome', Input::old('nome', $funcionario->nome), array('class' => 'form-control input-md', 'required')) }}
        	{{ $errors->first('nome', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('data_nascimento') ? 'has-error' : '' }}">
			{{ Form::label('data_nascimento', '* Data Nascimento', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_nascimento', Input::old('data_nascimento', Util::toView($funcionario->data_nascimento)), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_nascimento', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('data_admissao') ? 'has-error' : '' }}">
			{{ Form::label('data_admissao', '* Data Admissão', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_admissao', Input::old('data_admissao', Util::toView($funcionario->data_admissao)), array('data-mask' => '99/99/9999', 'class' => 'form-control', 'required')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_admissao', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-1 {{ ($funcionario->ativo == '1') ? 'borda_situacao_ativo' : 'borda_situacao_inativo' }}">
			{{ Form::label('ativo', '* Situação', array('class' => 'control-label'))}} <br/><br/>

			{{ Form::checkbox('ativo', $funcionario->ativo,
			($funcionario->ativo == '1') ? true : false, array('id' => 'ativo')) . ' ' .
			Form::label('ativo', (Input::old('ativo', $funcionario->ativo) == '1') ? 'Ativo' : 'Inativo') }}
		</div>

		<div class="col-md-3 {{ $errors->first('naturalidade') ? 'has-error' : '' }}">
			{{ Form::label('naturalidade', '* Naturalidade', array('class' => 'control-label')) }}
        	{{ Form::text('naturalidade', Input::old('naturalidade', $funcionario->naturalidade), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('naturalidade', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('uf_natural') ? 'has-error' : '' }}">
			{{ Form::label('uf_natural', '* UF Naturalidade', array('class' => 'control-label')) }}
			{{ Form::select('uf_natural', Util::estados(), Input::old('uf_natural', $funcionario->uf_natural), array('class' => 'form-control', 'required')) }}
			{{ $errors->first('uf_natural', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('nacionalidade') ? 'has-error' : '' }}">
			{{ Form::label('nacionalidade', '* Nacionalidade', array('class' => 'control-label')) }}
        	{{ Form::text('nacionalidade', Input::old('nacionalidade', $funcionario->nacionalidade), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('nacionalidade', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('cpf') ? 'has-error' : '' }}">
			{{ Form::label('cpf', '* CPF', array('class' => 'control-label')) }}
        	{{ Form::text('cpf', Input::old('cpf', $funcionario->cpf), array('data-mask' => '999.999.999-99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('cpf', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('rg') ? 'has-error' : '' }}">
			{{ Form::label('rg', 'RG', array('class' => 'control-label')) }}
        	{{ Form::text('rg', Input::old('rg', $funcionario->rg), array('class' => 'form-control')) }}
        	{{ $errors->first('rg', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('orgao_exp_rg') ? 'has-error' : '' }}">
			{{ Form::label('orgao_exp_rg', 'Órgão expedidor RG', array('class' => 'control-label')) }}
        	{{ Form::text('orgao_exp_rg', Input::old('orgao_exp_rg', $funcionario->orgao_exp_rg), array('class' => 'form-control')) }}
        	{{ $errors->first('orgao_exp_rg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('data_exped_rg') ? 'has-error' : '' }}">
			{{ Form::label('data_exped_rg', 'Data Expedição RG', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_exped_rg', Input::old('data_exped_rg', Util::toView($funcionario->data_exped_rg)), array('data-mask' => '99/99/9999', 'class' => 'form-control')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_exped_rg', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-5 {{ $errors->first('endereco') ? 'has-error' : '' }}">
			{{ Form::label('endereco', '* Endereço', array('class' => 'control-label')) }}
        	{{ Form::text('endereco', Input::old('endereco', $funcionario->endereco), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('endereco', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-1 {{ $errors->first('numero') ? 'has-error' : '' }}">
			{{ Form::label('numero', '* Número', array('class' => 'control-label')) }}
        	{{ Form::text('numero', Input::old('numero', $funcionario->numero), array('data-mask' => '9999', 'class' => 'form-control')) }}
        	{{ $errors->first('numero', '<span class="text-danger">:message</span>') }}
		</div>
			
		<div class="col-md-5 {{ $errors->first('complemento') ? 'has-error' : '' }}">
			{{ Form::label('complemento', '* Complemento', array('class' => 'control-label')) }}
        	{{ Form::text('complemento', Input::old('complemento', $funcionario->complemento), array('class' => 'form-control')) }}
        	{{ $errors->first('complemento', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-4 {{ $errors->first('bairro') ? 'has-error' : '' }}">
			{{ Form::label('bairro', '* Bairro', array('class' => 'control-label')) }}
        	{{ Form::text('bairro', Input::old('bairro', $funcionario->bairro), array('class' => 'form-control')) }}
        	{{ $errors->first('bairro', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('cidade') ? 'has-error' : '' }}">
			{{ Form::label('cidade', '* Cidade', array('class' => 'control-label')) }}
        	{{ Form::text('cidade', Input::old('cidade', $funcionario->cidade), array('class' => 'form-control')) }}
        	{{ $errors->first('cidade', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('uf') ? 'has-error' : '' }}">
			{{ Form::label('uf', '* UF', array('class' => 'control-label')) }}
			{{ Form::select('uf', Util::estados(), Input::old('uf', $funcionario->uf), array('class' => 'form-control', 'required')) }}
			{{ $errors->first('uf', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('cep') ? 'has-error' : '' }}">
			{{ Form::label('cep', '* CEP', array('class' => 'control-label')) }}
		    {{ Form::text('cep', Input::old('cep', $funcionario->cep), array('data-mask' => '99.999-999', 'class' => 'form-control', 'required')) }}
		    {{ $errors->first('cep', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('tel_1') ? 'has-error' : '' }}">
			{{ Form::label('tel_1', '* Telefone 1', array('class' => 'control-label')) }}
		    {{ Form::text('tel_1', Input::old('tel_1', $funcionario->tel_1), array('data-mask' => '(99) 9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('tel_1', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('tel_2') ? 'has-error' : '' }}">
			{{ Form::label('tel_2', '* Telefone 2', array('class' => 'control-label')) }}
		    {{ Form::text('tel_2', Input::old('tel_2', $funcionario->tel_2), array('data-mask' => '(99) 9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('tel_2', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('celular1') ? 'has-error' : '' }}">
			{{ Form::label('celular1', '* Celular 1', array('class' => 'control-label')) }}
		    {{ Form::text('celular1', Input::old('celular1', $funcionario->celular1), array('data-mask' => '(99) 9-9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('celular1', '<span class="text-danger">:message</span>') }}
		</div>
		
		<div class="col-md-2 {{ $errors->first('celular2') ? 'has-error' : '' }}">
			{{ Form::label('celular2', '* Celular 2', array('class' => 'control-label')) }}
		    {{ Form::text('celular2', Input::old('celular2', $funcionario->celular2), array('data-mask' => '(99) 9-9999-9999', 'class' => 'form-control')) }}
		    {{ $errors->first('celular2', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('email') ? 'has-error' : '' }}">
			{{ Form::label('email', 'E-mail', array('class' => 'control-label')) }}
        	{{ Form::text('email', Input::old('email', $funcionario->email), array('class' => 'form-control')) }}
        	{{ $errors->first('email', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('jornada_id') ? 'has-error' : '' }}">
			{{ Form::label('jornada_id', '* Jornada', array('class' => 'control-label')) }}
        	{{ Form::select('jornada_id', JornadaTrabalho::options(), Input::old('jornada_id', $funcionario->jornada_id), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('jornada_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-3 {{ $errors->first('funcao_id') ? 'has-error' : '' }}">
			{{ Form::label('funcao_id', '* Função', array('class' => 'control-label')) }}
        	{{ Form::select('funcao_id', Funcao::options(), Input::old('funcao_id', $funcionario->funcao_id), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('funcao_id', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('data_demissao') ? 'has-error' : '' }}">
			{{ Form::label('data_demissao', 'Data Desligamento', array('class' => 'control-label')) }}
			<div class="input-group date">
	        	{{ Form::text('data_demissao', Input::old('data_demissao', Util::toView($funcionario->data_demissao)), array('data-mask' => '99/99/9999', 'class' => 'form-control')) }}
	        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
        	{{ $errors->first('data_demissao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-11 pull-left {{ $errors->first('observacao') ? 'has-error' : '' }}">
			{{ Form::label('observacao', 'Observação', array('class' => 'control-label')) }}
        	{{ Form::textarea('observacao', Input::old('observacao', $funcionario->observacao), array('class' => 'form-control')) }}
        	{{ $errors->first('observacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Alterar', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
@stop
