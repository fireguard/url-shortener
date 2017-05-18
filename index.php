<?php

require_once 'vendor/autoload.php';
use Fireguard\UrlShortener\GoogleUrlShortener;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$urlShorts = [];
$url = 'http://docs.guzzlephp.org/en/latest/quickstart.html';

$google = new GoogleUrlShortener(getenv('GOOGLE_KEY'));
$urlShorts['goo.gl'] = $google->shorten($url);

$toLy = new Fireguard\UrlShortener\ToLyUrlShortener();
$urlShorts['to.ly'] = $toLy->shorten($url);

print_r($urlShorts);
