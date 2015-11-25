@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes do Funcionário
		<a href="{{ URL::to('funcionario') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<div class="jumbotron">
        <h2>{{ e($funcionario->matricula) . " - " }} {{ e($funcionario->nome) }} </h2>
        <p><strong>Ativo:</strong> {{ e( ($funcionario->ativo ? 'SIM' : 'NÃO') ) }}</p>
        <p><strong>Data de nascimento:</strong> {{ Util::toView($funcionario->data_nascimento) }}</p>
        <p><strong>Data de Admissão:</strong> {{ Util::toView($funcionario->data_admissao) }}</p>
        <p><strong>Data de Demissão:</strong> {{ Util::toView($funcionario->data_demissao) }}</p>

        <p><strong>Função:</strong> {{ e($funcionario->funcao) }}</p>
         <p>
            <strong>Jornada de trabalho:</strong>
            {{ Util::hora_toView(e($funcionario->hr_inicial)) . " | "}}
            {{ Util::hora_toView(e($funcionario->inter_hr_inicial)) . " | "}}
            {{ Util::hora_toView(e($funcionario->inter_hr_final)) . " | "}}
            {{ Util::hora_toView(e($funcionario->hr_final))}}
        </p>
        
        <p><strong>Natural de:</strong> {{ e($funcionario->naturalidade) }}</p>
        <p><strong>UF Naturalidade:</strong> {{ e($funcionario->uf_natural) }}</p>
        <p><strong>Nacionalidade:</strong> {{ e($funcionario->nacionalidade) }}</p>
        <p><strong>CPF:</strong> {{ Util::mask(e($funcionario->cpf), "###.###.###-##") }}</p>
        <p><strong>RG:</strong> {{ e($funcionario->rg) }}</p>
        <p><strong>Órgão expedidor RG:</strong> {{ e($funcionario->orgao_exp_rg) }}</p>
        <p><strong>Data Expedição RG:</strong> {{ Util::toView(e($funcionario->data_exped_rg)) }}</p>
        <p><strong>Endereço:</strong> {{ e($funcionario->endereco) }}</p>
        <p><strong>Número:</strong> {{ e($funcionario->numero) }}</p>
        <p><strong>Complemento:</strong> {{ e($funcionario->complemento) }}</p>
        <p><strong>Bairro:</strong> {{ e($funcionario->bairro) }}</p>
        <p><strong>Cidade:</strong> {{ e($funcionario->cidade) }}</p>
        <p><strong>Estado:</strong> {{ e($funcionario->uf) }}</p>
        <p><strong>CEP:</strong> {{ Util::mask(e($funcionario->cep), "##.###-###") }}</p>
        <p><strong>Telefone 1:</strong> {{ Util::mask(e($funcionario->tel_1), "(##) ####-####") }}</p>
        <p><strong>Telefone 2:</strong> {{ Util::mask(e($funcionario->tel_2), "(##) ####-####") }}</p>
        <p><strong>Celular 1:</strong> {{ Util::mask(e($funcionario->celular1), "(##) #-####-####") }}</p>
        <p><strong>Celular 2:</strong> {{ Util::mask(e($funcionario->celular2), "(##) #-####-####") }}</p>
        <p><strong>E-Mail:</strong> {{ e($funcionario->email) }}</p>
        <p><strong>Criado:</strong> {{ Util::toTimestamps($funcionario->created_at) }}</p>
        <p><strong>Modificado:</strong> {{ Util::toTimestamps($funcionario->updated_at) }}</p>

        <p><strong>Observação:</strong> {{ $funcionario->observacao }}</p>
    </div>
    <hr>
    <h4>
        <a href="{{ URL::to('funcionario') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
    </h4>
    <hr>

@stop