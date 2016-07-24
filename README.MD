![scrutinizer quality score]
(https://scrutinizer-ci.com/g/Pherserk/PageDownloader/badges/quality-score.png?b=master)

![Build on scrutinizer]
(https://scrutinizer-ci.com/g/Pherserk/PageDownloader/badges/build.png?b=master)

#Components

##PageDownloader

This component download a web page (html format) and extracts information from an html document.

Basic usage:

<?php

use GuzzleHttp\Client;

use Psr\Http\Message\Request;

$client = new Client();

$request = new Request('GET', 'https://github.com/Pherserk/PageDownloader');

$downloader = new PageDownloader($client);

$pageInformations = $downloader->download($request);

var_dump($pageInformations);
