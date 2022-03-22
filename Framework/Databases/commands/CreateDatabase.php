<?php

namespace Jet\Framework\Databases\commands;
use Jet\Framework\Databases\CreateDB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabase extends Command
{
    protected $title = "createdb";
    protected $description = "Creates a new database";

    protected $name = 'createdb';


    protected function configure()
    {
        $this
            ->setName($this->title)
            ->setDescription($this->description)
            ->setHelp("Helps to create the database.
            Takes optional database name which is the name of the database to create.
           Otherwise, will default to the database parameter passed in the DATABASES['default']['database'] in settings.php")
            ->addArgument(
                'database',
                InputArgument::OPTIONAL,
                'Database name, else will default to what is provided in the DATABASES configuration in settings.php',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('database') && !$GLOBALS['DATABASES']['default']['database']){
            $output->writeln("You either need to pass the database name or provide the the database value in your DATABASES configurations.");
            return 0;
        }
        elseif ($input->getArgument('database')){
            new CreateDB($input->getArgument('database'));
            return 0;
        }else{
            new CreateDB();
            return 0;
        }
    }
}
