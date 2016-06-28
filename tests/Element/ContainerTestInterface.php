<?php

namespace PHPMarkdown\Tests\Element;

interface ContainerTestInterface
{
    public function testNestableElement($type, $class, $type_compare, $expected);

    public function testAddElementWrongType($type, $class, $type_compare);

    public function testAddElement($type, $class, $type_compare);

    public function elementTypeDataProvider();

    public function elementWrongTypeDataProvider();

    public function elementDataProvider();

    public function addElementWrongTypeDataProvider();

    public function addElementDataProvider();
}
