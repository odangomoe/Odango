<?php


namespace Odango\Http\Service;


use BitCommunism\Doctrine\EntityManager;
use Odango\Atama\Archiver;
use Odango\Http\Entity\AnimeTitle;

class TorrentService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em->getResponsibleEntityManager('default');
    }

    public function getSetsArrayByAnimeId($animeId)
    {
        $animeTitle = AnimeTitle::class;
        $torrent = \Odango\Http\Entity\Torrent::class;

        $titles = $this->em->getRepository($animeTitle)->findBy(['animeId' => $animeId]);

        $animeInfo = [
            'id' => $animeId,
            'title' => null,
            'alternatives' => [],
        ];

        $names = [];

        /** @var AnimeTitle $title */
        foreach ($titles as $title) {
            $names[] = $title->getName();

            if ($title->isMain()) {
                $animeInfo['title'] = $title->getName();
            }
        }

        $animeInfo['alternatives'] = $names;

        $query = $this->em->createQuery("SELECT t FROM ${torrent} t JOIN t.metadata m WHERE m.name IN (:names)");
        $query->setParameter('names', $names);

        $result = [];

        $sets = Archiver::archive(
            $query->getResult()
        );

        foreach ($sets as $set) {
            $torrents = $set->getTorrents();

            $firstTorrent = reset($torrents);

            $resultSet = [
                'hash' => $firstTorrent->getSeriesHash(),
                'metadata' => [
                    'group' => $firstTorrent->getMetadata()['group'],
                    'type' => $firstTorrent->getMetadata()['type'],
                    'resolution' => $firstTorrent->getMetadata()['resolution'],
                    'name' => $firstTorrent->getMetadata()['name'],
                ],
                'torrents' => []
            ];

            /** @var \Odango\Http\Entity\Torrent $torrent */
            foreach ($torrents as $torrent) {
                $resultSet['torrents'][] = [
                    'title' => $torrent->getTitle(),
                    'info-hash' => $torrent->getInfoHash(),
                    'submitter-id' => $torrent->getSubmitterId(),
                    'nyaa' => [
                        'view' => 'https://nyaa.si/view/' . $torrent->getId(),
                        'torrent' => 'https://nyaa.si/download/' . $torrent->getId(),
                    ],
                    'metadata' => $torrent->getMetadata()->getArray(),
                ];
            }

            $result[] = $resultSet;
        }

        return [
            'anime' => $animeInfo,
            'torrent-sets' => $result
        ];
    }
}
