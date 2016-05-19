@extends('emails.layouts.transactional')

@section('heading', 'Aktivieren Sie Ihr Konto')
@section('content', 'Nur noch ein Schritt um Ihr Konto auf startschuss-karriere.de zu aktivieren.')
@section('link', URL::to('konto-aktivieren/' . $activation_code))
@section('button', 'Konto aktivieren')
