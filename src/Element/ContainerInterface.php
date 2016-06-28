<?php

namespace PHPMarkdown\Element;

use PHPMarkdown\Exception\InvalidArgumentException;

/**
 * Interface ContainerInterface
 *
 * @package PHPMarkdown\Element
 */
interface ContainerInterface
{
    /**
     * Adds a children.
     *
     * @throws InvalidArgumentException
     *
     * @param ElementInterface $element
     */
    public function addElement(ElementInterface $element);

    /**
     * Check if the element has children.
     *
     * @return bool
     */
    public function hasElements();

    /**
     * Check if a type can be nested in this element.
     *
     * @param ElementInterface $element
     *
     * @return bool
     */
    public function isTypeAllowed(ElementInterface $element);

    /**
     * Set elements.
     *
     * @param array $elements
     */
    public function setElements($elements);

    /**
     * Get elements.
     *
     * @return array
     */
    public function getElements();
}
