var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'front/styles.sass'
    ], 'public/assets/css/front');
});

elixir(function(mix) {
    mix.sass([
        'styles.scss'
    ], 'public/assets/css/');
});

elixir(function(mix) {
    mix.styles([
        "applicant.css"
    ], 'public/assets/css/backend/applicant.css', 'resources/assets/css/backend');
});

elixir(function(mix) {
    mix.styles([
        "jquery.datatables.css"
    ], 'public/assets/css/backend/jquery.datatables.css', 'resources/assets/css/backend');
});