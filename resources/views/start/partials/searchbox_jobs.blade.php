<div id="search">
	<h3 class="heading-underlined--small">Stellen in Ihrer Stadt</h3>
	<div>
		{!! Form::open(['url' => route('jobs'), 'method' => 'GET']) !!}
		<div class="input-group input-group-sm">
			@if(Input::has('typ'))
				{!! Form::hidden('typ', Input::get('typ')) !!}
			@endif
			{!! Form::text('stadt', Input::get('stadt'), ['class' => 'form-control input-sm', 'placeholder' => 'Stadt']) !!}
			<span class="input-group-btn">
				<button class="btn btn-primary btn-sm" type="submit">Suchen</button>
			</span>
		</div>
		{!! Form::close() !!}
	</div>
	<div id="cloud">
		@if(Request::has('typ'))
			<a {{ set_active('*in/frankfurt*') }} href="{{ URL::route('jobsIn', ['frankfurt', 'typ' => Request::get('typ')]) }}" style="left: 146px; top: 29px;">frankfurt</a>
			<a {{ set_active('*in/leipzig*') }} href="{{ URL::route('jobsIn', ['leipzig', 'typ' => Request::get('typ')]) }}" style="left: 26px; top: 11px;">leipzig</a>
			<a {{ set_active('*in/stuttgart*') }} href="{{ URL::route('jobsIn', ['stuttgart', 'typ' => Request::get('typ')]) }}" style="left: 138px; top: 66px;">stuttgart</a>
			<a {{ set_active('*in/münchen*') }} href="{{ URL::route('jobsIn', ['münchen', 'typ' => Request::get('typ')]) }}" style="font-size:18px; left: 88px; top: 7px;">münchen</a>
			<a {{ set_active('*in/berlin*') }} href="{{ URL::route('jobsIn', ['berlin', 'typ' => Request::get('typ')]) }}" style="font-size:18px; left: 71px; top: 29px;">berlin</a>
			<a {{ set_active('*in/hamburg*') }} href="{{ URL::route('jobsIn', ['hamburg', 'typ' => Request::get('typ')]) }}" style="font-size:18px; left: 24px; top: 74px;">hamburg</a>
			<a {{ set_active('*in/köln*') }} href="{{ URL::route('jobsIn', ['köln', 'typ' => Request::get('typ')]) }}" style="font-size:18px; left: 117px; top: 46px;">köln</a>
			<a {{ set_active('*in/aachen*') }} href="{{ URL::route('jobsIn', ['aachen', 'typ' => Request::get('typ')]) }}" style="left: 33px; top: 55px;">aachen</a>
			<a {{ set_active('*in/dortmund*') }} href="{{ URL::route('jobsIn', ['dortmund', 'typ' => Request::get('typ')]) }}" style="left: 108px; top: 85px;">dortmund</a>
			<a {{ set_active('*in/dresden*') }} href="{{ URL::route('jobsIn', ['dresden', 'typ' => Request::get('typ')]) }}" style="left: 8px; top: 35px;">dresden</a>
			<a {{ set_active('*in/düsseldorf*') }} href="{{ URL::route('jobsIn', ['düsseldorf', 'typ' => Request::get('typ')]) }}" style="left: 31px; top: 95px;">düsseldorf</a>
		@else
			<a {{ set_active('*in/frankfurt*') }} href="{{ URL::route('jobsIn', ['frankfurt']) }}" style="left: 146px; top: 29px;">frankfurt</a>
			<a {{ set_active('*in/leipzig*') }} href="{{ URL::route('jobsIn', ['leipzig']) }}" style="left: 26px; top: 11px;">leipzig</a>
			<a {{ set_active('*in/stuttgart*') }} href="{{ URL::route('jobsIn', ['stuttgart']) }}" style="left: 138px; top: 66px;">stuttgart</a>
			<a {{ set_active('*in/münchen*') }} href="{{ URL::route('jobsIn', ['münchen']) }}" class="emphasized" style="left: 88px; top: 7px;">münchen</a>
			<a {{ set_active('*in/berlin*') }} href="{{ URL::route('jobsIn', ['berlin']) }}" class="emphasized" style="left: 71px; top: 29px;">berlin</a>
			<a {{ set_active('*in/hamburg*') }} href="{{ URL::route('jobsIn', ['hamburg']) }}" class="emphasized" style="left: 24px; top: 74px;">hamburg</a>
			<a {{ set_active('*in/köln*') }} href="{{ URL::route('jobsIn', ['köln']) }}" class="emphasized" style="left: 117px; top: 46px;">köln</a>
			<a {{ set_active('*in/aachen*') }} href="{{ URL::route('jobsIn', ['aachen']) }}" style="left: 33px; top: 55px;">aachen</a>
			<a {{ set_active('*in/dortmund*') }} href="{{ URL::route('jobsIn', ['dortmund']) }}" style="left: 108px; top: 85px;">dortmund</a>
			<a {{ set_active('*in/dresden*') }} href="{{ URL::route('jobsIn', ['dresden']) }}" style="left: 8px; top: 35px;">dresden</a>
			<a {{ set_active('*in/düsseldorf*') }} href="{{ URL::route('jobsIn', ['düsseldorf']) }}" style="left: 31px; top: 95px;">düsseldorf</a>
		@endif
	</div>
</div>
<br>

