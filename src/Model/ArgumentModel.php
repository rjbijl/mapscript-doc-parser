<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ArgumentModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class ArgumentModel
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
     * ArgumentModel constructor.
     * @param string$name
     * @param string $type
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
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
}