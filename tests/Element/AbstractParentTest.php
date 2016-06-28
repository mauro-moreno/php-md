<?php

namespace PHPMarkdown\Tests\Element;

// TODO: Should be called AbstractContainerTest but throws a Fatal Error
abstract class AbstractParentTest extends AbstractElementTest
    implements ContainerTestInterface
{
    /**
     * @dataProvider elementDataProvider
     */
    public function testNestableElement($type, $class, $type_compare, $expected)
    {
        $this->element->setType($type);
        $element = $this->createMock($class);
        $element->expects($this->once())->method('getType')
            ->willReturn($type_compare);
        $this->assertEquals($expected, $this->element->isTypeAllowed($element));
    }

    /**
     * @dataProvider      addElementWrongTypeDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testAddElementWrongType($type, $class, $type_compare)
    {
        $this->element->setType($type);
        $element = $this->createMock($class);
        $element->expects($this->exactly(2))->method('getType')
            ->willReturn($type_compare);
        $this->element->addElement($element);
    }

    /**
     * @dataProvider addElementDataProvider
     */
    public function testAddElement($type, $class, $type_compare)
    {
        $this->element->setType($type);
        $element = $this->createMock($class);
        $element->expects($this->once())->method('getType')
            ->willReturn($type_compare);
        $this->element->addElement($element);

        $this->assertTrue($this->element->hasElements());
        $this->assertEquals(1, count($this->element->getElements()));
    }
}
