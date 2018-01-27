<?php

namespace Odango\Http\Entity;

use Doctrine\ORM\Mapping as ORM;
use function foo\func;
use Odango\Atama\Metadata;

/**
 * TorrentMetadata
 *
 * @ORM\Table(name="torrent_metadata", indexes={@ORM\Index(name="metadata_name", columns={"name"})})
 * @ORM\Entity(readOnly=true)
 */
class TorrentMetadata extends Metadata
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string|null
     *
     * @ORM\Column(name="group", type="string", length=255, nullable=true)
     */
    private $group;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unparsed", type="text", length=65535, nullable=true)
     */
    private $unparsed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="resolution", type="string", length=255, nullable=true)
     */
    private $resolution;

    /**
     * @var string|null
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var string|null
     *
     * @ORM\Column(name="video_depth", type="string", length=255, nullable=true)
     */
    private $videoDepth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="audio", type="string", length=255, nullable=true)
     */
    private $audio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;

    /**
     * @var string|null
     *
     * @ORM\Column(name="container", type="string", length=255, nullable=true)
     */
    private $container;

    /**
     * @var string|null
     *
     * @ORM\Column(name="crc32", type="string", length=255, nullable=true)
     */
    private $crc32;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ep", type="text", length=65535, nullable=true)
     */
    private $ep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="special", type="string", length=255, nullable=true)
     */
    private $special;

    /**
     * @var int|null
     *
     * @ORM\Column(name="season", type="bigint", nullable=true)
     */
    private $season;

    /**
     * @var string|null
     *
     * @ORM\Column(name="volume", type="string", length=255, nullable=true)
     */
    private $volume;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collection", type="text", length=65535, nullable=true)
     */
    private $collection;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;

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

    /**
     * @return null|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return null|string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @return null|string
     */
    public function getUnparsed(): string
    {
        return $this->unparsed;
    }

    /**
     * @return null|string
     */
    public function getResolution(): string
    {
        return $this->resolution;
    }

    /**
     * @return null|string
     */
    public function getVideo(): string
    {
        return $this->video;
    }

    /**
     * @return null|string
     */
    public function getVideoDepth(): string
    {
        return $this->videoDepth;
    }

    /**
     * @return null|string
     */
    public function getAudio(): string
    {
        return $this->audio;
    }

    /**
     * @return null|string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return null|string
     */
    public function getContainer(): string
    {
        return $this->container;
    }

    /**
     * @return null|string
     */
    public function getCrc32(): string
    {
        return $this->crc32;
    }

    /**
     * @return null|string
     */
    public function getEp(): string
    {
        return $this->ep;
    }

    /**
     * @return null|string
     */
    public function getSpecial(): string
    {
        return $this->special;
    }

    /**
     * @return int|null
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @return null|string
     */
    public function getVolume(): string
    {
        return $this->volume;
    }

    /**
     * @return null|string
     */
    public function getCollection(): string
    {
        return $this->collection;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastUpdated(): \DateTime
    {
        return $this->lastUpdated;
    }

    /**
     * @return Torrent
     */
    public function getTorrent(): Torrent
    {
        return $this->torrent;
    }

    private function arrayNotationToVariable($index) {
        return preg_replace_callback('~_[a-z]+~', function ($data) { return strtoupper($data[0][1]); }, $index);
    }

    public function offsetExists($index)
    {
        $index = $this->arrayNotationToVariable($index);
        return isset($this->{$index});
    }


    public function offsetGet($index)
    {
        $index = $this->arrayNotationToVariable($index);

        $result = $this->{$index};
        
        if (in_array($index, ['ep', 'collection', 'unparsed'])) {
            if (strlen($result) < 4) {
                return [];
            }

            return explode(' | ', substr($result, 2, -2));
        }
        
        return $result;
    }

    public function getArray() {
        return [
            'resolution' => $this->resolution,
            'ep' => $this->offsetGet('ep'),
            'collection' => $this->offsetGet('collection'),
            'unparsed' => $this->offsetGet('unparsed'),
            'name' => $this->name,
            'video-depth' => $this->videoDepth,
            'video' => $this->video,
            'container' => $this->container,
            'source' => $this->source,
            'crc32' => $this->crc32,
            'group' => $this->group,
            'special' => $this->special,
            'season' => $this->season,
            'volume' => $this->volume,
        ];
    }
}
