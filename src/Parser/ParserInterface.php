<?php

namespace PHPMarkdown\Parser;

use \PHPMarkdown\Element\Content;

/**
 * Interface ParserInterface
 *
 * @package PHPMarkdown\Parser
 */
interface ParserInterface
{
    /**
     * Parse a Markdown text
     *
     * @param $markdownText string
     *
     * @return mixed
     */
    public function parse($markdownText);

    /**
     * Set Content.
     *
     * @param Content $content Content elements
     */
    public function setContent(Content $content);

    /**
     * Get Content.
     *
     * @return Content
     */
    public function getContent();
}
