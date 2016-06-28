<?php

namespace PHPMarkdown\Element;

use \PHPMarkdown\Exception\InvalidArgumentException;

/**
 * Class Header
 *
 * @package PHPMarkdown\Element
 */
class Header extends AbstractElement
{
    const FORMAT = '/^#{1,} /';
    const TYPES  = [
        'header_1', 'header_2', 'header_3',
        'header_4', 'header_5', 'header_6',
    ];

    private $htmlMarkup;

    /**
     * @inheritdoc
     */
    public function setRawContent($rawContent)
    {
        if ($rawContent !== '') {
            if (preg_match(self::FORMAT, $rawContent, $matches)) {
                $this->setType('header_' . (strlen($matches[0]) - 1));
            } else {
                throw new InvalidArgumentException(
                    'Malformed markdown header.'
                );
            }
        }

        parent::setRawContent($rawContent);
    }

    /**
     * Get HTML markup.
     *
     * @return string
     */
    public function getHtmlMarkup()
    {
        return $this->htmlMarkup;
    }

    /**
     * @inheritdoc
     */
    public function setHtmlText($htmlText)
    {
        $this->htmlText = sprintf(
            '<%2$s>%1$s</%2$s>',
            $htmlText,
            $this->htmlMarkup
        );
    }

    /**
     * @inheritdoc
     */
    public function setText($text)
    {
        $text = preg_replace(self::FORMAT, '', $text);
        parent::setText($text);
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        parent::setType($type);
        preg_match('/header_(\d)/', $type, $matches);
        $this->htmlMarkup = 'h' . $matches[1];
    }
}
