# Odango

The _simplistic_ frontend  of odango.moe

# API

### Title search

`/api/title?q=[search]&limit=[limit]`

```
{
    query: string,
    result: Array<{
        title: string,
        id: number,
        main: string, 
    }>,
}
```

### Title lookup

`/api/title/[id]`

```
{
    id: number,
    main: string,
    alternatives: string[],
}
```

### Torrent lookup

`/api/torrent/by-anime/[id]`

```
{
    anime: {
        id: number,
        main: string,
        alternatives: string[],
    },
    torrent-sets: Array<{
        hash: string,
        metadata: {
            group: string,
            type: string,
            resolution: ?string,
            name: string,
        },
        torrents: Array<{
            title: string,
            info-hash: string,
            submitter-id: number,
            nyaa: {
                view: string,
                torrent: string,
            },
            metadata: {
                name: string,
                group: string,
                type: string,
                source: ?string,
                ep: Array<number|string>,
                collection: Array<number|string>,
                unparsed: string[],
                crc32: ?string,
                volume: ?string,
                special: ?string,
                season: ?string,
                video-depth: ?string,
                video: ?string,
                audio: ?string,
                container: ?string,
            },
        }>,
    }>,
}
```