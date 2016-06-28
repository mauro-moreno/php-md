<?php

namespace PHPMarkdown\Element;

use \PHPMarkdown\Exception\InvalidArgumentException;

/**
 * Class AbstractContainer
 *
 * @package PHPMarkdown\Element
 */
abstract class AbstractContainer extends AbstractElement
    implements ContainerInterface
{
    protected $elements     = [];
    protected $elementTypes = [
        'content',  'header_1',  'header_2',
        'header_3', 'header_4',  'header_5',
        'header_6', 'paragraph',
    ];
    protected $forbidden    = [];

    /**
     * @inheritdoc
     */
    public function hasElements()
    {
        return count($this->getElements()) > 0;
    }

    /**
     * @inheritdoc
     */
    public function isTypeAllowed(ElementInterface $element)
    {
        return in_array(
            $element->getType(),
            array_diff($this->elementTypes, $this->forbidden)
        );
    }

    /**
     * @inheritdoc
     */
    public function addElement(ElementInterface $element)
    {
        if (!$this->isTypeAllowed($element)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Element type %s cannot be added to this element',
                    $element->getType()
                )
            );
        }
        $this->elements[] = $element;
    }

    /**
     * @inheritdoc
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @inheritdoc
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @inheritdoc
     */
    public function getHtmlText()
    {
        $htmlText = $this->htmlText;
        foreach ($this->getElements() as $element) {
            $htmlText .= $element;
        }
        return $htmlText;
    }
}
