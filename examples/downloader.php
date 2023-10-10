<?php

interface IDownloader
{
    public function download(string $url): string;

}


class CacheDownloader implements IDownloader
{
    protected array $results = [];

    public function __construct(protected IDownloader $downloader)
    {
    }

    public function download(string $url): string
    {
        if (!isset($this->results[$url])) {
            $this->results[$url] = $this->downloader->download($url);
        }
        return $this->results[$url];
    }
}

class SimpleDownloader implements IDownloader
{

    public function download(string $url): string
    {
        return file_get_contents($url);
    }
}

class CacheDownloaderExt extends SimpleDownloader
{
    protected array $results = [];

    public function download(string $url): string
    {
        if (!isset($this->results[$url])) {
            $this->results[$url] = parent::download($url);
        }
        return $this->results[$url];
    }
}


$downloader = new CacheDownloader(new SimpleDownloader());

function app(array $urls, IDownloader $downloader)
{
    foreach ($urls as $url) {
        $a = $downloader->download($url);
    }
}


app(
    [
        'https://facebook.com',
        //        'https://google.com',
        //        'https://np.com',

    ],
    $downloader
);


exit;