{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('client_id', 'Client_id:') !!}
			{!! Form::text('client_id') !!}
		</li>
		<li>
			{!! Form::label('government_id', 'Government_id:') !!}
			{!! Form::text('government_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}