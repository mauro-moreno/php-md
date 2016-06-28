<?php

namespace PHPMarkdown\Tests\Element;

use \PHPMarkdown\Element\Paragraph;

class ParagraphTest extends AbstractElementTest
{
    public function setUp()
    {
        $this->element = new Paragraph;
    }

    public function testSettersAndGetters()
    {
        $this->element->setText('foo');
        $this->element->setRawContent('foo');
        $this->element->setHtmlText('foo');

        $this->assertEquals('foo', $this->element->getText());
        $this->assertEquals('foo', $this->element->getRawContent());
        $this->assertEquals('<p>foo</p>', $this->element->getHtmlText());
    }

    /**
     * @dataProvider parsingDataProvider
     */
    public function testParsing($markdownText, $text, $htmlText)
    {
        $paragraph = new Paragraph($markdownText);

        $this->assertEquals($markdownText, $paragraph->getRawContent());
        $this->assertEquals($text, $paragraph->getText());
        $this->assertEquals($htmlText, $paragraph->getHtmlText());
        $this->assertEquals($htmlText, $paragraph);
    }

    public function parsingDataProvider()
    {
        return [
            ['foo', 'foo', '<p>foo</p>'],
            ['*foo*', '<em>foo</em>', '<p><em>foo</em></p>'],
            ['_foo_', '<em>foo</em>', '<p><em>foo</em></p>'],
            ['**foo**', '<strong>foo</strong>', '<p><strong>foo</strong></p>'],
            ['__foo__', '<strong>foo</strong>', '<p><strong>foo</strong></p>'],
            ['**_foo_**', '<strong><em>foo</em></strong>', '<p><strong><em>foo</em></strong></p>'],
            ['__foo bar__ *baz*', '<strong>foo bar</strong> <em>baz</em>', '<p><strong>foo bar</strong> <em>baz</em></p>'],
        ];
    }

    public function elementTypeDataProvider()
    {
        return [
            ['paragraph'],
        ];
    }

    public function elementWrongTypeDataProvider()
    {
        return [
            ['content'],
            ['header_1'],
            ['header_2'],
            ['header_3'],
            ['header_4'],
            ['header_5'],
            ['header_6'],
            ['foo'],
        ];
    }
}
