<?php

/**
 * Set active status for li items.
 *
 * @param           $path
 * @param bool|true $class
 * @param string    $active
 *
 * @return string
 */
function set_active($path, $class = true, $active = 'active') {
    $attribute = $class ? "class = $active" : $active;

    return call_user_func_array('Request::is', (array)$path) ? $attribute : '';
}

/**
 * Return user settings.
 *
 * @param null|string $key
 *
 * @return \Illuminate\Foundation\Application|mixed
 */
function settings($key = null) {
    $settings = app('App\Settings');
    return $key ? $settings->get($key) : $settings;
}

/**
 * Set notification.
 *
 * @param           $success
 * @param           $key
 * @param bool      $append
 */
function notify($success, $key, $append = true) {
    if ($success === false || $success === 'error') {
        if ($append == true) {
            $key = $key  . '_unsuccessful';
        }

        Notification::error($key);
    } else {
        if ($append == true) {
            $key = $key  . '_successful';
        }

        Notification::success($key);
    };
}

/**
 * Render pagination meta data for head area.
 *
 * @param $resource
 *
 * @return string
 */
function renderPaginationMetaData($resource) {
    $metaTag = '';

    if ($resource->currentPage() > 1 && $resource->lastPage() > 1) {
        $metaTag .= '<link rel="prev" href="' . \URL::current() . '?page=' . ($resource->currentPage() - 1) . '">';
    }

    if ($resource->hasMorePages()) {
        $metaTag .= '<link rel="next" href="' . \URL::current() . '?page=' . ($resource->currentPage() + 1) . '">';
    }

    return $metaTag;
}