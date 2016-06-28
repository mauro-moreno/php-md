<?php

namespace PHPMarkdown\Element;

/**
 * Class Content
 *
 * @package PHPMarkdown\Element
 */
class Content extends AbstractContainer
{
    const FORMAT = '';
    const TYPES  = ['content'];

    /**
     * @inheritdoc
     */
    public function setHtmlText($htmlText)
    {
        $this->htmlText = '';
    }

    /**
     * @inheritdoc
     */
    public function setText($text)
    {
        return;
    }
}
