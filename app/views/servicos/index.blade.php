@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de serviços
		<a href="{{ URL::to('servico/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'servico', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		
		<div class="form-group">
			{{ Form::select('categoria_id', CategoriaServicos::options(), $categoria_id, array('class' => 'form-control')) }}
		</div>

		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($servicos->getItems())
		Exibindo de {{ $servicos->getFrom() }} até {{ $servicos->getTo() }} de {{ $servicos->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('servicos?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('servicos?sort=min_hr' . $str) }}">HORA MIN</a></th>
					<th><a href="{{ URL::to('servicos?sort=min_min' . $str) }}">MINUTO MIN</a></th>
					<th><a href="{{ URL::to('servicos?sort=max_hr' . $str) }}">HORA MAX</a></th>
					<th><a href="{{ URL::to('servicos?sort=max_min' . $str) }}">MINUTO MAX</a></th>
					<th><a href="{{ URL::to('servicos?sort=prioridade' . $str) }}">Prioridade</a></th>
					<th><a href="{{ URL::to('servicos?sort=categoria_id' . $str) }}">Categoria</a></th>
					<th><a href="{{ URL::to('servicos?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($servicos as $servico)
					<tr>
						<td>{{ e($servico->descricao) }}</td>
						<td>{{ e($servico->min_hr) }}</td>
						<td>{{ e($servico->min_min) }}</td>
						<td>{{ e($servico->max_hr) }}</td>
						<td>{{ e($servico->max_min) }}</td>
						<td>{{ Servico::retorna_prioridade(e($servico->prioridade)) }}</td>
						<td>{{ e($servico->categoria) }}</td>
						<td>{{ e( ($servico->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('servico/' . $servico->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('servico/' . $servico->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'servico/' . $servico->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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