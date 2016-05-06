<?php

/**
 * Macro to generate an image as link.
 *
 * @param string $url        link url
 * @param string $img        path to the image
 * @param string $alt        alternative text
 * @param array  $attributes Array of attributes
 * @param bool   $ssl
 *
 * @return \Illuminate\Support\HtmlString
 */
HTML::macro('imageLink', function ($url = '', $img = '', $alt = '', $attributes = [], $ssl = false) {
    $img = HTML::image($img, $alt);

    $ssl == true ?
        $link = HTML::secureLink($url, '#', $attributes) :
        $link = HTML::link($url, '#', $attributes);

    $link = str_replace('#', $img, $link);

    return $link;
});

/**
 * Macro to generate a select box field for the month names.
 *
 * @param string $name      name
 * @param string $selected  path to the image
 * @param array  $options   array of attributes
 *
 * @return \Illuminate\Support\HtmlString
 */
Form::macro('month', function ($name, $selected = null, $options = []) {
    $months = [];

    $monthNames = [
        0  => '----',
        1  => 'Januar',
        2  => 'Februar',
        3  => 'M&auml;rz',
        4  => 'April',
        5  => 'Mai',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'August',
        9  => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Dezember'
    ];

    foreach (range(0, 12) as $month) {
        $months[$month] = $monthNames[$month];
    }

    return Form::select($name, $months, $selected, $options);
});

/**
 * Macro to generate a select box field for the years from 1980 to the current date.
 *
 * @param string $name      name
 * @param string $selected  path to the image
 * @param array  $options   array of attributes
 *
 * @return \Illuminate\Support\HtmlString
 */
Form::macro('year', function ($name, $selected = null, $options = []) {
    $years = [0 => '----'];

    foreach (range(date('Y'), 1980) as $year) {
        $years[$year] = $year;
    }

    return Form::select($name, $years, $selected, $options);
});