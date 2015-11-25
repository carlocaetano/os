@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de categorias de materiais
		<a href="{{ URL::to('categorias_mat/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'categorias_mat', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group .control-success">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($categorias->getItems())
		Exibindo de {{ $categorias->getFrom() }} até {{ $categorias->getTo() }} de {{ $categorias->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('categorias_mat?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('categorias_mat?sort=ativo' . $str) }}">Ativo</a></th>
					<th><a href="{{ URL::to('categorias_mat?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('categorias_mat?sort=updated_at' . $str) }}">Modificado</a></th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categorias as $categoria)
					<tr>
						<td>{{ e($categoria->descricao) }}</td>
						<td>{{ $categoria->ativo ? 'Sim' : 'Não' }}</td>
						<td>{{ Util::toTimestamps($categoria->created_at) }}</td>
						<td>{{ Util::toTimestamps($categoria->updated_at) }}</td>
						<td class="action">{{ link_to('categorias_mat/' . $categoria->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'categorias_mat/' . $categoria->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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