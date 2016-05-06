@extends('layouts.default')

@section('title', 'Jobs, Praktika und mehr in '. $city->name)

@section('metadata')
    <meta name='description' content='Jobs, Praktika und mehr in ' . {{ $city->name }} />
    <meta name='keywords' content='jobs, praktika, stellenangebote, karriere, ' . {{ $city->name }} />
    {!! renderPaginationMetaData($jobs) !!}
@stop

@section('content')
    <div class="span9 alpha">
        @if($jobs->total() == 0)
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
                <h1>Stellen in {{ $city->name }}</h1>
                <ul class="list-unstyled">
                    @foreach($jobs as $job)
                        <li>
                            <table>
                                <tr>
                                    <td rowspan="2" width="100px" height="50px">
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
            <h3>Angebote für</h3>
            <ul class="list-unstyled">
                <?php $job_types = ['Vollzeit', 'Teilzeit', 'Praktikum', 'Werkstudent', 'Abschlussarbeit']; ?>
                @foreach($job_types as $job_type)
                    <li {{ Request::get('typ') == $job_type ? 'class=active' : '' }} >
                        {!! HTML::linkRoute('jobsIn', $job_type,[urldecode(Request::segment(3)), 'typ' => $job_type]) !!}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="pull-right">
            <p>{!! HTML::linkRoute('jobs', 'Alle Stellen anzeigen', [], ['class' => 'green']) !!}</p>
        </div>
    </div>
@stop