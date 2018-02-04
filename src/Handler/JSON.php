<?php


namespace Odango\Http\Handler;


use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Message\ResponseInterface;

class JSON
{
    protected function json(ResponseInterface $response, $arr) {
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withBody(stream_for(json_encode($arr)));
    }
}