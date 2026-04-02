<?php

namespace App\Entity;

use App\Repository\BugEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BugEntityRepository::class)]
#[ORM\Table(name : 'mantis_bug_table')]
class BugEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $project_id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private ?int $reporter_id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private ?int $handler_id = null;

    #[ORM\Column]
    private ?int $duplicate_id = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column]
    private ?int $severity = null;

    #[ORM\Column]
    private ?int $reproducibility = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $resolution = null;

    #[ORM\Column]
    private ?int $eta = null;

    #[ORM\Column]
    private ?int $bug_text_id = null;

    #[ORM\Column]
    private ?string $summary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    public function setProjectId(int $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getReporterId(): ?int
    {
        return $this->reporter_id;
    }

    public function setReporterId(int $reporter_id): static
    {
        $this->reporter_id = $reporter_id;

        return $this;
    }

    public function getHandlerId(): ?int
    {
        return $this->handler_id;
    }

    public function setHandlerId(int $handler_id): static
    {
        $this->handler_id = $handler_id;

        return $this;
    }
}
