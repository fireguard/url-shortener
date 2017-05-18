<?php

namespace Fireguard\UrlShortener;


use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use PHPUnit\Framework\TestCase;

class GoogleUrlShortenerTest extends TestCase
{
    /**
     * @var UrlShortener
     */
    protected $shortener;

    public function setUp()
    {
        parent::setUp();
        $dotenv = new \Dotenv\Dotenv(__DIR__.'\..\..');
        $dotenv->load();
        $this->shortener = new GoogleUrlShortener(getenv('GOOGLE_KEY'));
    }

    public function testShorten()
    {
        $url = $this->shortener->shorten('https://www.google.com.br');
        $this->assertTrue(!filter_var($url, FILTER_VALIDATE_URL) === false);
    }

    public function testShortenDestinationIsValid()
    {
        $baseUrl = 'https://www.google.com.br/';
        $url = $this->shortener->shorten($baseUrl);
        $client = new Client(['base_uri' => $url]);

        $newUrl = '';
        $client->get($url, [
            'on_stats' => function (TransferStats $stats) use (&$newUrl) {
                $newUrl = $stats->getEffectiveUri();
            }
        ])->getBody()->getContents();

        $this->assertEquals($baseUrl, (string) $newUrl);
    }
}
