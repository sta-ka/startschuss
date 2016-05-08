@extends('layouts.default')

@section('title', 'Unternehmen: '. $company->name)

@section('metadata')
	<meta name='description' content='{{ $company->meta_description }}' />
	<meta name='keywords' content='{{ $company->keywords }}' />
@stop

@section('content')
	<div class="span9 alpha">
		<div id="company">
			<h1>{{ $company->full_name }}</h1>

			<div id="information">
				<div class="span3 alpha">

				</div>

				<div class="span3">

				</div>
				<div class="span3 omega">

				</div>
			</div>

			<div id="profile" class="tabs" data-title="Profil">
				@if($company->profile)
					<p>{!! $company->profile !!}</p>
				@else
					<p>Noch kein Profil hinterlegt.</p>
				@endif
			</div>

			@if($company->jobs)
				<div id="jobs" class="tabs" data-title="Stellen">
					<ul class="list-unstyled">
					@foreach($company->jobs as $job)
						<li>
							<table>
								<tr>
									<td rowspan="2" width="100px" height="50px" class="logo">
										@if($job->logo)
											{!! HTML::image('uploads/logos/medium/'.$job->logo, $company->full_name) !!}
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
										<strong>Art der Stelle: </strong>{{ $job->type }}
									</td>
								</tr>
							</table>
						</li>
					@endforeach
					</ul>
					<div class="pull-right">
						<p>{!! HTML::linkRoute('jobs', 'Alle Stellen anzeigen', [], ['class' => 'green']) !!}</p>
					</div>		
				</div>	
			@endif

		</div>	
	</div>

	<div class="span3 omega">
		<div id="organizer">
			@if($company->logo)
				{!! HTML::imageLink('veranstalter/'.$company->slug, 'uploads/logos/big/'.$company->logo, $company->full_name) !!}
				<br><br>
			@endif
			<h5>Unternehmenswebseite</h5>
			@if($company->website)
				{!! HTML::link($company->website, $company->full_name, ['class' => 'green', 'target' => '_blank']) !!}
			@else
				-
				<br><br>
			@endif

			@if($company->facebook || $company->twitter)
				<h5>Social Media</h5>
				@if($company->facebook)
					{!! HTML::imageLink($company->facebook, 'assets/img/icons/facebook.png', $company->name, ['target' => '_blank']) !!}
				@endif
				@if($company->twitter)
					{!! HTML::imageLink($company->twitter, 'assets/img/icons/twitter.png', $company->name, ['target' => '_blank']) !!}
				@endif
				<br>
				<br>
			@endif
		</div>

	</div>		
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
            var tabNavigation = document.querySelector('#company').insertBefore(ul, pages[0]);

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