@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-info-sign"></span> Detalhes do Equipamento
		<a href="{{ URL::to('equipamento') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	<div class="jumbotron">
        <h2>{{ e($equipamento->descricao) }}</h2>
        <h3>{{ " Cliente: " . e($equipamento->cliente) }}</h3>
        <p><strong>Nº do patrimônio:</strong> {{ e($equipamento->nr_patrimonio)}}</p>
        <p><strong>modelo:</strong> {{ e($equipamento->modelo) }}</p>
        <p><strong>Data de fabricação:</strong> {{ Util::toView($equipamento->data_fabricacao) }}</p>
        <p><strong>Data de cadastro:</strong> {{ Util::toView($equipamento->data_cadastro) }}</p>
        <p><strong>Ativo:</strong> {{ e( ($equipamento->ativo ? 'SIM' : 'NÃO') ) }}</p>

        <p><strong>PESO KG:</strong> {{ e($equipamento->peso_kg) }}</p>

        <p><strong>Fabricante:</strong> {{ e($equipamento->fabricante) }}</p>
        <p><strong>Localização:</strong> {{ e($equipamento->localizacao) }}</p>
        <p><strong>Situação:</strong> {{ Equipamento::retorna_situacao_equip(e($equipamento->situacao)) }}</p>


        <p><strong>Observação:</strong> {{ $equipamento->observacao }}</p>
    </div>
    <hr>
    <h4>
        <a href="{{ URL::to('equipamento') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
    </h4>
    <hr>

@stop