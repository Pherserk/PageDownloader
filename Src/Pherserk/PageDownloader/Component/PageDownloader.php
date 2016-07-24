<?php

namespace Pherserk\PageDownloader\Component;


use GuzzleHttp\ClientInterface;
use Pherserk\HtmlDocInfoEx\Component\HtmlDocumentInformationsExtractor;
use Pherserk\PageDownloader\Model\Header;
use Pherserk\PageDownloader\Model\PageInformations;
use Psr\Http\Message\RequestInterface;

class PageDownloader
{
    private $client;

    /**
     * PageDownloader constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param RequestInterface $request
     * @return PageInformations
     */
    public function download(RequestInterface $request) : PageInformations
    {
        $response = $this->client->send($request);
        $content = $response->getBody();

        $htmlDocument = HtmlDocumentInformationsExtractor::extract($content);

        $pageInformations = new PageInformations($htmlDocument);

        $pageInformations->setResponseStatusCode($response->getStatusCode());

        $pageInformations
            ->addHeader(new Header('Content-Type', $response->getHeader('Content-Type')));

        return $pageInformations;
    }
}
