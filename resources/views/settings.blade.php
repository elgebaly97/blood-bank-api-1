{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('logo', 'Logo:') !!}
			{!! Form::text('logo') !!}
		</li>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('mobile', 'Mobile:') !!}
			{!! Form::text('mobile') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('facebook', 'Facebook:') !!}
			{!! Form::text('facebook') !!}
		</li>
		<li>
			{!! Form::label('twitter', 'Twitter:') !!}
			{!! Form::text('twitter') !!}
		</li>
		<li>
			{!! Form::label('gmail', 'Gmail:') !!}
			{!! Form::text('gmail') !!}
		</li>
		<li>
			{!! Form::label('instagram', 'Instagram:') !!}
			{!! Form::text('instagram') !!}
		</li>
		<li>
			{!! Form::label('youtube', 'Youtube:') !!}
			{!! Form::text('youtube') !!}
		</li>
		<li>
			{!! Form::label('whatsapp', 'Whatsapp:') !!}
			{!! Form::text('whatsapp') !!}
		</li>
		<li>
			{!! Form::label('about', 'About:') !!}
			{!! Form::textarea('about') !!}
		</li>
		<li>
			{!! Form::label('app_url', 'App_url:') !!}
			{!! Form::text('app_url') !!}
		</li>
		<li>
			{!! Form::label('android_url', 'Android_url:') !!}
			{!! Form::text('android_url') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}