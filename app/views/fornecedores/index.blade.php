@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de fornecedores
		<a href="{{ URL::to('fornecedor/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'fornecedor', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('nome_razao_social', $nome_razao_social, array('placeholder' => 'Nome/Razão Social', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('apelido_nome_fantasia', $apelido_nome_fantasia, array('placeholder' => 'Apelido/Nome fantasia', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($fornecedores->getItems())
		Exibindo de {{ $fornecedores->getFrom() }} até {{ $fornecedores->getTo() }} de {{ $fornecedores->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('fornecedor?sort=nome_razao_social' . $str) }}">Nome/Razão Social</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=apelido_nome_fantasia' . $str) }}">Apelido/Nome fantasia</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=cnpj' . $str) }}">CNPJ</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=cpf' . $str) }}">CPF</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=cidade' . $str) }}">Cidade</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=uf' . $str) }}">UF</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=tel_1' . $str) }}">Telefone</a></th>
					<th><a href="{{ URL::to('fornecedor?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($fornecedores as $fornecedor)
					<tr>
						<td>{{ e($fornecedor->nome_razao_social) }}</td>
						<td>{{ e($fornecedor->apelido_nome_fantasia) }}</td>
						<td>{{ Util::mask(e($fornecedor->cnpj), "##.###.###/####-##") }}</td>
						<td>{{ Util::mask(e($fornecedor->cpf), "###.###.###-##") }}</td>
						<td>{{ e($fornecedor->cidade) }}</td>
						<td>{{ e($fornecedor->uf) }}</td>
						<td>{{ Util::mask(e($fornecedor->tel_1), "(##) ####-####") }}</td>
						<td>{{ e( ($fornecedor->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('fornecedor/' . $fornecedor->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('fornecedor/' . $fornecedor->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'fornecedor/' . $fornecedor->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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