<?php

namespace PHPMarkdown\Element;

/**
 * Interface ElementInterface
 * 
 * @package PHPMarkdown\Element
 */
interface ElementInterface
{
    /**
     * Set raw content.
     *
     * @param string $rawContent
     */
    public function setRawContent($rawContent);

    /**
     * Get raw content.
     *
     * @return string
     */
    public function getRawContent();

    /**
     * Set text.
     *
     * @param string $text
     */
    public function setText($text);

    /**
     * Get text.
     *
     * @return string
     */
    public function getText();

    /**
     * Set type.
     *
     * @param string $type
     */
    public function setType($type);

    /**
     * Get type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set HTML text.
     *
     * @param string $htmlText
     */
    public function setHtmlText($htmlText);

    /**
     * Get HTML text.
     *
     * @return string
     */
    public function getHtmlText();
}
