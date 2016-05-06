<!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Wartungsarbeiten | startschuss-karriere.de</title>

        <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico') }}" type="image/x-icon" />

        <link rel="stylesheet" href="{{ URL::asset('assets/css/all.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/front/styles.css') }}">

    </head>

    <body>

        <div id="wrap">
            <div id="header">
                <div id="background">
                    <div class="content-area container_12">
                        {!! HTML::imageLink('home', 'assets/img/logo.png', 'startschuss-karriere', ['title' => 'Startseite']) !!}
                    </div>
                </div>
            </div>

            <div id="content">
                {{ Notification::display() }}
                <div id="main" class="container_12">
                    <div class="span12">
                        <h1>Wartungsarbeiten</h1>
                        <p>Wir sind gleich wieder zurück!</p>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

