<?php

namespace PHPMarkdown;

/**
 * Interface MarkdownInterface
 *
 * @package PHPMarkdown
 */
interface MarkdownInterface
{
    /**
     * Set raw content.
     *
     * @param $rawContent
     */
    public function setRawContent($rawContent);

    /**
     * Get raw content.
     *
     * @return string
     */
    public function getRawContent();

    /**
     * Set content.
     *
     * @param mixed $content Content data.
     */
    public function setContent($content);

    /**
     * Get content
     *
     */
    public function getContent();
}
