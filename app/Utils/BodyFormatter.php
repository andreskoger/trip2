<?php

namespace App\Utils;

use App\Image;
use Markdown;

class BodyFormatter
{
    protected $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function links()
    {
        // Modified version of
        // http://stackoverflow.com/a/5289151
        // and http://stackoverflow.com/a/12590772

        $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))(?![^<>]*>)/i";

        if ($filteredBody = preg_replace($pattern, '<a href="$1">$1</a>', $this->body)) {
            $this->body = $filteredBody;
        }

        if ($filteredBody = preg_replace('/(<a href="(http|https):(?!\/\/(?:www\.)?trip\.ee)[^"]+")>/is', '\\1 target="_blank">', $this->body)) {
            //       $this->body = $filteredBody;
        }

        return $this;
    }

    public function images()
    {
        $imagePattern = '/\[\[([0-9]+)\]\]/';

        if (preg_match_all($imagePattern, $this->body, $matches)) {
            foreach ($matches[1] as $match) {
                if ($image = Image::find($match)) {
                    $this->body = str_replace(
                        "[[$image->id]]",
                        '<img src="'.$image->preset('large').'" />',
                        $this->body
                    );
                }
            }
        }

        return $this;
    }

    public function youtube()
    {
        $this->body = preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            '<iframe width="420" height="315" src="//www.youtube.com/embed/$2" allowfullscreen></iframe>',
            $this->body
        );

        return $this;
    }

    public function youtube2()
    {
        $pattern = "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i";

        $this->body = preg_replace_callback($pattern, function ($matches) {
            return component('Youtube')->with('id', $matches[2]);
        },
            $this->body
        );

        return $this;
    }

    public function newlines()
    {
        $this->body = nl2br($this->body);

        return $this;
    }

    public function markdown()
    {

        $this->body = Markdown::setBreaksEnabled(true)->text($this->body);

        return $this;

    }

    public function format()
    {
        return $this
            ->markdown()
            ->links()
            ->images()
            ->youtube2()
            ->body;
    }
}