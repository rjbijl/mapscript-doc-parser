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

    public function __construct($name)
    {
        $this->name = $name;
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
}