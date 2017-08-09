<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\FunctionModel;

/**
 * Rjbijl\Parser\FunctionsParser
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class FunctionsParser implements ParserInterface
{
    use SignatureTrait;

    /**
     * {@inheritdoc}
     */
    public function parse(array $lines)
    {
        $parsedFunctions = [];
        $functions = [];
        array_shift($lines);

        $function = '';
        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            // this indicates the end of the Functions sections
            if ('.. index::' === trim($line)) {
                break;
            }

            // find a function signature
            if ($this->isSignature($line)) {
                $function = trim($line);
                continue;
            }

            // all other lines are just comment
            $parsedFunctions[$function][] = trim($line);
        }

        foreach ($parsedFunctions as $signature => $descriptions) {
            $signatureModel = $this->parseSignature($signature);
            // parse the signature for the name and returnType
            $model = new FunctionModel($signatureModel->getName(), $signatureModel->getReturnType());
            $model->setArguments($signatureModel->getArguments());            
            $model->setDescription($descriptions);
            $functions[] = $model;
        }

        return $functions;
    }
}