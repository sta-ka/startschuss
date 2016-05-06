<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('admin/jobs/'.$job->id.'/show', 'Stellenangebot anzeigen') !!}
		</li>
		<li {{ set_active('*edit-data*') }} >
			{!! HTML::link('admin/jobs/'.$job->id.'/edit-data', 'Daten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-seo-data*') }} >
			{!! HTML::link('admin/jobs/'.$job->id.'/edit-seo-data', 'Metadaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-settings*') }} >
			{!! HTML::link('admin/jobs/'.$job->id.'/edit-settings', 'Einstellungen bearbeiten') !!}
		</li>
	</ul>
</div>