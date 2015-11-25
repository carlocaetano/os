@extends('layouts.admin')

@section('content')
	<h4>
		<span class="glyphicon glyphicon-edit"></span> Alterar jornada de trabalho
		<a href="{{ URL::to('jornada') }}" class="btn btn-info navbar-right"><span class="glyphicon glyphicon-chevron-left"></span> Voltar</a>
	</h4>
	<hr>
	{{Form::open(array('url' => 'jornada/'. $jornada->id, 'method' => 'put', 'class' => 'form-horizontal row', 'role' => 'form'))}}
		
		<div class="col-md-2 {{ $errors->first('hr_inicial') ? 'has-error' : '' }}">
			{{ Form::label('hr_inicial', '* HORA INICIAL', array('class' => 'control-label')) }}
        	{{ Form::text('hr_inicial', Input::old('hr_inicial', $jornada->hr_inicial), array('data-mask' => '99:99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('hr_inicial', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('inter_hr_inicial') ? 'has-error' : '' }}">
			{{ Form::label('inter_hr_inicial', '* INTERVALO INICIAL', array('class' => 'control-label')) }}
        	{{ Form::text('inter_hr_inicial', Input::old('inter_hr_inicial', $jornada->inter_hr_inicial), array('data-mask' => '99:99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('inter_hr_inicial', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('inter_hr_final') ? 'has-error' : '' }}">
			{{ Form::label('inter_hr_final', '* INTERVALO FINAL', array('class' => 'control-label')) }}
        	{{ Form::text('inter_hr_final', Input::old('inter_hr_final', $jornada->inter_hr_final), array('data-mask' => '99:99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('inter_hr_final', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('hr_final') ? 'has-error' : '' }}">
			{{ Form::label('hr_final', '* HORA FINAL', array('class' => 'control-label')) }}
        	{{ Form::text('hr_final', Input::old('hr_final', $jornada->hr_final), array('data-mask' => '99:99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('hr_final', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('HR_TEMPO') ? 'has-error' : '' }}">
			{{ Form::label('HR_TEMPO', 'TEMPO', array('class' => 'control-label')) }}
        	{{ Form::text('HR_TEMPO', Input::old('HR_TEMPO', $jornada->HR_TEMPO), array('data-mask' => '99:99', 'class' => 'form-control', 'required')) }}
        	{{ $errors->first('HR_TEMPO', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-md-2 {{ $errors->first('situacao') ? 'has-error' : '' }}">
			{{ Form::label('situacao', '* Ativo', array('class' => 'control-label')) }}
        	{{ Form::select('situacao', array(0 => 'Não', 1 => 'Sim'), Input::old('situacao', $jornada->situacao), array('class' => 'form-control', 'required')) }}
        	{{ $errors->first('situacao', '<span class="text-danger">:message</span>') }}
		</div>

		<div class="col-btn">
			{{ Form::submit('Alterar', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
@stop