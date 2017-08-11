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
    private $signatureRegex = '/([^=\s]+)\s([^=\s]+)\((([^=]*)\s([^=]*))*\)$/';

    /**
     * @var string
     */
    private $constructorSignatureRegex = '/new\s(.*)\(((.*)\s(.*))*\)$/';

    /**
     * Check if the line contains a signature
     *
     * @param string $line
     * @param bool $constructor
     * @return int
     */
    protected function isSignature($line, $constructor = false)
    {
        $regex = $constructor ? $this->constructorSignatureRegex : $this->signatureRegex;
        // if the line starts with a space, it is not
        if (' ' === substr($line, 0, 1)) {
            return false;
        }

        return preg_match($regex, trim($line));
    }

    /**
     * @param string $signature
     * @return SignatureModel
     */
    protected function parseSignature($signature)
    {
        // parse the signature for the name and returnType
        preg_match($this->signatureRegex, trim($signature), $matches);

        return new SignatureModel($matches[2], $matches[1], $this->getArguments($matches, 3));
    }

    /**
     * @param string $signature
     * @return SignatureModel
     */
    protected function parseConstructorSignature($signature)
    {
        // parse the signature for the name and returnType
        preg_match($this->constructorSignatureRegex, trim($signature), $matches);

        return new SignatureModel($matches[1], $matches[1], $this->getArguments($matches, 2));
    }

    /**
     * Get the arguments parsed from a signature
     *
     * @param array $matches
     * @param int $index
     * @return array
     */
    protected function getArguments(array $matches, $index)
    {
        $arguments = [];
        if (!isset($matches[$index])) {
            return [];
        }

        $cleanedUpArguments = str_replace(['[', ']'], [''], $matches[$index]);
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