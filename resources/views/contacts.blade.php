{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('mobile', 'Mobile:') !!}
			{!! Form::text('mobile') !!}
		</li>
		<li>
			{!! Form::label('subject', 'Subject:') !!}
			{!! Form::text('subject') !!}
		</li>
		<li>
			{!! Form::label('message', 'Message:') !!}
			{!! Form::textarea('message') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}