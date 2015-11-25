@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-list-alt"></span> Listagem de jornadas de trabalho
		<a href="{{ URL::to('jornada/create') }}" class="btn btn-success navbar-right"><span class="glyphicon glyphicon-plus-sign"></span> Novo</a>
	</h4>
	<hr>
	{{ Form::open(array('url' => 'jornada', 'method' => 'get', 'class' => 'form-inline', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::text('hr_inicial', $hr_inicial, array('data-mask' => '99:99', 'placeholder' => 'HORA INICIAL', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::text('HR_TEMPO', $HR_TEMPO, array('data-mask' => '99:99', 'placeholder' => 'TEMPO', 'class' => 'form-control')) }}
		</div>
		{{ Form::button('<span class="glyphicon glyphicon-search"></span> Pesquisar', array('type' => 'submit', 'class' => 'btn btn-default')) }}
	{{ Form::close() }}
	<hr>
	@if($jornadas->getItems())
		Exibindo de {{ $jornadas->getFrom() }} até {{ $jornadas->getTo() }} de {{ $jornadas->getTotal() }} registros.
		<hr>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><a href="{{ URL::to('jornada?sort=hr_inicial' . $str) }}">Hora Inicial</a></th>
					<th><a href="{{ URL::to('jornada?sort=inter_hr_inicial' . $str) }}">Intervalo Inicial</a></th>
					<th><a href="{{ URL::to('jornada?sort=inter_hr_final' . $str) }}">Intervalo Final</a></th>
					<th><a href="{{ URL::to('jornada?sort=hr_final' . $str) }}">Hora Final</a></th>
					<th><a href="{{ URL::to('jornada?sort=HR_TEMPO' . $str) }}">Tempo</a></th>
					<th><a href="{{ URL::to('jornada?sort=situacao' . $str) }}">Situação</a></th>

					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($jornadas as $jornada)
					<tr>
						<td>{{ Util::hora_toView($jornada->hr_inicial) }}</td>
						<td>{{ Util::hora_toView($jornada->inter_hr_inicial) }}</td>
						<td>{{ Util::hora_toView($jornada->inter_hr_final) }}</td>
						<td>{{ Util::hora_toView($jornada->hr_final) }}</td>
						<td>{{ Util::hora_toView($jornada->HR_TEMPO) }}</td>
						<td>{{ $jornada->situacao ? 'Sim' : 'Não' }}</td>
						<td class="action">{{ link_to('jornada/' . $jornada->id . '/edit', 'Editar', array('class' => 'btn btn-primary btn-sm', 'title' => 'Editar')) }}</td>
						<td class="action">
							{{ Form::open(array('url' => 'jornada/' . $jornada->id, 'method' => 'delete', 'data-confirm' => 'Deseja realmente excluir o registro selecionado?')) }}
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