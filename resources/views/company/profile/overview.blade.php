@extends('layouts.company')

@section('title', 'Profil anzeigen')

@section('content')
	<div class="span2 alpha">
		&nbsp;
	</div>
	<div class="span7">
			@if($company)
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th width="100px">Aktion</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $company->name }}</td>
							<td>
								{!! HTML::imageLink('company/profile/'. $company->id .'/show', 'assets/img/icons/show.png', 'Anzeigen', ['title' => 'Anzeigen']) !!}
							</td>
						</tr>
					</tbody>
				</table>
			@else
				<p>Ihr Konto ist mit keinem Unternehmen verknüpft.</p>
			@endif
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop