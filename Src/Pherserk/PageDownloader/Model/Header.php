<?php

namespace Pherserk\PageDownloader\Model;


class Header
{
    /** @var String */
    private $name;

    /** @var String  */
    private $value;

    public function __construct(String $name, String $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName() : String
    {
        return $this->name;
    }

    public function getValue() : String
    {
        return $this->value;
    }
}
