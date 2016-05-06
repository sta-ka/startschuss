<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Statistik</h3></li>
		<li {{ set_active('*logins*') }} >
			{!! HTML::link('admin/dashboard/logins', 'Logins') !!}
		<li {{ set_active('*login-attempts*') }} >
			{!! HTML::link('admin/dashboard/login-attempts', 'Loginversuche') !!}
		</li>
		<li {{ set_active('*searches*') }} >
			{!! HTML::link('admin/dashboard/searches', 'Suchanfragen') !!}
		</li>
	</ul>
</div>