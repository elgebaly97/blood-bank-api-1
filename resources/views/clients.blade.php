{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::textarea('email') !!}
		</li>
		<li>
			{!! Form::label('birthday', 'Birthday:') !!}
			{!! Form::text('birthday') !!}
		</li>
		<li>
			{!! Form::label('blood_type_id', 'Blood_type_id:') !!}
			{!! Form::text('blood_type_id') !!}
		</li>
		<li>
			{!! Form::label('last_donate', 'Last_donate:') !!}
			{!! Form::text('last_donate') !!}
		</li>
		<li>
			{!! Form::label('city_id', 'City_id:') !!}
			{!! Form::text('city_id') !!}
		</li>
		<li>
			{!! Form::label('mobile', 'Mobile:') !!}
			{!! Form::text('mobile') !!}
		</li>
		<li>
			{!! Form::label('password', 'Password:') !!}
			{!! Form::text('password') !!}
		</li>
		<li>
			{!! Form::label('banned', 'Banned:') !!}
			{!! Form::text('banned') !!}
		</li>
		<li>
			{!! Form::label('pin', 'Pin:') !!}
			{!! Form::text('pin') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}