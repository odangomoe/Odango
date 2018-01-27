<?php

namespace Odango\Http\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnimeTitle
 *
 * @ORM\Table(name="anime_title", indexes={@ORM\Index(name="title_name", columns={"name"}), @ORM\Index(name="title_anime_id", columns={"anime_id"})})
 * @ORM\Entity(readOnly=true)
 */
class AnimeTitle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="anime_id", type="bigint", nullable=false)
     */
    private $animeId;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="main", type="boolean", nullable=true)
     */
    private $main;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAnimeId(): int
    {
        return $this->animeId;
    }

    /**
     * @return bool|null
     */
    public function isMain(): bool
    {
        return $this->main;
    }

    /**
     * @return null|string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
