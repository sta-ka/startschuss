<div id="search">
	<h3 class="heading-underlined--small">Messen in Ihrer Stadt</h3>
	<div>
		{!! Form::open(['url' => 'jobmessekalender', 'method' => 'GET']) !!}
		<div class="input-group input-group-sm">
			{!! Form::text('stadt', Input::get('stadt'), ['class' => 'form-control input-sm', 'placeholder' => 'Veranstaltungsort']) !!}
			<span class="input-group-btn">
				<button class="btn btn-primary btn-sm" type="submit">Suchen</button>
			</span>
		</div>
		{!! Form::close() !!}
	</div>
	<div id="cloud">
		<a {{ set_active('*/in/frankfurt*') }} href="{{ url('jobmessen/in/frankfurt') }}" style="left: 146px; top: 29px;">frankfurt</a>
		<a {{ set_active('*/in/leipzig*') }} href="{{ url('jobmessen/in/leipzig') }}" style="left: 26px; top: 11px;">leipzig</a>
		<a {{ set_active('*/in/stuttgart*') }} href="{{ url('jobmessen/in/stuttgart') }}" style="left: 138px; top: 66px;">stuttgart</a>
		<a {{ set_active('*/in/münchen*') }} href="{{ url('jobmessen/in/münchen') }}" style="font-size: 18px; left: 88px; top: 7px;">münchen</a>
		<a {{ set_active('*/in/berlin*') }} href="{{ url('jobmessen/in/berlin') }}" style="font-size: 18px; left: 71px; top: 29px;">berlin</a>
		<a {{ set_active('*/in/hamburg*') }} href="{{ url('jobmessen/in/hamburg') }}" style="font-size: 18px; left: 24px; top: 74px;">hamburg</a>
		<a {{ set_active('*/in/köln*') }} href="{{ url('jobmessen/in/köln') }}" style="font-size: 18px; left: 117px; top: 46px;">köln</a>
		<a {{ set_active('*/in/aachen*') }} href="{{ url('jobmessen/in/aachen') }}" style="left: 33px; top: 55px;">aachen</a>
		<a {{ set_active('*/in/dortmund*') }} href="{{ url('jobmessen/in/dortmund') }}" style="left: 108px; top: 85px;">dortmund</a>
		<a {{ set_active('*/in/dresden*') }} href="{{ url('jobmessen/in/dresden') }}" style="left: 8px; top: 35px;">dresden</a>
		<a {{ set_active('*/in/düsseldorf*') }} href="{{ url('jobmessen/in/düsseldorf') }}" style="left: 31px; top: 95px;">düsseldorf</a>
		<a {{ set_active('*/in/wien*') }} href="{{ url('jobmessen/in/wien') }}" style="left: 115px; top: 103px;">wien</a>
	</div>
</div>
<br>

