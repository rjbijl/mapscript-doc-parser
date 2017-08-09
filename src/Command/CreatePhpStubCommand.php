<?php

namespace Rjbijl\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Rjbijl\Command\CreatePhpStubCommand
 *
 * @author Robert-Jan Bijl <rjbijl@gmail.com>
 */
class CreatePhpStubCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('create-stub')
            ->setDescription('Create a php stub for mapscript, based on the docs')
            ->setHelp('Create a php stub for mapscript, based on the docs')
            ->addArgument('source-file', InputArgument::OPTIONAL, 'The file containing the source for the docs',
                'https://raw.githubusercontent.com/mapserver/docs/branch-7-0/en/mapscript/php/phpmapscript.txt');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $contents = file_get_contents($input->getArgument('source-file'));

        exit(0);
    }
}