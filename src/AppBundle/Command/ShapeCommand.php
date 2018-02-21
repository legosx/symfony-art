<?php

namespace AppBundle\Command;

use AppBundle\Entity\Shape;
use AppBundle\Repository\ShapeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Arr;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ShapeCommand extends ContainerAwareCommand
{
    /** @var SymfonyStyle */
    private $io;
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->entityManager = $em;
    }

    protected function configure()
    {
        $this
            ->setName('shape')
            ->setDescription('Output a shape')
            ->addOption('type', 't', InputOption::VALUE_OPTIONAL, 'Type of a shape')
            ->addOption('size', 's', InputOption::VALUE_OPTIONAL, 'Size of a shape');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption('type');
        $size = $input->getOption('size');

        /** @var ShapeRepository $rep */
        $rep = $this->entityManager->getRepository(Shape::class);

        if ($type && $size) {
            $shape = $rep->getShapeBy($type, $size);
        } else {
            if (!$type && !$size) {
                $shape = $rep->getShapeRandom();
            } else {
                throw new InvalidOptionException('Please, specify type and size');
            }
        }

        if (!$shape) {
            throw new CommandNotFoundException('Shape not found');
        }

        /** @var Shape $shape */
        $output->writeln($shape->getRaw());
    }

}
