<?php
namespace Fireguard\UrlShortener;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GoogleUrlShortener implements UrlShortener
{
    protected $baseUrl;
    protected $key;

    public function __construct($key, $baseUrl = 'https://www.googleapis.com/urlshortener/v1/url')
    {
        $this->key = $key;
        $this->baseUrl = $baseUrl;
    }

    public function shorten($url): string
    {
        $client = new Client(['base_uri' => $this->getUrl()]);

        try {
            $response = $client->request('POST', '', $this->monthDataRequest($url));

            if ($response->getStatusCode() == 200) {

                $response = json_decode($response->getBody());
                return $response->id;
            }
        }
        catch (RequestException $exception) {
//            var_dump($exception);
        }

        return $url;
    }

    protected function getUrl():string
    {
        return $this->baseUrl.'?key='.$this->key;
    }

    protected function monthDataRequest($url)
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'     => 'application/json',
            ],
            'json' => [
                'longUrl' => $url,
            ]
        ];
    }
}
