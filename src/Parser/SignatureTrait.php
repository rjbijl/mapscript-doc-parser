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
     * Check if the line contains a signature
     *
     * @param string $line
     * @return int
     */
    protected function isSignature($line)
    {
        // if the line starts with a space, it is not
        if (' ' === substr($line, 0, 1)) {
            return false;
        }

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

    /**
     * Get the arguments parsed from a signature
     *
     * @param $matches
     * @return array
     */
    protected function getArguments($matches)
    {
        $arguments = [];
        if (!isset($matches[3])) {
            return [];
        }

        $cleanedUpArguments = str_replace(['[', ']'], [''], $matches[3]);
        $argumentsParts = explode(',', $cleanedUpArguments);

        foreach ($argumentsParts as $argument) {
            $parts = explode(' ', trim($argument));
            $name = isset($parts[1]) ? $parts[1] : $parts[0];
            $type = isset($parts[1]) ? $parts[0] : '';

            $arguments[] = new ArgumentModel($name, $type);
        }

        return $arguments;
    }
}