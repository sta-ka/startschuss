<?php namespace App\Services\Creator;

abstract class Creator {

    /**
     * Upload image.
     *
     * @param $image
     * @param int $width
     * @param int $height
     * @param string $path
     */
    protected function uploadImage($image, $width, $height, $path)
    {
        \Image::make($image->getRealPath())->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(utf8_decode($path));
    }


    /**
     * Create a filename and make it lower case.
     *
     * @param object $resource
     *
     * @return string
     */
    protected function createFilename($resource)
    {
        $extension = \File::extension(\Input::file('logo')->getClientOriginalName());
        $filename = $resource->slug . '_' . date('U') . '.' . $extension;

        return \Str::lower($filename);
    }

}