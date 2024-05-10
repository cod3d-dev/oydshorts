<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class UrlShortener
{
    protected $client;
    protected $apiUrl = 'https://cutt.ly/api/api.php';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'timeout' => 2.0,
        ]);
    }

    public function shortenUrl($url)
    {
        $apiKey = 'a088c3b9d91d81207f121f79ccb6603560322'; // Replace with your Cuttly API Key
        $result = [ 'status' => '', 'message' => '', 'shortUrl' => '' ];


        try {
            $response = $this->client->get($this->apiUrl, [
                'query' => [
                    'key' => $apiKey,
                    'short' => $url,
                ]
            ]);

            $body = $response->getBody();
            $arr_body = json_decode($body);

            $result['shortUrl'] = $arr_body->url->shortLink;
            $result['message'] = 'URL shortened successfully';
            $result['status'] = 'success';

        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $errorMessage = $e->getResponse()->getBody()->getContents();
                $result['message'] = $errorMessage;
                $result['status'] = 'error';
            }
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
            $result['status'] = 'error';
        }

        return $result;

    }
}
