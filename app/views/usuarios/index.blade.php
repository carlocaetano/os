@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de usuários
		<a href="{{ URL::to('usuario/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'usuario', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('nome', $nome, array('placeholder' => 'Nome', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('perfil', $perfil, array('placeholder' => 'Perfil', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($usuarios->getItems())
		Exibindo de {{ $usuarios->getFrom() }} até {{ $usuarios->getTo() }} de {{ $usuarios->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('usuario?sort=nome' . $str) }}">Nome</a></th>
					<th><a href="{{ URL::to('usuario?sort=username' . $str) }}">Usuario</a></th>
					<th><a href="{{ URL::to('usuario?sort=email' . $str) }}">E-mail</a></th>
					<th><a href="{{ URL::to('usuario?sort=perfil' . $str) }}">Perfil</a></th>
					<th><a href="{{ URL::to('usuario?sort=ativo' . $str) }}">Ativo</a></th>
					<th><a href="{{ URL::to('usuario?sort=created_at' . $str) }}">Criado</a></th>
					<th><a href="{{ URL::to('usuario?sort=updated_at' . $str) }}">Modificado</a></th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($usuarios as $usuario)
					<tr>
						<td>{{ e($usuario->nome) }}</td>
						<td>{{ e($usuario->username) }}</td>
						<td>{{ $usuario->email }}</td>
						<td>{{ e($usuario->perfil) }}</td>
						<td>{{ $usuario->ativo ? 'Sim' : 'Não' }}</td>
						<td>{{ Util::toTimestamps($usuario->created_at) }}</td>
						<td>{{ Util::toTimestamps($usuario->updated_at) }}</td>
						<td class="action">{{ link_to('usuario/' . $usuario->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'usuario/' . $usuario->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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