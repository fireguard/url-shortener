<?php
namespace Fireguard\UrlShortener;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class ToLyUrlShortener implements UrlShortener
{
    protected $baseUrl;
    protected $key;

    public function __construct($key = '', $baseUrl = 'https://to.ly/api.php')
    {
        $this->key = $key;
        $this->baseUrl = $baseUrl;
    }

    public function shorten($url): string
    {
        $client = new Client(['base_uri' => $this->baseUrl]);

        try {
            $response = $client->request('GET', '?json=1&longurl='.urlencode($url));

            if ($response->getStatusCode() == 200) {
                return $this->getResponseShortUrl($response);
            }
        }
        catch (RequestException $exception) {

        }

        return '';
    }

    protected function getResponseShortUrl(Response $response):string
    {
        $data = $response->getBody()->getContents();
        $data = str_replace('(', '', $data);
        $data = str_replace(')', '', $data);

        $response = json_decode($data);
        return $response ->shorturl;
    }
}
