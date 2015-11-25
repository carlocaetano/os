@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de localização de equipamentos
		<a href="{{ URL::to('localizacao/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'localizacao', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group .control-success">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($localizacoes->getItems())
		Exibindo de {{ $localizacoes->getFrom() }} até {{ $localizacoes->getTo() }} de {{ $localizacoes->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('localizacao?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('localizacao?sort=ativo' . $str) }}">Ativo</a></th>
					<th><a href="{{ URL::to('localizacao?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('localizacao?sort=updated_at' . $str) }}">Modificado</a></th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($localizacoes as $localizacao)
					<tr>
						<td>{{ e($localizacao->descricao) }}</td>
						<td>{{ $localizacao->ativo ? 'Sim' : 'Não' }}</td>
						<td>{{ Util::toTimestamps($localizacao->created_at) }}</td>
						<td>{{ Util::toTimestamps($localizacao->updated_at) }}</td>
						<td class="action">{{ link_to('localizacao/' . $localizacao->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'localizacao/' . $localizacao->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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