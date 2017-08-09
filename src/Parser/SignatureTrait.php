<?php

namespace Rjbijl\Parser;

use Rjbijl\Model\ArgumentModel;
use Rjbijl\Model\SignatureModel;

/**
 * Rjbijl\Parser\SignatureTrait
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
trait SignatureTrait
{
    /**
     * @var string
     */
    private $signatureRegex = '/(.*)\s(.*)\(((.*)\s(.*))*\)$/';

    /**
     * @param string $line
     * @return int
     */
    protected function isSignature($line)
    {
        return preg_match($this->signatureRegex, trim($line));
    }

    /**
     * @param string $signature
     * @return SignatureModel
     */
    protected function parseSignature($signature)
    {
        // parse the signature for the name and returnType
        preg_match($this->signatureRegex, trim($signature), $matches);

        return new SignatureModel($matches[2], $matches[1], $this->getArguments($matches));
    }

    protected function getArguments($matches)
    {
        $offset = 3;
        $arguments = [];
        while (isset($matches[$offset])) {
            $arguments[] = new ArgumentModel($matches[$offset + 2], $matches[$offset + 1]);
            $offset += 3;
        }

        return $arguments;
    }
}