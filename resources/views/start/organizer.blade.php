@extends('layouts.default')

@section('title', 'Veranstalter: '. $organizer->name)

@section('metadata')
	<meta name='description' content='{{ $organizer->meta_description }}' />
	<meta name='keywords' content='{{ $organizer->keywords }}' />
@stop

@section('content')
	<div id="organizer-details" class="col-xs-12 col-sm-12 col-md-8">
		<h1 class="heading-underlined">{{ $organizer->name }}</h1>

		<div id="profile">
			<h3>Profil</h3>
			@if($organizer->profile)
				<p>{!! $organizer->profile !!}</p>
			@else
				<p>Noch kein Profil hinterlegt.</p>
			@endif
		</div>

		<br>

		<div id="events" >
			<h2 class="heading-underlined">Aktuelle Messen dieses Veranstalters</h2>
			@if(count($events) > 0)
				<ul class="eventslist list-unstyled">
				@foreach($events as $event)
					<li itemscope itemtype="http://schema.org/Event">
						<table>
							<tr>
								<td style="width: 135px; height: 50px">
									@if($event->logo)
										{!! HTML::image('uploads/logos/small/'. $event->logo) !!}
									@endif
								</td>
								<td colspan="3">
									<span class="name" itemprop="name">{!! HTML::linkRoute('messe', $event->name, [$event->slug]) !!}</span>
									<meta itemprop="description" content="Jobmesse">
									<meta itemprop="url" content="{{ URL::route('messe', [$event->slug]) }}">
								</td>
							</tr>
							<tr>
								<td class="date">
									@if($event->start_date == $event->end_date)
                                        <span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
                                            {{ Date::monthDate($event->start_date) }}
                                        </span>
                                        <meta itemprob="endDate" content="{{ Date::format($event->end_date, 'ISO')}}">
									@else
										<span itemprop="startDate" content="{{ Date::format($event->start_date, 'ISO')}}">
											{{ Date::format($event->start_date, 'day').'. -' }}
										</span>
										<span itemprop="endDate" content="{{ Date::format($event->end_date, 'ISO')}}">
											{{ Date::monthDate($event->end_date) }}
										</span>
									@endif
								</td>
								<td colspan="2">
									&nbsp;
								</td>
								<td style="width: 120px;" itemprop="location" itemscope itemtype="http://schema.org/Place">
									<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
										<span  itemprop="addressLocality"content="{{ $event->location }}">
											{{ $event->location }}<br>
											<meta itemprop="addressRegion"content="{{ $event->region->name }}">
										</span>
									</div>
								</td>
							</tr>
						</table>
					</li>
				@endforeach
				</ul>
				<div class="pull-right">
					<p>{!! HTML::linkRoute('messekalender', 'Alle Messen', [], ['class' => 'green']) !!}</p>
				</div>
			@else
				<p>Keine Veranstaltungen gefunden.</p>
			@endif
		</div>
	</div>
	<div id="organizer" class="col-md-4">
		@if($organizer->logo)
			<div class="col-xs-6 col-sm-4 col-md-12">
				{!! HTML::image('uploads/logos/big/'. $organizer->logo, $organizer->name) !!}
				<br><br>
			</div>
		@endif

        <div class="col-xs-6 col-sm-4 col-md-12">
            <h5 class="heading-underlined--small">Adresse</h5>
            @if($organizer->address1 || $organizer->address2 || $organizer->address3)
                @if($organizer->address1)
                    {{ $organizer->address1 }}<br>
                @endif
                @if($organizer->address2)
                    {{ $organizer->address2 }}<br>
                @endif
                @if($organizer->address3)
                    {{ $organizer->address3 }}<br>
                @endif
            @else
                -
                <br>
            @endif
        </div>
		<br>
        <div class="col-xs-6 col-sm-4 col-md-12">
            <h5 class="heading-underlined--small">Webseite des Veranstalters</h5>
            @if($organizer->website)
                {!! HTML::link($organizer->website, $organizer->name, ['class' => 'green', 'target' => '_blank']) !!}
            @else
                -
            @endif
        </div>
		<br>
		<br>

        @if($organizer->facebook || $organizer->twitter)
            <div class="col-xs-6 col-sm-4 col-md-12">
                <h5>Social Media</h5>
                @if($organizer->facebook)
                    {!! HTML::imageLink($organizer->facebook, 'assets/img/icons/facebook.png', $organizer->name, ['target' => '_blank']) !!}
                @endif
                @if($organizer->twitter)
                    {!! HTML::imageLink($organizer->twitter, 'assets/img/icons/twitter.png', $organizer->name, ['target' => '_blank']) !!}
                @endif
            </div>
		@endif

	</div>
@stop
