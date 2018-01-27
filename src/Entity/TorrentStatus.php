<?php

namespace Odango\Http\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TorrentStatus
 *
 * @ORM\Table(name="torrent_status")
 * @ORM\Entity(readOnly=true)
 */
class TorrentStatus
{
    /**
     * @var bool|null
     *
     * @ORM\Column(name="success", type="boolean", nullable=true, options={"default"="1"})
     */
    private $success = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="tracker", type="string", length=255, nullable=true)
     */
    private $tracker;

    /**
     * @var int|null
     *
     * @ORM\Column(name="seeders", type="bigint", nullable=true)
     */
    private $seeders;

    /**
     * @var int|null
     *
     * @ORM\Column(name="leechers", type="bigint", nullable=true)
     */
    private $leechers;

    /**
     * @var int|null
     *
     * @ORM\Column(name="downloaded", type="bigint", nullable=true)
     */
    private $downloaded;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \Odango\Http\Entity\Torrent
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Odango\Http\Entity\Torrent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="torrent_id", referencedColumnName="id")
     * })
     */
    private $torrent;


}
