<?php

namespace Src;

/**
 * @property string $title
 */
class MyExampleObject {

    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

}