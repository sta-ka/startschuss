@extends('emails.layouts.transactional')

@section('heading', 'Neues Passwort vergeben')
@section('content', 'Haben Sie Ihr Passwort vergessen? Vergeben Sie nun ein neues Passwort.')
@section('link', URL::to('neues-passwort/' . $reset_code))
@section('button', 'Passwort ändern')
