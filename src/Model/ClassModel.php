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
     * ClassModel constructor.
     * @param string $className
     * @param ClassMemberModel[] $members
     * @param ClassMethodModel[] $methods
     */
    public function __construct($className, array $members, array $methods)
    {
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