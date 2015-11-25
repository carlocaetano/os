@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes do Cliente
		<a href="{{ URL::to('cliente') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<div class="jumbotron">
        <h2>{{ e($cliente->razao_social) }}</h2>
        <p><strong>Apelido/Nome Fantasia:</strong> {{ e($cliente->nome_fantasia) }}</p>
        <p><strong>Data do cadastro:</strong> {{ Util::toView($cliente->data_cadastro) }}</p>
        <p><strong>Tipo de Pessoa:</strong> {{ e( ( ($cliente->tp_pessoa == 'F') ? 'Física' : 'Jurídica') ) }}</p>
        <p><strong>Ativo:</strong> {{ e( ($cliente->ativo ? 'SIM' : 'NÃO') ) }}</p>
        <p><strong>CNPJ:</strong> {{ Util::mask(e($cliente->cnpj), "##.###.###/####-##") }}</p>
        <p><strong>CPF:</strong> {{ Util::mask(e($cliente->cpf), "###.###.###-##") }}</p>
        <p><strong>Data de Nascimento:</strong> {{ Util::toView(e($cliente->data_nascimento)) }}</p>
        <p><strong>RG/Inscrição Estadual:</strong> {{ e($cliente->inscricao_est_rg) }}</p>
        <p><strong>Órgão expedidor RG:</strong> {{ e($cliente->orgao_exp_rg) }}</p>
        <p><strong>Data Expedição RG:</strong> {{ Util::toView(e($cliente->data_exped_rg)) }}</p>
        <p><strong>Endereço:</strong> {{ e($cliente->endereco) }}</p>
        <p><strong>Número:</strong> {{ e($cliente->numero) }}</p>
        <p><strong>Complemento:</strong> {{ e($cliente->complemento) }}</p>
        <p><strong>Bairro:</strong> {{ e($cliente->bairro) }}</p>
        <p><strong>Cidade:</strong> {{ e($cliente->cidade) }}</p>
        <p><strong>Estado:</strong> {{ e($cliente->uf) }}</p>
        <p><strong>CEP:</strong> {{ Util::mask(e($cliente->cep), "##.###-###") }}</p>
        <p><strong>Ponto de Referência:</strong> {{ e($cliente->ponto_referencia) }}</p>
        <p><strong>Telefone 1:</strong> {{ Util::mask(e($cliente->tel_1), "(##) ####-####") }}</p>
        <p><strong>Telefone 2:</strong> {{ Util::mask(e($cliente->tel_2), "(##) ####-####") }}</p>
        <p><strong>Telefone 3:</strong> {{ Util::mask(e($cliente->tel_3), "(##) ####-####") }}</p>
        <p><strong>Celular 1:</strong> {{ Util::mask(e($cliente->celular1), "(##) #-####-####") }}</p>
        <p><strong>Celular 2:</strong> {{ Util::mask(e($cliente->celular2), "(##) #-####-####") }}</p>
        <p><strong>E-Mail:</strong> {{ e($cliente->email) }}</p>
        <p><strong>Criado:</strong> {{ Util::toTimestamps($cliente->created_at) }}</p>
        <p><strong>Modificado:</strong> {{ Util::toTimestamps($cliente->updated_at) }}</p>

        <p><strong>Descrição:</strong> {{ $cliente->descricao }}</p>
    </div>
    <hr>
    <h4>
        <a href="{{ URL::to('cliente') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
    </h4>
    <hr>

@stop