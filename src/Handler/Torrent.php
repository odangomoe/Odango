<?php


namespace Odango\Http\Handler;


use BitCommunism\Doctrine\EntityManager;
use Odango\Atama\Archiver;
use Odango\Http\Entity\AnimeTitle;
use Odango\Http\Service\TorrentService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Torrent extends JSON
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em->getResponsibleEntityManager('default');
    }

    public function byAnimeId(RequestInterface $request, ResponseInterface $response, $vars, TorrentService $service)
    {
        return $this->json(
            $response,
            $service->getSetsArrayByAnimeId($vars['animeId'])
        );
    }
}