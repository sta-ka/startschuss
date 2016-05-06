@extends('layouts.admin')

@section('title', 'Alle Regionen anzeigen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span6">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($regions as $region)
					<tr>
						<td>{{ $region->id }}</td>
						<td>{{ $region->name }}</td>
						<td>
							{!! HTML::imageLink('admin/regions/'.$region->id.'/edit', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							{!! HTML::imageLink('jobmessen/'.$region->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
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

