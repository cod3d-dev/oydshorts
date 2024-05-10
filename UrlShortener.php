<?php

use GuzzleHttp\Client;

class UrlShortener
{
    protected $client;
    protected $apiUrl = 'https://cutt.ly/api/api.php';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'timeout'  => 2.0,
        ]);
    }

    public function shortenUrl($url)
    {
        $apiKey = 'YOUR_CUTTLY_API_KEY'; // Replace with your Cuttly API Key
        $response = $this->client->get($this->apiUrl, [
            'query' => [
                'key' => $apiKey,
                'short' => $url,
            ]
        ]);

        $body = $response->getBody();
        $arr_body = json_decode($body);

        return $arr_body->url->shortLink;
    }
}
