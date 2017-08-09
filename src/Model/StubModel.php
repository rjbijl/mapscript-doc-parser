<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\StubModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class StubModel
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var ConstantModel[]
     */
    private $constants;

    /**
     * @var FunctionModel[]
     */
    private $functions;

    /**
     * @var ClassModel[]
     */
    private $classes;

    /**
     * StubModel constructor.
     * @param string $source
     * @param array $constants
     * @param array $functions
     * @param array $classes
     */
    public function __construct($source, array $constants, array $functions, array $classes)
    {
        $this->constants = $constants;
        $this->functions = $functions;
        $this->classes = $classes;
        $this->source = $source;
    }

    /**
     * Getter for constants
     *
     * @return ConstantModel[]
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * Getter for functions
     *
     * @return FunctionModel[]
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * Getter for classes
     *
     * @return ClassModel[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Getter for source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}