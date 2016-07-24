<?php

namespace Pherserk\PageDownloader\Model;


class HeadersCollection
{
    /** @var  Header[] */
    private $headers;

    public function __construct()
    {
        $this->headers = [];
    }

    public function add(Header $header) : HeadersCollection
    {
        $this->headers[] = $header;

        return $this;
    }

    public function getAll() : array
    {
        return $this->headers;
    }
}
