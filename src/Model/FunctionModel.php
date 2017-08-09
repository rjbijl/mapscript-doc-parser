<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\FunctionModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class FunctionModel
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

    private $arguments = [];


    private $description = [];

    /**
     * FunctionModel constructor.
     * @param string $name
     * @param string $returnType
     */
    public function __construct($name, $returnType)
    {
        $this->name = $name;
        $this->returnType = $returnType;
    }

    /**
     * Getter for name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     *
     * @param mixed $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Getter for arguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Setter for arguments
     *
     * @param array $arguments
     * @return self
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * Getter for returnType
     *
     * @return mixed
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Setter for returnType
     *
     * @param mixed $returnType
     * @return self
     */
    public function setReturnType($returnType)
    {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Getter for description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setter for description
     *
     * @param mixed $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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