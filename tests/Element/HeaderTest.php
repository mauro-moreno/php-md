<?php

namespace PHPMarkdown\Tests\Element;

use \PHPMarkdown\Element\Header;
use \PHPMarkdown\Exception\InvalidArgumentException;

class HeaderTest extends AbstractElementTest
{
    public function setUp()
    {
        $this->element = new Header;
    }

    public function testSettersAndGetters()
    {
        $this->element->setText('foo');
        $this->element->setRawContent('# foo');
        $this->element->setHtmlText('foo');

        $this->assertEquals('foo', $this->element->getText());
        $this->assertEquals('# foo', $this->element->getRawContent());
        $this->assertEquals('<h1>foo</h1>', $this->element->getHtmlText());
        $this->assertEquals('h1', $this->element->getHtmlMarkup());
    }

    /**
     * @dataProvider parsingDataProvider
     */
    public function testParsing($markdownText, $text, $htmlText, $htmlMarkup)
    {
        $header = new Header($markdownText, $htmlMarkup);

        $this->assertEquals($markdownText, $header->getRawContent());
        $this->assertEquals($text, $header->getText());
        $this->assertEquals($htmlText, $header->getHtmlText());
        $this->assertEquals($htmlText, $header);
    }

    /**
     * @dataProvider wrongDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testWrongMarkdownText($markdownText)
    {
        new Header($markdownText);
    }

    public function parsingDataProvider()
    {
        return [
            ['# foo', 'foo', '<h1>foo</h1>', 'h1'],
            ['# *foo*', '<em>foo</em>', '<h1><em>foo</em></h1>', 'h1'],
            ['# _foo_', '<em>foo</em>', '<h1><em>foo</em></h1>', 'h1'],
            ['# **foo**', '<strong>foo</strong>', '<h1><strong>foo</strong></h1>', 'h1'],
            ['# __foo__', '<strong>foo</strong>', '<h1><strong>foo</strong></h1>', 'h1'],
            ['# **_foo_**', '<strong><em>foo</em></strong>', '<h1><strong><em>foo</em></strong></h1>', 'h1'],
            ['# __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h1><strong>foo bar</strong> <em>boo</em></h1>', 'h1'],
            ['## foo', 'foo', '<h2>foo</h2>', 'h2'],
            ['## *foo*', '<em>foo</em>', '<h2><em>foo</em></h2>', 'h2'],
            ['## _foo_', '<em>foo</em>', '<h2><em>foo</em></h2>', 'h2'],
            ['## **foo**', '<strong>foo</strong>', '<h2><strong>foo</strong></h2>', 'h2'],
            ['## __foo__', '<strong>foo</strong>', '<h2><strong>foo</strong></h2>', 'h2'],
            ['## **_foo_**', '<strong><em>foo</em></strong>', '<h2><strong><em>foo</em></strong></h2>', 'h2'],
            ['## __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h2><strong>foo bar</strong> <em>boo</em></h2>', 'h2'],
            ['### foo', 'foo', '<h3>foo</h3>', 'h3'],
            ['### *foo*', '<em>foo</em>', '<h3><em>foo</em></h3>', 'h3'],
            ['### _foo_', '<em>foo</em>', '<h3><em>foo</em></h3>', 'h3'],
            ['### **foo**', '<strong>foo</strong>', '<h3><strong>foo</strong></h3>', 'h3'],
            ['### __foo__', '<strong>foo</strong>', '<h3><strong>foo</strong></h3>', 'h3'],
            ['### **_foo_**', '<strong><em>foo</em></strong>', '<h3><strong><em>foo</em></strong></h3>', 'h3'],
            ['### __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h3><strong>foo bar</strong> <em>boo</em></h3>', 'h3'],
            ['#### foo', 'foo', '<h4>foo</h4>', 'h4'],
            ['#### *foo*', '<em>foo</em>', '<h4><em>foo</em></h4>', 'h4'],
            ['#### _foo_', '<em>foo</em>', '<h4><em>foo</em></h4>', 'h4'],
            ['#### **foo**', '<strong>foo</strong>', '<h4><strong>foo</strong></h4>', 'h4'],
            ['#### __foo__', '<strong>foo</strong>', '<h4><strong>foo</strong></h4>', 'h4'],
            ['#### **_foo_**', '<strong><em>foo</em></strong>', '<h4><strong><em>foo</em></strong></h4>', 'h4'],
            ['#### __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h4><strong>foo bar</strong> <em>boo</em></h4>', 'h4'],
            ['##### foo', 'foo', '<h5>foo</h5>', 'h5'],
            ['##### *foo*', '<em>foo</em>', '<h5><em>foo</em></h5>', 'h5'],
            ['##### _foo_', '<em>foo</em>', '<h5><em>foo</em></h5>', 'h5'],
            ['##### **foo**', '<strong>foo</strong>', '<h5><strong>foo</strong></h5>', 'h5'],
            ['##### __foo__', '<strong>foo</strong>', '<h5><strong>foo</strong></h5>', 'h5'],
            ['##### **_foo_**', '<strong><em>foo</em></strong>', '<h5><strong><em>foo</em></strong></h5>', 'h5'],
            ['##### __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h5><strong>foo bar</strong> <em>boo</em></h5>', 'h5'],
            ['###### foo', 'foo', '<h6>foo</h6>', 'h6'],
            ['###### *foo*', '<em>foo</em>', '<h6><em>foo</em></h6>', 'h6'],
            ['###### _foo_', '<em>foo</em>', '<h6><em>foo</em></h6>', 'h6'],
            ['###### **foo**', '<strong>foo</strong>', '<h6><strong>foo</strong></h6>', 'h6'],
            ['###### __foo__', '<strong>foo</strong>', '<h6><strong>foo</strong></h6>', 'h6'],
            ['###### **_foo_**', '<strong><em>foo</em></strong>', '<h6><strong><em>foo</em></strong></h6>', 'h6'],
            ['###### __foo bar__ *boo*', '<strong>foo bar</strong> <em>boo</em>', '<h6><strong>foo bar</strong> <em>boo</em></h6>', 'h6'],
        ];
    }

    public function wrongDataProvider()
    {
        return [
            ['foo'],
            ['####### foo'],
            ['##foo'],
            ['foo ## bar']
        ];
    }

    public function elementTypeDataProvider()
    {
        return [
            ['header_1'],
            ['header_2'],
            ['header_3'],
            ['header_4'],
            ['header_5'],
            ['header_6'],
        ];
    }

    public function elementWrongTypeDataProvider()
    {
        return [
            ['content'],
            ['paragraph'],
            ['foo'],
        ];
    }
}
