<?php

namespace PHPMarkdown\Parser;

use \PHPMarkdown\Element\Content;
use \PHPMarkdown\Element\Header;
use \PHPMarkdown\Element\Paragraph;

/**
 * Class BasicParser
 *
 * @package PHPMarkdown\Parser
 */
class BasicParser extends AbstractParser
{
    const NEWLINE_REGEXP = '/(\r|\n){2,}/';

    /**
     * Parses a Markdown string.
     *
     * @param string $markdownText
     * 
     * @return Content
     */
    public function parse($markdownText)
    {
        $this->setContent(new Content($markdownText));

        $markdownElements = preg_split(self::NEWLINE_REGEXP, $markdownText);
        foreach ($markdownElements as $element) {
            if (preg_match(Header::FORMAT, $element)) {
                $this->getContent()->addElement(new Header($element));
                continue;
            }
            if ('' !== $element) {
                $this->getContent()->addElement(new Paragraph($element));
            }
        }

        return $this->getContent();
    }
}
