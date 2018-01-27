<?php


namespace Odango\Http\Object;


use Odango\Atama\Torrent;

class KnownTorrent extends Torrent
{
    public function __construct(\Odango\Http\Entity\Torrent $torrent)
    {
        $this->setId($torrent->getId());
        $this->setTitle($torrent->getTitle());
        $this->metadata = $torrent->getMetadata();
    }
}