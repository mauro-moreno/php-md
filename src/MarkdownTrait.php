<?php

namespace PHPMarkdown;

/**
 * Class MarkdownTrait
 *
 * @package PHPMarkdown
 */
trait MarkdownTrait
{
    protected $rawContent;
    protected $content;

    /**
     * @inheritdoc
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * @inheritdoc
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return $this->content;
    }
}
