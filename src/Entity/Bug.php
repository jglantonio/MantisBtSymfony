<?php

namespace App\Entity;

use AllowDynamicProperties;
use App\Repository\BugRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\SecurityBundle\Security;

#[AllowDynamicProperties]
#[ORM\Entity(repositoryClass: BugRepository::class)]
#[ORM\Table(name : 'mantis_bug_table')]
class Bug
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'project_id' ,type: 'integer',nullable: true )]
    private ?int $projectId = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'bugs')]
    private Project $project;

    #[ORM\Column(name: 'reporter_id' ,type: 'integer',nullable: true )]
    private ?int $reporterId = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User $reporter;

    #[ORM\Column(name: 'handler_id' ,type: 'integer',nullable: true )]
    private ?int $handlerId = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User  $handler;

    #[ORM\Column(name: 'duplicated_id' ,type: 'integer',nullable: true )]
    private ?int $duplicatedId = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column(name: 'last_updated' ,type: 'integer',nullable: true )]
    private ?int $lastUpdated = null;

    #[ORM\Column(name: 'date_submitted' ,type: 'integer',nullable: true )]
    private ?int $dateSubmitted = null;

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

    #[ORM\Column(name: 'category_id' ,type: 'integer',nullable: true )]
    private ?int $categoryId = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'bugs')]
    private Category  $category;
    #[ORM\Column]
    private ?int $bug_text_id = null;

    #[ORM\Column]
    private ?string $summary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?object
    {
        return $this->project;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setProjectId(int $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getReporterId(): ?int
    {
        return $this->reporterId;
    }

    public function setReporterId(int $reporterId): static
    {
        $this->reporterId = $reporterId;

        return $this;
    }

    public function getHandler(): ?object
    {
        return $this->handler;
    }
    public function getReporter(): ?object
    {
        return $this->handler;
    }

    public function setHandlerId(int $handlerId): static
    {
        $this->handlerId = $handlerId;

        return $this;
    }

    public function getLastUpdated(){
        return date('Y-m-d H:i:s', $this->lastUpdated);
    }
    public function getDateSubmitted() {
        return date('Y-m-d H:i:s', $this->dateSubmitted);
    }
    public function getPriority(){
        return "Alta";
    }
    public function setPriority(int $priority)
    {
        $this->priority = $priority;
        return $this;
    }
    public function getStatus(){
        return "Ok";
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setDuplicatedId(int $duplicatedId)
    {
        $this->duplicatedId = $duplicatedId;
    }

    public function setSeverity(int $severity)
    {
        $this->severity = $severity;
    }
    public function setReproducibility(int $reproducibility)
    {
        $this->reproducibility = $reproducibility;
        return $this;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    public function setResolution(int $resolution)
    {
        $this->resolution = $resolution;
        return $this;
    }

    public function setProjection(int $projection)
    {
        $this->projection = $projection;
        return $this;
    }

    public function setEta(int $eta)
    {
        $this->eta = $eta;
        return $this;
    }

    public function setBugTextId(int $bugTextId)
    {
        $this->bugTextId = $bugTextId;
        return $this;
    }

    public function setProfileId(int $profileId)
    {
        $this->profileId = $profileId;
        return $this;
    }

    public function setViewState(int $viewState)
    {
        $this->viewState = $viewState;
        return $this;
    }

    public function setSummary(string $summary)
    {
        $this->summary = $summary;
        return $this;
    }

    public function setSponshorshipTotal(int $sponshorshipTotal)
    {
        $this->sponshorshipTotal = $sponshorshipTotal;
        return $this;
    }

    public function setSticky(int $sticky)
    {
        $this->sticky = $sticky;
        return $this;
    }
    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setDateSubmitted(int $dateSubmited)
    {
        $this->dateSubmitted = $dateSubmited;
        return $this;
    }

    public function setDueDat(int $dueDat)
    {
        $this->dueDat = $dueDat;
        return $this;
    }

    public function setLastUpdated(int $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }
}
