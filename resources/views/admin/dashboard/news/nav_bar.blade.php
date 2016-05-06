<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Statistik</h3></li>
		<li {{ set_active('*logged-data*') }} >
			{!! HTML::link('admin/dashboard/logged-data', 'Ereignisse') !!}
		<li {{ set_active('*requested-events*') }} >
			{!! HTML::link('admin/dashboard/requested-events', 'Neue Messen') !!}
		</li>
	</ul>
</div>