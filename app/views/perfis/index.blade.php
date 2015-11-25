@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de perfis
		<a href="{{ URL::to('perfil/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'perfil', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($perfis->getItems())
		Exibindo de {{ $perfis->getFrom() }} até {{ $perfis->getTo() }} de {{ $perfis->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('perfil?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('perfil?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('perfil?sort=updated_at' . $str) }}">Modificado</a></th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($perfis as $perfil)
					<tr>
						<td>{{ e($perfil->descricao) }}</td>
						<td>{{ Util::toTimestamps($perfil->created_at) }}</td>
						<td>{{ Util::toTimestamps($perfil->updated_at) }}</td>
						<td class="action">{{ link_to('perfil/' . $perfil->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'perfil/' . $perfil->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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