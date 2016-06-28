<?php

namespace PHPMarkdown\Tests\Parser;

use \PHPMarkdown\Parser\BasicParser;
use \PHPMarkdown\Element\Content;
use \PHPMarkdown\Element\Paragraph;
use \PHPMarkdown\Element\Header;

class BasicParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParseSetContent()
    {
        $parser = new BasicParser();
        $parser->parse('');

        $this->assertInstanceOf(
            Content::class,
            $content = $parser->getContent()
        );
        $this->assertEquals(0, count($content->getElements()));
    }

    public function testParseParagraphContent()
    {
        $parser = new BasicParser();
        $parser->parse('foo');

        $content = $parser->getContent();
        $parsedText = $content->getElements();
        $this->assertEquals(1, count($parsedText));
        $this->assertInstanceOf(Paragraph::class, $parsedText[0]);
        $this->assertEquals('<p>foo</p>', $parsedText[0]);
    }

    /**
     * @dataProvider parseHeaderDataProvider
     */
    public function testParseHeaderContent($markdownText, $htmlText)
    {
        $parser = new BasicParser();
        $parser->parse($markdownText);

        $content = $parser->getContent();
        $parsedText = $content->getElements();
        $this->assertEquals(1, count($parsedText));
        $this->assertInstanceOf(Header::class, $parsedText[0]);
        $this->assertEquals($htmlText, $parsedText[0]);
    }

    public function testParseHeaderAndParagraph()
    {
        $parser = new BasicParser();
        $parser->parse("# foo\r\nbar\nbaz");

        $content = $parser->getContent();
        $parsedText = $content->getElements();

        $this->assertEquals(2, count($parsedText));
        $this->assertInstanceOf(Header::class, $parsedText[0]);
        $this->assertEquals('<h1>foo</h1>', $parsedText[0]);
        $this->assertInstanceOf(Paragraph::class, $parsedText[1]);
        $this->assertEquals('<p>bar baz</p>', $parsedText[1]);
        $this->assertEquals('<h1>foo</h1><p>bar baz</p>', $content);
    }

    public function parseHeaderDataProvider()
    {
        return [
            ['# foo', '<h1>foo</h1>'],
            ['## foo', '<h2>foo</h2>'],
            ['### foo', '<h3>foo</h3>'],
            ['#### foo', '<h4>foo</h4>'],
            ['##### foo', '<h5>foo</h5>'],
            ['###### foo', '<h6>foo</h6>'],
        ];
    }
}
