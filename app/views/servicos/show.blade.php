@extends('layouts.admin')

@section('content')
    <h4>
        <span class="glyphicon glyphicon-info-sign"></span> Detalhes do Material
        <a href="{{ URL::to('material') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
    </h4>
    <hr>
    <div class="jumbotron">
        <h2>{{ e($material->descricao) . " STATUS: [ "}} {{ Material::retorna_situacao_mat(e($material->situacao)) . " ]"}}</h2>
        <h3>{{ " Fabricante/Marca: " . e($material->fabricante_marca) }}</h3>
        <p><strong>Data de fabricação:</strong> {{ Util::toView($material->data_fabricacao) }}</p>
        <p><strong>Unidade:</strong> {{ Material::retorna_unidade_mat(e($material->unidade)) }}</p>
        <p><strong>Quantidade:</strong> {{ e($material->qtde) }}</p>
        <p><strong>Estoque Mínimo:</strong> {{ e($material->estoque_min) }}</p>
        <p><strong>Estoque Máximo:</strong> {{ e($material->estoque_max) }}</p>
        <p><strong>Peso KG:</strong> {{ e($material->estoque_max) }}</p>
        <p><strong>Preço custo:</strong> {{ e($material->preco_custo) }}</p>
        <p><strong>Data de cadastro:</strong> {{ Util::toView($material->data_cadastro) }}</p>
        <p><strong>Ativo:</strong> {{ e( ($material->ativo ? 'SIM' : 'NÃO') ) }}</p>

        <p><strong>Localização:</strong> {{ e($material->localizacao) }}</p>
        <p><strong>Categoria:</strong> {{ e($material->categoria) }}</p>


        <p><strong>Observação:</strong> {{ $material->observacao }}</p>
    </div>
    <hr>
    <h4>
        <a href="{{ URL::to('material') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
    </h4>
    <hr>

@stop