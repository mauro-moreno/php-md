<?php

namespace PHPMarkdown\Tests\Element;

use \PHPMarkdown\Element\Content;
use \PHPMarkdown\Element\Header;
use \PHPMarkdown\Element\Paragraph;

class ContentTest extends AbstractParentTest
{
    public function setUp()
    {
        $this->element = new Content;
    }

    public function testSettersAndGetters()
    {
        $this->element->setText('foo');
        $this->element->setRawContent('foo');

        $this->assertEquals(null, $this->element->getText());
        $this->assertEquals('foo', $this->element->getRawContent());
    }

    public function elementTypeDataProvider()
    {
        return [
            ['content'],
        ];
    }

    public function elementWrongTypeDataProvider()
    {
        return [
            ['header_1'],
            ['header_2'],
            ['header_3'],
            ['header_4'],
            ['header_5'],
            ['header_6'],
            ['paragraph'],
            ['foo'],
        ];
    }

    public function elementDataProvider()
    {
        return [
            ['content', Header::class, 'header_1', true],
            ['content', Header::class, 'header_2', true],
            ['content', Header::class, 'header_3', true],
            ['content', Header::class, 'header_4', true],
            ['content', Header::class, 'header_5', true],
            ['content', Header::class, 'header_6', true],
            ['content', Paragraph::class, 'paragraph', true],
            ['content', Content::class, 'foo', false],
        ];
    }

    public function addElementWrongTypeDataProvider()
    {
        return [
            ['content', Content::class, 'foo'],
        ];
    }

    public function addElementDataProvider()
    {
        return [
            ['content', Header::class, 'header_1'],
        ];
    }
}
