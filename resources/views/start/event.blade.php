@extends('layouts.default')

@section('title', 'Jobmesse: '. $event->name)

@section('metadata')
	<meta name='description' content='{{ $event->meta_description }}' />
	<meta name='keywords' content='{{ $event->keywords }}' />
@stop

@section('scripts')
	<script type="text/javascript">
		function tabs(pages)
		{
			[].forEach.call(pages, function(item) {
				item.classList.add('dyn-tabs'); // add class to all tabs
			}, false);

			pages[0].style.display = 'block'; // display first page

			// create ul element and insert it before the first page
			var ul = document.createElement('ul');
            ul.className = 'list-unstyled';
			var tabNavigation = document.querySelector('#event').insertBefore(ul, pages[0]);

            // create li element for each page
			[].forEach.call(pages, function(page){

					var listElement = document.createElement('li');
					listElement.innerHTML = page.getAttribute('data-title');

					tabNavigation.appendChild(listElement);

				}, false);
			
			var items = tabNavigation.getElementsByTagName('li');
			items[0].classList.add('current');

			[].forEach.call(items, function(item) {

				item.addEventListener('click', function() {

					[].forEach.call( items, function(item) {
						item.classList.remove('current');

						var index = getIndex(item);
						
						pages[index].style.display = 'none';

					}, false);

					var index = getIndex(item); // get index of node

					item.classList.add('current');
					fadeIn(pages[index]);

				}, false);
			});
		}

		function fadeIn(element) {

			var op = 0;  // initial opacity

			// display element, but set opacity to 0
			element.style.display = 'block';
			element.style.opacity = op;

			var timer = setInterval(function () {

				if (op >= 0.9) {
					clearInterval(timer);
					element.style.display = 'block';
				}

				element.style.opacity = op;
				element.style.filter = 'alpha(opacity=' + op * 100 + ')';
				op += 0.1;

			}, 70);
		}

		function getIndex(node) {
			
			var i = 0;

			while (node = node.previousSibling) {
				if (node.nodeType === 1) { ++i }
			}
			return i;
		}

		document.addEventListener('DOMContentLoaded', function() {
			tabs(document.querySelectorAll('div.tabs'));
		});
	</script>	
@stop

@section('content')
	<div class="span9 alpha">
		<div id="event" itemscope itemtype="http://schema.org/Event">
			<h1 itemprop="name" class="heading-underlined">{{ $event->name }}</h1>
			<meta itemprop="description" content="Jobmesse">

			<div id="information">
				<div class="span3 alpha">
					<strong>Datum:</strong><br>
					@if($event->start_date == $event->end_date)
						<span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
							{{ Date::monthDate($event->start_date, $event->end_date, false) .' '. Date::format($event->end_date, 'year') }}
						</span>
					@else
						<span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
							{{ Date::format($event->start_date, 'day').'. -' }}
						</span>
						<span itemprop="endDate" content="{{ Date::format($event->end_date, 'ISO')}}">
							{{ Date::german($event->end_date, false) }}
						</span>
					@endif
					
					
					@if($event->opening_hours1 || $event->opening_hours2)
						<br>
						<strong>Öffnungszeiten:</strong><br>
						@if($event->opening_hours1)
							{{ $event->opening_hours1 }}<br>
						@endif
						@if($event->opening_hours2)
							{{ $event->opening_hours2 }}
						@endif
					@endif
				</div>
				<div class="span3" itemprop="location" itemscope itemtype="http://schema.org/Place">
					<strong>Veranstaltungort:</strong><br>
					<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span  itemprop="addressLocality"content="{{ $event->location }}">
							{{ $event->location }}<br>
						</span>
						<meta itemprop="addressRegion"content="{{ $event->region->name }}">
					</div>
					@if($event->specific_location1 || $event->specific_location2 || $event->specific_location3)
						@if($event->specific_location1)
							<address>{{ $event->specific_location1 }}</address><br>
						@endif
						@if($event->specific_location2)
							<address>{{ $event->specific_location2 }}</address><br>
						@endif
						@if($event->specific_location3)
							<address>{{ $event->specific_location3 }}</address><br>
						@endif
					@endif
				</div>
				<div class="span3 omega">
					@if($event->admission)
						<strong>Eintritt:</strong><br>
						{{ $event->admission }}<br><br>
					@endif
					@if($event->audience)
						<strong>Fachbereiche:</strong><br>
						{{ $event->audience }}
					@endif
				</div>
			</div>

			<div id="profile" class="tabs" data-title="Profil">
				@if($event->profile)
					<p>{!! $event->profile !!}</p>
				@else
					<p>Noch kein Profil hinterlegt.</p>
				@endif
			</div>

			@if($event->program)
				<div id="program" class="tabs" data-title="Programm">
					<p>{!! $event->program !!}</p>
				</div>			
			@endif

			@if($companies->count())
				<div id="participants" class="tabs" data-title="Teilnehmer">
					<h2 class="heading-underlined">Teilnehmende Unternehmen</h2>

					<ul class="list-unstyled">
					@foreach($companies as $company)
						<li>
							@if($company->logo)
								<div class="image">
									{!! HTML::image('uploads/logos/medium/'.$company->logo, $company->name, ['title' => $company->full_name]) !!}
								</div>
							@else
								<div class="text" title="{{ $company->full_name }}">{{ $company->name }}</div>
							@endif
						</li>
					@endforeach
					</ul>				
				</div>
			@endif

			<?php $interview = false ?>

			@foreach($companies as $company)
				@if($company->pivot->interview)
					<?php $interview = true; exit; ?>
				@endif
			@endforeach

			@if($companies->count() && $event->interviews && $interview)
				<div class="tabs" data-title="Einzelgespräche">
					<p>
						Auf dieser Jobmesse gibt es die Möglichkeit mit ausgewählten Unternehmen terminierte Einzelgespräche zu führen.
						Für die Teilnahme an einem oder mehreren Einzelgesprächen ist eine Bewerbung im Vorfeld der Messe erforderlich.
					</p>
					@if ($user = Sentry::getUser())
                        @if ($user->inGroup(Sentry::findGroupByName('Applicant'))  && ! $event->applications_closed)
                            <p>
                                {!! HTML::link('applicant/applications/event/' . $event->id, 'Jetzt Bewerben', ['class' => 'green']) !!}
                            </p>
                        @endif
					@endif
					<br>
					<div id="interviews">
						<h2 class="heading-underlined">Unternehmen</h2>
						<ul class="list-unstyled">
						@foreach($companies as $company)
							@if($company->pivot->interview)
								<li>
									@if($company->logo)
										<div class="image">
											{!! HTML::image('uploads/logos/medium/'.$company->logo, $company->name, ['title' => $company->name]) !!}
										</div>
									@else
										<div class="text" title="{{ $company->full_name }}">{{ $company->name }}</div>
									@endif
								</li>
							@endif
						@endforeach
						</ul>
					</div>
				</div>
			@endif
		</div>	
	</div>

	<div class="span3 omega">
		<div id="organizer">
			<p>Organisiert von 
				<strong>{!! HTML::linkRoute('veranstalter', $event->organizer->name, [$event->organizer->slug]) !!}</strong>
			</p>
			@if($event->organizer->logo)
				{!! HTML::imageLink('veranstalter/'.$event->organizer->slug, 'uploads/logos/big/'.$event->organizer->logo, $event->organizer->name) !!}
				<br>
			@endif
			<br>
			<h5 class="heading-underlined--small">Webseite der Veranstaltung</h5>
			@if($event->website)
				{!! HTML::link($event->website, $event->name, ['class' => 'green', 'target' => '_blank']) !!}
			@else
				-
				<br>
				<br>
			@endif

			@if($event->facebook || $event->twitter)
				<h5 class="heading-underlined--small">Social Media</h5>
				@if($event->facebook)
					{!! HTML::imageLink($event->facebook,'assets/img/icons/facebook.png', $event->name, ['target' => '_blank']) !!}
				@endif
				@if($event->twitter)
					{!! HTML::imageLink($event->twitter,'assets/img/icons/twitter.png', $event->name, ['target' => '_blank']) !!}
				@endif
				<br>
				<br>
			@endif
		</div>
		@if(count($events) > 1)
			<div id="events-widget">
				<h3 class="heading-underlined--small">Weitere Jobmessen</h3>
				<ul class="list-unstyled">
					@foreach($events as $e)
						@if($event->slug != $e->slug)
							<li>
								<table>
									<tr>
										<td>
											<span class="name">{!! HTML::link('jobmesse/'.$e->slug, Str::limit($e->name, 24), ['title' => $e->name ]) !!}</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="date">{{ Date::monthDate($e->start_date, $e->end_date, false) }}</span> in
											<span class="location">{{ $e->location }}</span>
										</td>
									</tr>
								</table>
							</li>
						@endif
					@endforeach
				</ul>	
			</div>
            <div class="pull-right">
                <p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
            </div>
		@endif
	</div>		
@stop