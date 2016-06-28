<?php

namespace PHPMarkdown\Parser;

use \PHPMarkdown\Element\Content;

/**
 * Abstract AbstractParser
 *
 * @package PHPMarkdown\Parser
 * @author  Mauro Moreno <moreno.mauro.emanuel@gmail.com>
 */
abstract class AbstractParser implements ParserInterface
{
    protected $content;

    /**
     * Set Content
     *
     * @param Content $content
     */
    public function setContent(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Get Content
     *
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }
}
