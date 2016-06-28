<?php

namespace PHPMarkdown\Tests\Element;

interface ElementTestInterface
{
    public function testSettersAndGetters();

    public function testElementType($type);

    public function testElementWrongType($type);
}
