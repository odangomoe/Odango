<?php

namespace Odango\Http\Entity;

use Doctrine\ORM\Mapping as ORM;
use Odango\Atama\Metadata;

/**
 * Torrent
 *
 * @ORM\Table(name="torrent")
 * @ORM\Entity(readOnly=true)
 */
class Torrent extends \Odango\Atama\Torrent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="info_hash", type="string", length=40, nullable=false)
     */
    private $infoHash;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cached_torrent_file", type="text", length=65535, nullable=true)
     */
    private $cachedTorrentFile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="torrent_title", type="text", length=65535, nullable=true)
     */
    protected $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="submitter_id", type="bigint", nullable=true)
     */
    private $submitterId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trackers", type="text", length=65535, nullable=true)
     */
    private $trackers;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_crawled", type="datetime", nullable=true)
     */
    private $dateCrawled;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;

    /**
     * @ORM\OneToOne(targetEntity="TorrentMetadata", mappedBy="torrent")
     */
    protected $metadata;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInfoHash(): string
    {
        return $this->infoHash;
    }

    /**
     * @return null|string
     */
    public function getCachedTorrentFile(): string
    {
        return $this->cachedTorrentFile;
    }

    /**
     * @return int|null
     */
    public function getSubmitterId(): int
    {
        return $this->submitterId;
    }

    /**
     * @return null|string
     */
    public function getTrackers(): string
    {
        return $this->trackers;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateCrawled(): \DateTime
    {
        return $this->dateCrawled;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastUpdated(): \DateTime
    {
        return $this->lastUpdated;
    }

    /**
     * @return mixed
     */
    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }
}
