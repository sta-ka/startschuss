<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Jobs</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('company/jobs/'. $job->id .'/show', 'Übersicht') !!}
		</li>
	</ul>
</div>