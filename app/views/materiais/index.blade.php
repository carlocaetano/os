@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de materiais
		<a href="{{ URL::to('material/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'material', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('descricao', $descricao, array('placeholder' => 'Descrição', 'class' => 'form-control')) }}
		</div>
		
		<div class="form-group">
			{{ Form::text('fabricante_marca', $fabricante_marca, array('placeholder' => 'Fabricante/marca', 'class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::select('situacao', Material::situacao_mat(), $situacao, array('class' => 'form-control')) }}
		</div>

		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($materiais->getItems())
		Exibindo de {{ $materiais->getFrom() }} até {{ $materiais->getTo() }} de {{ $materiais->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('materiais?sort=descricao' . $str) }}">Descrição</a></th>
					<th><a href="{{ URL::to('materiais?sort=fabricante_marca' . $str) }}">Fabricante</a></th>
					<th><a href="{{ URL::to('materiais?sort=unidade' . $str) }}">Unidade</a></th>
					<th><a href="{{ URL::to('materiais?sort=qtde' . $str) }}">Quantidade</a></th>
					<th><a href="{{ URL::to('materiais?sort=situacao' . $str) }}">Situação</a></th>
					<th><a href="{{ URL::to('materiais?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($materiais as $material)
					<tr>
						<td>{{ e($material->descricao) }}</td>
						<td>{{ e($material->fabricante_marca) }}</td>
						<td>{{ Material::retorna_unidade_mat(e($material->unidade)) }}</td>
						<td>{{ e($material->qtde) }}</td>
						<td>{{ Material::retorna_situacao_mat(e($material->situacao)) }}</td>
						<td>{{ e( ($material->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('material/' . $material->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('material/' . $material->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'material/' . $material->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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