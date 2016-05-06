@extends('layouts.organizer')

@section('title', 'Einzelgespräche verwalten')

@section('scripts')
    <script src="{{ URL::asset('assets/js/backend/editable.js') }}"></script>
    <script src="{{ URL::asset('assets/js/backend/ajaxparticipants.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable({
                "oLanguage": {
                    "sUrl": "{{ URL::asset('assets/js/dataTables.german.txt') }}"
                },
                "aoColumns": [
                    null,
                    {'sType': 'form-input'},
                    null
                ],
                "fnDrawCallback": function () {
                    $('#datatable_filter input, #datatable_length select').addClass('form-element input-sm');
                }
            });
        });
    </script>
@stop

@section('content')
    @include('organizer.events.profile.partials.breadcrumb')

    <div class="span3 alpha">
        @include('organizer.events.profile.partials.nav_bar')
    </div>
    <div class="span9 omega">
        @include('partials/validation_errors')

        {!! Form::model($event, ['url' => 'organizer/profile/'.$event->id.'/update-application-deadline',  'class' => 'add-interview-tag']) !!}
        <div class="span8 alpha">
            <div class="form-group">
                {!! Form::label('application_deadline', 'Bewerbungsschluss')!!}
                {!! Form::text('application_deadline', null, ['class' => 'form-control input-sm']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Bearbeiten', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <br><br><br>

        <table id="datatable" class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Aktion</th>
                <th width="270px">Kommentar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>
                        {{ $company->name }}
                    </td>
                    <td>
                        @if($company->pivot->interview)
                            -
                        @else
                            {!! Form::open(['url' => 'organizer/profile/add-interview/'.$event->id.'/'.$company->id, 'class' => 'add-interview-tag']) !!}
                            {!! Form::submit('Hinzufügen') !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        @if($company->pivot->interview && ! $company->pivot->comment)
                            {!! Form::open(['url' => 'organizer/profile/add-comment/'.$event->id.'/'.$company->id, 'class' => 'add-comment']) !!}
                            <div class="input-group">
                                {!! Form::text('comment', null, ['class' => 'form-control input-sm']) !!}

                                <span style="display:none" class="comment">{{ $company->pivot->comment }}</span>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
                                </span>
                            </div>
                            {!! Form::close() !!}
                        @elseif($company->pivot->interview && $company->pivot->comment)
                            <div>
                                <span class="comment">{{ $company->pivot->comment }}</span>
                                <button type="button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </div>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
