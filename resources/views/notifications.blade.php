{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('order_id', 'Order_id:') !!}
			{!! Form::text('order_id') !!}
		</li>
		<li>
			{!! Form::label('content', 'Content:') !!}
			{!! Form::text('content') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}