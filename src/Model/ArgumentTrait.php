<?php

namespace Rjbijl\Model;

/**
 * Rjbijl\Model\ArgumentTrait
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
trait ArgumentTrait
{
    /**
     * @var array
     */
    protected $scalarTypes = ['int', 'integer', 'bool', 'boolean', 'string', 'float', 'double', 'const', 'char'];

    protected function renderArgumentList(array $arguments)
    {
        $parsedArguments = [];

        /** @var ArgumentModel $argument */
        foreach ($arguments as $argument) {
            if (in_array($argument->getType(), $this->scalarTypes)) {
                $parsedArguments[] = sprintf('$%s', $argument->getName());
            } else {
                $parsedArguments[] = sprintf('%s $%s', $argument->getType(), $argument->getName());
            }
        }

        return implode(', ', $parsedArguments);
    }
}