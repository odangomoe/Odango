<?php


namespace Odango\Http\Handler;


use BitCommunism\Doctrine\EntityManager;
use BitCommunism\Http\Handler;
use Doctrine\Common\Persistence\ObjectRepository;
use function GuzzleHttp\Psr7\parse_query;
use function GuzzleHttp\Psr7\stream_for;
use Odango\Http\Entity\AnimeTitle;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Title extends JSON
{
    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /** @var ObjectRepository */
    private $titleRepo;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager->getResponsibleEntityManager('default');
        $this->titleRepo = $entityManager->getRepository(AnimeTitle::class);
    }

    public function get(RequestInterface $request, ResponseInterface $response, $vars)
    {
        $titles = $this->titleRepo->findBy(['animeId' => $vars['animeId']]);

        $result = [
            'id' => $vars['animeId'],
            'main' => '',
            'alternatives' => []
        ];

        /** @var AnimeTitle $title */
        foreach ($titles as $title) {
            $result['alternatives'][] = $title->getName();

            if ($title->isMain()) {
                $result['main'] = $title->getName();
            }
        }

        return $this->json($response, $result);
    }

    public function search(RequestInterface $request, ResponseInterface $response) {
        $query = $request->getUri()->getQuery();
        $params = parse_query($query);


        if (!isset($params['q'])) {
            return $response->withStatus(400);
        }

        $titleQuery = $params['q'];

        $class = AnimeTitle::class;

        $query = $this->em->createQuery("SELECT t as title, m.name as mainTitle FROM ${class} t JOIN ${class} m WHERE m.animeId = t.animeId AND m.main = 1 AND t.name LIKE :title GROUP BY m.animeId");
        $query->setMaxResults($params['limit'] ?? 30);
        $query->setParameter('title', '%' . $titleQuery . '%');

        $result = [];

        foreach ($query->getResult() as $titleResult) {
            $result[] = [
                'title' => $titleResult['title']->getName(),
                'id' => $titleResult['title']->getAnimeId(),
                'main' => $titleResult['mainTitle']
            ];
        }

        $resultJson = [
            'query' => $titleQuery,
            'result' => $result,
        ];

        return $this->json($response, $resultJson);
    }
}