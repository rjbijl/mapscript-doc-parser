<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ClassMemberModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ClassMemberModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * ClassMemberModel constructor.
     * @param string $name
     * @param string $type
     * @param string $description
     */
    public function __construct($name, $type, $description = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
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
     * Getter for type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Getter for description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}