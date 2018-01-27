<?php


namespace Odango\Http\Handler;


use BitCommunism\Twig\Handler\Twig;
use Odango\Http\Service\TorrentService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Home extends Twig
{
    public function home(RequestInterface $request, ResponseInterface $response) {
        return $this->template('home.html.twig', []);
    }

    public function showTorrents(RequestInterface $request, ResponseInterface $response, $vars, TorrentService $service) {
        $data = $service->getSetsArrayByAnimeId($vars['animeId']);

        $sets = $data['torrent-sets'];

        $byGroup = [];

        foreach ($sets as $set) {
            $meta = $set['metadata'];
            $group = $meta['group'];

            if (!isset($byGroup[$group])) {
                $byGroup[$group] = [];
            }

            $byGroup[$group][] = $set;
        }

        return $this->template('torrents.html.twig', [
            'anime' => $data['anime'],
            'sets' => $byGroup,
        ]);
    }
}