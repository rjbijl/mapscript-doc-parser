<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ConstantModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ConstantModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;
    /**
     * @var string
     */
    private $description;

    /**
     * ConstantModel constructor.
     * @param $name
     * @param $value
     * @param string $description
     */
    public function __construct($name, $value, $description = '')
    {
        $this->name = $name;
        $this->value = $value;
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
     * Getter for value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
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