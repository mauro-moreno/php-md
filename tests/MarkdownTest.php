<?php

namespace PHPMarkdown\Tests;

use \PHPMarkdown\Markdown;
use \PHPMarkdown\Exception\LogicException;
use \PHPMarkdown\Parser\ParserInterface;
use \PHPMarkdown\Element\Content;

class MarkdownTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $parser = $this->getParser();
        $parser->expects($this->once())->method('parse');
        $content = $this->getContent();

        $markdown = new Markdown();
        $markdown->setParser($parser);
        $markdown->setRawContent('');
        $markdown->setContent($content);

        $this->assertEquals($parser, $markdown->getParser());
        $this->assertEquals($content, $markdown->getContent());
        $this->assertEquals('', $markdown->getRawContent());
    }

    public function testGetParsedContent()
    {
        $parser = $this->getParser();
        $parser->expects($this->once())->method('parse')
            ->willReturn($this->getContent());

        $markdown = new Markdown($parser, '');
        $this->assertInstanceOf(
            Content::class,
            $markdown->getContent()
        );
    }

    /**
     * @expectedException LogicException
     */
    public function testEmptyParser()
    {
        $markdown = new Markdown();
        $markdown->setRawContent('');
    }

    private function getParser()
    {
        return $this->createMock(ParserInterface::class);
    }

    private function getContent()
    {
        return $this->createMock(Content::class);
    }
}
