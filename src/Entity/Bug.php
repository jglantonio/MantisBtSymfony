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
    private ?int $id;

    #[ORM\Column(name: 'project_id' ,type: 'integer',nullable: true )]
    private ?int $projectId;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'bugs')]
    private Project $project;

    #[ORM\Column(name: 'reporter_id' ,type: 'integer',nullable: true )]
    private ?int $reporterId;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User $reporter;

    #[ORM\Column(name: 'handler_id' ,type: 'integer',nullable: true )]
    private ?int $handlerId;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bugs')]
    private User  $handler;

    #[ORM\Column(name: 'duplicated_id' ,type: 'integer',nullable: true )]
    private ?int $duplicatedId;

    #[ORM\Column]
    private ?int $priority;

    #[ORM\Column(name: 'last_updated' ,type: 'integer',nullable: true )]
    private ?int $lastUpdated;

    #[ORM\Column(name: 'date_submitted' ,type: 'integer',nullable: true )]
    private ?int $dateSubmitted;

    #[ORM\Column(name: 'bug_text_id' ,type: 'integer',nullable: true )]
    private ?int $bugTextId;

    #[ORM\Column]
    private ?int $severity;

    #[ORM\Column]
    private ?int $reproducibility;

    #[ORM\Column]
    private ?int $status;

    #[ORM\Column]
    private ?int $resolution;

    #[ORM\Column]
    private ?int $eta;

    #[ORM\Column(name: 'category_id' ,type: 'integer',nullable: true )]
    private ?int $categoryId;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'bugs')]
    private Category  $category;
    #[ORM\Column]
    private ?string $summary;

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

    public function setProjectId(int $projectId): static
    {
        $this->projectId = $projectId;

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
