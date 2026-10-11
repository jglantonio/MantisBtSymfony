<?php

namespace App\Entity;

use App\Repository\BugTextRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BugTextRepository::class)]
#[ORM\Table(name : 'mantis_bug_text_table')]
class BugText
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(name: 'description', type: 'string')]
    private string $description ;
    #[ORM\Column(name: 'steps_to_reproduce', type: 'string')]
    private string $stepsToReproduce;
    #[ORM\Column(name: 'additional_information', type: 'string')]
    private string $additionalInformation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStepsToReproduce(): string
    {
        return $this->stepsToReproduce;
    }

    public function setStepsToReproduce(string $stepsToReproduce): void
    {
        $this->stepsToReproduce = $stepsToReproduce;
    }

    public function getAdditionalInformation(): string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(string $additionalInformation): void
    {
        $this->additionalInformation = $additionalInformation;
    }

}
