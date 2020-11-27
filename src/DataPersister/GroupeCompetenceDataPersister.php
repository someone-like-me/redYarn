<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\GroupeCompetence;
use Doctrine\ORM\EntityManagerInterface;

class GroupeCompetenceDataPersister implements ContextAwareDataPersisterInterface
{
    private  $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof GroupeCompetence;
    }

    public function persist($data, array $context = [])
    {
        if (isset($context["collection_operation_name"]))
            $this->manager->persist($data);
        $this->manager->flush();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        $data->setIsDeleted(true);
        $this->manager->flush();
        return $data;
    }
}