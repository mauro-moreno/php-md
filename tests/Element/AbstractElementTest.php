<?php

namespace PHPMarkdown\Tests\Element;

use \PHPMarkdown\Exception\InvalidArgumentException;

abstract class AbstractElementTest extends \PHPUnit_Framework_TestCase
    implements ElementTestInterface
{
    protected $element;

    /**
     * @dataProvider elementTypeDataProvider
     */
    public function testElementType($type)
    {
        $this->element->setType($type);

        $this->assertEquals($type, $this->element->getType());
    }

    /**
     * @dataProvider      elementWrongTypeDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testElementWrongType($type)
    {
        $this->element->setType($type);
    }
}
