<?php
namespace App\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RickAndMortyApi
{
    const baseUrl = 'https://rickandmortyapi.com/api/';
    const METHOD_GET = 'get';

    /**
     * Request data. Returns FALSE on error or result array data on success
     * @param $path
     * @param $pathParam - ['page' => 'int|null', 'id' = 'int|null']
     * @param string $method
     * @return array|false
     */
    public function getData ($path = '', $pathParam = [], $method = self::METHOD_GET)
    {
        $setParam = null;
        if (isset($pathParam['page'])) {
            $setParam = '?page='.$pathParam['page'];
        } else if (isset($pathParam['id'])) {
            $setParam = '/'.$pathParam['id'];
        }

        $url = self::baseUrl . $path . $setParam;
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        /** @var Response $response */
        $response = Http::withoutVerifying()->withHeaders($headers)->{$method}($url);
        return (isset($response['error']) || empty($response) ? null : $response);
    }
}
