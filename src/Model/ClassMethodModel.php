<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ClassMethodModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ClassMethodModel
{
    use ArgumentTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $returnType;

    /**
     * @var ArgumentModel[]
     */
    private $arguments;

    /**
     * @var string[]
     */
    private $description;

    /**
     * ClassMethodModel constructor.
     * @param string $name
     * @param string $returnType
     * @param array $arguments
     * @param array $description
     */
    public function __construct($name, $returnType, array $arguments = [], array $description = [])
    {
        $this->name = $name;
        $this->returnType = $returnType;
        $this->description = $description;
        $this->arguments = $arguments;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for description
     *
     * @return array
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Added for description
     *
     * @param $line
     * @return self
     */
    public function addDescription($line)
    {
        $this->description[] = $line;

        return $this;
    }

    /**
     * Getter for returnType
     *
     * @return string
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Getter for arguments
     *
     * @return ArgumentModel[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Get the argumentlist, to use in the template
     *
     * @return string
     */
    public function getArgumentList()
    {
        return $this->renderArgumentList($this->getArguments());
    }
}