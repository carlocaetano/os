@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de funcionários
		<a href="{{ URL::to('funcionario/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'funcionario', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		
		<div class="form-group col-sm-2">
			{{ Form::text('matricula', $matricula, array('placeholder' => 'Matrícula', 'class' => 'form-control')) }}
		</div>

		<div class="form-group col-sm-2">
			{{ Form::text('nome', $nome, array('placeholder' => 'Nome', 'class' => 'form-control')) }}
		</div>
		
		<div class="form-group col-sm-2">
			<div class="input-group date">
		        {{ Form::text('data_nascimento', '', array('placeholder' => 'Data de nascimento', 'data-mask' => '99/99/9999', 'class' => 'form-control')) }}
		        	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		    </div>
		</div>

		<div class="form-group">
			{{ Form::text('cpf', $cpf, array('placeholder' => 'CPF', 'data-mask' => '999.999.999-99', 'class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::select('funcao_id', Funcao::options(), $funcao_id, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::select('ativo', array("" => 'Tudo', 1 => 'Sim', 0 => 'Não'), $ativo, array('class' => 'form-control')) }}
		</div>

		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}

	{{ Form::close() }}
	<hr>
	@if($funcionarios->getItems())
		Exibindo de {{ $funcionarios->getFrom() }} até {{ $funcionarios->getTo() }} de {{ $funcionarios->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('funcionario?sort=nome' . $str) }}">Nome</a></th>
					<th><a href="{{ URL::to('funcionario?sort=data_nascimento' . $str) }}">Data de Nascimento</a></th>
					<th><a href="{{ URL::to('funcionario?sort=matricula' . $str) }}">Matrícula</a></th>
					<th><a href="{{ URL::to('funcionario?sort=cpf' . $str) }}">CPF</a></th>
					<th><a href="{{ URL::to('funcionario?sort=funcao_id' . $str) }}">Função</a></th>
					<th><a href="{{ URL::to('funcionario?sort=ativo' . $str) }}">Ativo</a></th>
					<th colspan="3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($funcionarios as $funcionario)
					<tr>
						<td>{{ e($funcionario->nome) }}</td>
						<td>{{ e(Util::toView($funcionario->data_nascimento)) }}</td>
						<td>{{ e($funcionario->matricula) }}</td>
						<td>{{ Util::mask(e($funcionario->cpf), "###.###.###-##") }}</td>
						<td>{{ e($funcionario->funcao) }}</td>
						<td>{{ e( ($funcionario->ativo ? 'SIM' : 'NÃO') ) }}</td>

						<td class="action">{{ link_to('funcionario/' . $funcionario->id, 'Detalhar', array('class' => 'btn btn-info btn-sm', 'title' => 'Detalhar')) }}</td>
						<td class="action">{{ link_to('funcionario/' . $funcionario->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'funcionario/' . $funcionario->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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