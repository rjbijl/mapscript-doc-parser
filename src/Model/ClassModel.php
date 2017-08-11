<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ClassModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ClassModel
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var ClassMemberModel[]
     */
    private $members;

    /**
     * @var ClassMethodModel[]
     */
    private $methods;

    /**
     * @var ClassMethodModel[]
     */
    private $constructors;

    /**
     * @var string[]
     */
    private $descriptions;

    /**
     * ClassModel constructor.
     * @param string $className
     * @param ClassMethodModel[] $constructors
     * @param string[] $descriptions
     * @param ClassMemberModel[] $members
     * @param ClassMethodModel[] $methods
     */
    public function __construct($className, array $constructors, array $descriptions, array $members, array $methods)
    {
        $this->constructors = $constructors;
        $this->descriptions = $descriptions;
        $this->className = $className;
        $this->members = $members;
        $this->methods = $methods;
    }

    /**
     * Getter for className
     *
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Getter for constructors
     *
     * @return ClassMethodModel[]
     */
    public function getConstructors()
    {
        return $this->constructors;
    }

    /**
     * Getter for descriptions
     *
     * @return string[]
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * Getter for members
     *
     * @return ClassMemberModel[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Getter for methods
     *
     * @return ClassMethodModel[]
     */
    public function getMethods()
    {
        return $this->methods;
    }
}