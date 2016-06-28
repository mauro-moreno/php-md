<?php

namespace PHPMarkdown;

use \PHPMarkdown\Exception\LogicException;
use \PHPMarkdown\Parser\ParserInterface;

/**
 * Class Markdown
 *
 * @package PHPMarkdown
 */
class Markdown implements MarkdownInterface
{
    use MarkdownTrait;

    private $parser;

    /**
     * Markdown constructor.
     *
     * @param ParserInterface|null $parser     Parser
     * @param string|null          $rawContent String to be parsed
     */
    public function __construct(
        ParserInterface $parser = null,
        $rawContent = null
    ) {
        $this->setParser($parser);
        if (null !== $rawContent) {
            $this->setRawContent($rawContent);
        }
    }

    /**
     * Set raw content.
     *
     * @param string $rawContent String to be parsed
     *
     * @throws LogicException
     */
    public function setRawContent($rawContent)
    {
        if (null === $this->parser) {
            throw new LogicException(
                'A parser is required, configure one first.'
            );
        }
        $this->rawContent = $rawContent;
        $this->setContent($this->parser->parse($rawContent));
    }

    /**
     * Sets the parser.
     *
     * @param ParserInterface|null $parser
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
    }

    /**
     * Gets the parser.
     *
     * @return ParserInterface|null
     */
    public function getParser()
    {
        return $this->parser;
    }
}
