{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('client_id', 'Client_id:') !!}
			{!! Form::text('client_id') !!}
		</li>
		<li>
			{!! Form::label('notification_id', 'Notification_id:') !!}
			{!! Form::text('notification_id') !!}
		</li>
		<li>
			{!! Form::label('is_read', 'Is_read:') !!}
			{!! Form::text('is_read') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}