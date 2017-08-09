<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\SignatureModel
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class SignatureModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $returnType;

    /**
     * @var ArgumentModel[]
     */
    private $arguments = [];

    /**
     * ArgumentModel constructor.
     * @param string $name
     * @param string $returnType
     * @param array $arguments
     */
    public function __construct($name, $returnType, $arguments = [])
    {
        $this->name = $name;
        $this->returnType = $returnType;
        $this->arguments = $arguments;
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
     * Getter for returnType
     *
     * @return string
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Getter for arguments
     *
     * @return ArgumentModel[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}