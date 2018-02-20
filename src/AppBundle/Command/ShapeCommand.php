<?php

namespace AppBundle\Command;

use AppBundle\Entity\Shape;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Arr;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
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

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getOption('type') && null !== $input->getOption('size')) {
            return;
        }

        $type = $input->getOption('type');
        if (null !== $type) {
            $this->io->text(' > <info>Type</info>: ' . $type);
        } else {
            $map = Shape::$type_list;
            $type = $this->io->choice('Type', $map, Arr::get($map, Shape::TYPE_STAR));
            $type = Arr::get(array_flip($map), $type);
            $input->setOption('type', $type);
        }

        $size = $input->getOption('size');
        if (null !== $size) {
            $this->io->text(' > <info>Size</info>: ' . $size);
        } else {
            $map = Shape::$size_list;
            $size = $this->io->choice('Size', $map, Arr::get($map, Shape::SIZE_MEDIUM));
            $size = Arr::get(array_flip($map), $size);
            $input->setOption('size', $size);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rep = $this->entityManager->getRepository(Shape::class);
        /** @var Shape $shape */
        $shape = $rep->findOneBy([
            'type' => $input->getOption('type'),
            'size' => $input->getOption('size')
        ]);
        if (!$shape) {
            throw new CommandNotFoundException('Shape not found');
        }
        $output->writeln($shape->getRaw());
    }

}
