@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de equipamentos
		<a href="{{ URL::to('equipamento/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'equipamento', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		
		<div class="form-group">
			{{ Form::select('cliente_id', Cliente::options(), $cliente_id, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::select('categoria_id', CategoriaEquipamentos::options(), $categoria_id, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::select('localizacao_id', LocalizacaoEquipamentos::options(), $localizacao_id, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::text('nr_patrimonio', $nr_patrimonio, array('placeholder' => 'Nº Patrimônio', 'class' => 'form-control')) }}
		</div>

		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($equipamentos->getItems())
		Exibindo de {{ $equipamentos->getFrom() }} até {{ $equipamentos->getTo() }} de {{ $equipamentos->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('equipamento?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('equipamento?sort=fabricante' . $str) }}">Fabricante</a></th>
					<th><a href="{{ URL::to('equipamento?sort=cliente_id' . $str) }}">Cliente</a></th>
					<th><a href="{{ URL::to('equipamento?sort=categoria_id' . $str) }}">Categoria</a></th>
					<th><a href="{{ URL::to('equipamento?sort=situacao' . $str) }}">Situação</a></th>
					<th><a href="{{ URL::to('equipamento?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($equipamentos as $equipamento)
					<tr>
						<td>{{ e($equipamento->descricao) }}</td>
						<td>{{ e($equipamento->fabricante) }}</td>
						<td>{{ e($equipamento->cliente) }}</td>
						<td>{{ e($equipamento->categoria) }}</td>
						<td>{{ Equipamento::retorna_situacao_equip(e($equipamento->situacao)) }}</td>
						<td>{{ e( ($equipamento->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('equipamento/' . $equipamento->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('equipamento/' . $equipamento->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'equipamento/' . $equipamento->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
								{{ Form::button('Apagar', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'Apagar')) }}
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $pagination }}
	@else
		<p class="text-danger"><strong>{{ Util::message('MSG011') }}</strong></p>
	@endif
@stop