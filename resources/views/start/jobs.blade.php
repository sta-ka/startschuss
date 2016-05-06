@extends('layouts.default')

@section('title', 'Jobs, Praktika und mehr')

@section('metadata')
	<meta name='description' content='Stellenangebote, Praktika und weitere Angebote finden Sie auf startschuss-karriere.de.' />
	<meta name='keywords' content='karriere, stellenangebote, praktika' />
    {!! renderPaginationMetaData($jobs) !!}
@stop

@section('content')
	<div class="span9 alpha">
		@if(Input::has('stadt')) 
			<div id="search-results">
				@if($jobs->total() > 0)
					<div class="alert alert-success">
						<h4 class="alert-heading">Erfolg!</h4>
						Ihre Suche ergab <strong>{{ $jobs->total() }}</strong> Treffer!
					</div>
				@else
					<div class="alert alert-danger">
						<h4 class="alert-heading">Keine Treffer!</h4>
						Ihre Suche ergab keine Treffer!
						<br><br>
						{!! HTML::linkRoute('jobs', 'Alle Stellen anzeigen') !!}
				</div>
				@endif
			</div>
		@elseif($jobs->total() == 0)
			<div id="search-results">
				<div class="alert alert-danger">
					Für Ihre Anfrage gibt es keine Treffer!
					<br><br>
					{!! HTML::linkRoute('jobs', 'Alle Stellen anzeigen') !!}
				</div>
			</div>		
		@endif
			
		@if(count($jobs) > 0) 
			<div id="jobs">
				<h1 class="heading-underlined">Jobs, Praktika und mehr</h1>
				<ul class="list-unstyled">
				@foreach($jobs as $job)
					<li>
						<table>
							<tr>
								<td rowspan="2" width="100px" height="50px" class="logo">
									@if($job->company->logo)
										{!! HTML::image('uploads/logos/medium/'.$job->company->logo, $job->company->full_name) !!}
									@endif
								</td>
								<td colspan="3" width="400px">
									<span class="name">{!! HTML::linkRoute('job', $job->title, [$job->id, $job->slug]) !!}</span>
								</td>
								<td width="130px">
									{{ $job->location }}
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<strong>Unternehmen: </strong>{!! HTML::linkRoute('unternehmen', $job->company->name, [$job->company->slug]) !!}
								</td>
							</tr>
						</table>
					</li>
				@endforeach
				</ul>
				@if($jobs->lastPage() <= 1)
					<div class="pull-right">
						<p>{!! HTML::linkRoute('jobs', 'Alle Stellen anzeigen', [], ['class' => 'green']) !!}</p>
					</div>
				@endif

				{!! $jobs->setPath('')->appends(Request::except('page'))->render(new \App\Services\Pagination\CustomPresenter($jobs)) !!}
			</div>

		@endif
	</div>

	<div class="span3 omega">
		
		@include('start.partials.searchbox_jobs')

		<div id="job-type-search">
			<h3 class="heading-underlined--small">Angebote für</h3>
			<ul class="list-unstyled">
				<li {{ Request::get('typ') == 'Vollzeit' ? 'class=active' : null }} >
					{!! HTML::linkRoute('jobs', 'Vollzeit', ['stadt' => Request::get('stadt'), 'typ' => 'Vollzeit']) !!}
				</li>
				<li {{ Request::get('typ') == 'Teilzeit' ? 'class=active' : null }} >
					{!! HTML::linkRoute('jobs', 'Teilzeit', ['stadt' => Request::get('stadt'), 'typ' => 'Teilzeit']) !!}
				</li>
				<li {{ Request::get('typ') == 'Praktikum' ? 'class=active' : null }} >
					{!! HTML::linkRoute('jobs', 'Praktikum', ['stadt' => Request::get('stadt'), 'typ' => 'Praktikum']) !!}
				</li>
				<li {{ Request::get('typ') == 'Werkstudent' ? 'class=active' : null }} >
					{!! HTML::linkRoute('jobs', 'Werkstudent', ['stadt' => Request::get('stadt'), 'typ' => 'Werkstudent']) !!}
				</li>
				<li {{ Request::get('typ') == 'Abschlussarbeit' ? 'class=active' : null }} >
					{!! HTML::linkRoute('jobs', 'Abschlussarbeit', ['stadt' => Request::get('stadt'), 'typ' => 'Abschlussarbeit']) !!}
				</li>
			</ul>
		</div>

	</div>
@stop