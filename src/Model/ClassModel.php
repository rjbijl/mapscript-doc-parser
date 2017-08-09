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
     * ClassModel constructor.
     * @param string $className
     * @param array $members
     */
    public function __construct($className, array $members)
    {
        $this->className = $className;
        $this->members = $members;
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
}