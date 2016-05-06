@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<div class="span2 alpha">
		@include('admin.dashboard.news.nav_bar')
	</div>	
	<div class="span7">
		<h3>Neue Messen</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Vorgeschlagen von</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($events as $event)
					<tr>
						<td>{{ $event->name }}</td>
						<td>{{ $event->requestedBy->username }}</td>
						<td>
							{!! HTML::imageLink('admin/events/'.$event->id.'/show', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="span3 omega">
		&nbsp;
	</div>
@stop