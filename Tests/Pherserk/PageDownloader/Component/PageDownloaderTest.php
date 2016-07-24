<?php

namespace Pherserk\PageDownloader\Component;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Pherserk\HtmlDocInfoEx\Model\HighLightInterface;
use Pherserk\HtmlDocInfoEx\Model\InformationBlock;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PageDownloaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider scenarioProvider
     */
    public function testDownload(RequestInterface $request, ClientInterface $client)
    {
        $downloader = new PageDownloader($client);
        $pageInformation = $downloader->download($request);

        self::assertEquals(200, $pageInformation->getResponseStatusCode());
        
        $htmlDocument = $pageInformation->getHtmlDocument();

        self::assertEquals('UTF-8', $htmlDocument->getCharsetEncoding());
        self::assertEquals('In the Rainbow', $htmlDocument->getTitle());
        self::assertCount(3, $htmlDocument->getHeadings());

        /** @var InformationBlock[] $informationBlocks */
        $informationBlocks = $htmlDocument->getInformationBlocks();
        self::assertCount(13, $informationBlocks);

        self::assertEquals(
            'This is an annoy copyright here. Do you know??? Privacy invasion Leave me the f*ck alone!',
            $informationBlocks[12]->getContent()
        );

        /** @var HighLightInterface $highLights */
        $highLights = $informationBlocks[1]->getHighlights();

        self::assertEquals('weight', $highLights[1]->getType());
        self::assertEquals('expecial', $highLights[1]->getText());
    }

    public function scenarioProvider()
    {
        $request = new Request('GET', 'http:://some.web.url/in-the-rainbow.html');

        /** @var ResponseInterface $response */
        $response = self::prophesize(ResponseInterface::class);
        $response->getBody()->willReturn(file_get_contents(sprintf('%s/data/in-the-rainbow.html', __DIR__)));
        $response->getHeader(Argument::exact('Content-Type'))->willReturn('A valid content Type');
        $response->getStatusCode()->willReturn(200);

        /** @var ClientInterface $client */
        $clientMock = self::prophesize(ClientInterface::class);
        $clientMock->send(Argument::exact($request))->willReturn($response->reveal());

        return [
            [
                $request,
                $clientMock->reveal(),
            ]
        ];
    }
}