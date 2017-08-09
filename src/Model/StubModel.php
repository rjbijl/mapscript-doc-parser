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
     * @param array $constants
     * @param array $functions
     * @param array $classes
     */
    public function __construct(array $constants, array $functions, array $classes)
    {
        $this->constants = $constants;
        $this->functions = $functions;
        $this->classes = $classes;
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
}