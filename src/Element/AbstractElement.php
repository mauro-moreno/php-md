<?php

namespace PHPMarkdown\Element;

use \PHPMarkdown\Exception\InvalidArgumentException;

/**
 * Class AbstractElement
 *
 * @package PHPMarkdown\Element
 */
abstract class AbstractElement implements ElementInterface
{
    protected $htmlText;
    protected $rawContent;
    protected $text;
    protected $type;

    /**
     * AbstractElement constructor.
     *
     * @param string $markdownText
     */
    public function __construct($markdownText = '')
    {
        $this->setRawContent($markdownText);
        $this->setText($markdownText);
        $this->setHtmlText($this->getText());
        $this->setType(static::TYPES[0]);
    }

    /**
     * AbstractElement to string conversion.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getHtmlText();
    }

    /**
     * Parse a Markdown string.
     *
     * @param $markdownText
     *
     * @return string
     */
    public function parse($markdownText)
    {
        $patterns = [
            '/[*]{2}((?:\\\\\*|[^*]|[*][^*]*[*])+?)[*]{2}(?![*])/s',
            '/__((?:\\\\_|[^_]|_[^_]*_)+?)__(?!_)/us',
            '/[*]((?:\\\\\*|[^*]|[*][*][^*]+?[*][*])+?)[*](?![*])/s',
            '/_((?:\\\\_|[^_]|__[^_]*__)+?)_(?!_)\b/us',
        ];
        $replacements = [
            '<strong>$1</strong>',
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<em>$1</em>',
        ];

        return preg_replace($patterns, $replacements, $markdownText);
    }

    /**
     * @inheritdoc
     */
    public function setHtmlText($htmlText)
    {
        $this->htmlText = sprintf(static::FORMAT, $htmlText);
    }

    /**
     * @inheritdoc
     */
    public function getHtmlText()
    {
        return $this->htmlText;
    }

    /**
     * @inheritdoc
     */
    public function setRawContent($rawContent)
    {
        $this->rawContent = $rawContent;
    }

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
    public function setText($text)
    {
        $text = trim(preg_replace('/\s+/', ' ', $text));
        $this->text = $this->parse($text);
    }

    /**
     * @inheritdoc
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        if (false === array_search($type, static::TYPES)) {
            throw new InvalidArgumentException(
                sprintf('Type %s is not allowed for this element.', $type)
            );
        }
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }
}
