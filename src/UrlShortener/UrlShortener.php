<?php
namespace Fireguard\UrlShortener;

interface UrlShortener
{
    public function shorten($url): string;
}
