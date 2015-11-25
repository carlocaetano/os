@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de clientes
		<a href="{{ URL::to('cliente/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'cliente', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('razao_social', $razao_social, array('placeholder' => 'Nome/Razão Social', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('nome_fantasia', $nome_fantasia, array('placeholder' => 'Apelido/Nome fantasia', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($clientes->getItems())
		Exibindo de {{ $clientes->getFrom() }} até {{ $clientes->getTo() }} de {{ $clientes->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('cliente?sort=razao_social' . $str) }}">Nome/Razão Social</a></th>
					<th><a href="{{ URL::to('cliente?sort=nome_fantasia' . $str) }}">Apelido/Nome fantasia</a></th>
					<th><a href="{{ URL::to('cliente?sort=data_cadastro' . $str) }}">Data Cadastro</a></th>
					<th><a href="{{ URL::to('cliente?sort=cidade' . $str) }}">Cidade</a></th>
					<th><a href="{{ URL::to('cliente?sort=uf' . $str) }}">UF</a></th>
					<th><a href="{{ URL::to('cliente?sort=tel_1' . $str) }}">Telefone</a></th>
					<th><a href="{{ URL::to('cliente?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($clientes as $cliente)
					<tr>
						<td>{{ e($cliente->razao_social) }}</td>
						<td>{{ e($cliente->nome_fantasia) }}</td>
						<td>{{ e(Util::toView($cliente->data_cadastro)) }}</td>
						<td>{{ e($cliente->cidade) }}</td>
						<td>{{ e($cliente->uf) }}</td>
						<td>{{ Util::mask(e($cliente->tel_1), "(##) ####-####") }}</td>
						<td>{{ e( ($cliente->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('cliente/' . $cliente->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('cliente/' . $cliente->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'cliente/' . $cliente->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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