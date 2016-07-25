@extends('layouts.admin')

@section('title', 'Alle Städte anzeigen')

@section('content')
	<div class="span3 alpha">
		&nbsp;
	</div>
	<div class="span5">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th width="100px">Aktion</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cities as $city)
					<tr>
						<td>
							{{ $city->id }}
						</td>
						<td>
							{{ $city->name }}
						</td>
						<td>
							{!! HTML::imageLink('admin/cities/'. $city->id .'/edit', 'assets/img/icons/page_edit.png', 'Bearbeiten', ['title' => 'Bearbeiten']) !!}
							{!! HTML::imageLink('jobmessen/in/'. $city->slug, 'assets/img/icons/show.png', 'Anzeigen', ['target' => '_blank', 'title' => 'Anzeigen']) !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="span4 omega">
		&nbsp;
	</div>	
@stop

