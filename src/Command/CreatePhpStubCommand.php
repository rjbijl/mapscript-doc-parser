<?php

namespace Rjbijl\Command;

use Rjbijl\Parser\ConstantsParser;
use Rjbijl\Parser\FunctionsParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Rjbijl\Command\CreatePhpStubCommand
 *
 * @author Robert-Jan Bijl <rjbijl@gmail.com>
 */
class CreatePhpStubCommand extends Command
{
    /**
     * @var string
     */
    private $currentSection = null;

    /**
     * @var array
     */
    private $readSections = [];

    /**
     * @var array
     */
    private $parsedSections = [];

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('create-stub')
            ->setDescription('Create a php stub for mapscript, based on the docs')
            ->setHelp('Create a php stub for mapscript, based on the docs')
            ->addOption('source-file', 's', InputOption::VALUE_REQUIRED, 'The file containing the source for the docs',
                'https://raw.githubusercontent.com/mapserver/docs/branch-7-0/en/mapscript/php/phpmapscript.txt')
            ->addOption('target-file', 't', InputOption::VALUE_REQUIRED, 'Path of the generated file', 'mapserver.php')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // open the document
        $docs = fopen($input->getOption('source-file'), 'r');

        $this->readFile($output, $docs);

        $this->parseConstants($output);
        $this->parseFunctions($output);
        $this->parseClasses($output);

        $this->writeStub($output);

        exit(0);
    }

    private function readFile(OutputInterface $output, $docs)
    {
        // and iterate over it, to
        while (!feof($docs)) {
            $line = fgets($docs);
            switch (trim($line)) {
                case 'Functions':
                    $output->writeln('Reading global functions');
                    if ($this->currentSection !== 'classes') {
                        $this->currentSection = 'functions';
                    }
                    break;
                case 'Classes':
                    $output->writeln('Reading global classes');
                    $this->currentSection = 'classes';
                    break;
                case 'Constants':
                    $output->writeln('Reading global constants');
                    $this->currentSection = 'constants';
                    break;
                default:
                    if (null !== $this->currentSection) {
                        $this->readSections[$this->currentSection][] = $line;
                    }
                    break;
            }
        }
    }

    /**
     * @param OutputInterface $output
     * @return array
     */
    private function parseConstants(OutputInterface $output)
    {
        $parser = new ConstantsParser();
        if ($output->isVerbose()) {
            $output->writeln('Parsing constants');
        }

        $parsedConstants = $parser->parse($this->readSections['constants']);

        if ($output->isVerbose()) {
            $output->writeln('Finished constants');
        }

        return $this->parsedSections['constants'] = $parsedConstants;
    }

    /**
     * @param OutputInterface $output
     * @return array
     */
    private function parseFunctions(OutputInterface $output)
    {
        $parser = new FunctionsParser();
        if ($output->isVerbose()) {
            $output->writeln('Parsing functions');
        }

        $parsedFunctions = $parser->parse($this->readSections['functions']);

        if ($output->isVerbose()) {
            $output->writeln('Finished functions');
        }

        return $this->parsedSections['functions'] = $parsedFunctions;
    }

    /**
     * @param OutputInterface $output
     * @return array
     */
    private function parseClasses(OutputInterface $output)
    {
    }

    /**
     * @param OutputInterface $output
     */
    private function writeStub(OutputInterface $output)
    {

    }
}