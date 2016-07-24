<?php

namespace Pherserk\PageDownloader\Model;


use Pherserk\HtmlDocInfoEx\Model\HtmlDocument;

class PageInformations
{
    /** @var HtmlDocument */
    private $htmlDocument;

    /** @var int|null */
    private $responeStatusCode;

    /** @var HeadersCollection */
    private $headers;

    public function __construct(HtmlDocument $htmlDocument)
    {
        $this->htmlDocument = $htmlDocument;
        $this->responeStatusCode = null;
        $this->headers = new HeadersCollection();
    }

    public function getHtmlDocument() : HtmlDocument
    {
        return $this->htmlDocument;
    }

    public function setResponseStatusCode(int $statusCode) : PageInformations
    {
        $this->responeStatusCode = $statusCode;
        return $this;
    }

    public function getResponseStatusCode() : int
    {
        return $this->responeStatusCode;
    }

    public function addHeader(Header $header) : PageInformations
    {
        $this->headers->add($header);
        return $this;
    }

    public function getHeaders() : array
    {
        return $this->headers->getAll();
    }
}
