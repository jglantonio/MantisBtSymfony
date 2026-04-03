<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\Table(name : 'mantis_project_table')]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 129)]
    private ?string $name = null;

    #[ORM\Column(length: 6)]
    private ?string $status = null;

    #[ORM\Column(length: 4)]
    private ?string $enabled = null;

    #[ORM\Column(name: 'view_state' ,type: 'string',nullable: true )]
    private ?string $viewState = null;

    #[ORM\Column(name: 'access_min' ,type: 'string',nullable: true )]
    private ?string $accessMin = null;

    #[ORM\Column(name: 'file_path' ,type: 'string',nullable: true )]
    private ?string $filePath = null;

    #[ORM\Column(name: 'description' ,type: 'string',nullable: true )]
    private ?string $description = null;

    #[ORM\Column(name: 'category_id' ,type: 'integer',nullable: true )]
    private ?string $categoryId = null;

    private Category $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getEnabled(): ?string
    {
        return $this->enabled;
    }

    public function setEnabled(string $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }
}
