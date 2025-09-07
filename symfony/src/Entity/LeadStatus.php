<?php

namespace App\Entity;

use App\Enum\LeadStatusType;
use App\Repository\LeadStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeadStatusRepository::class)]
class LeadStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'leadStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lead $lead = null;

    #[ORM\Column(enumType: LeadStatusType::class)]
    private ?LeadStatusType $status = null;

    #[ORM\Column]
    private ?bool $ftd = null;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeImmutable $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLead(): ?Lead
    {
        return $this->lead;
    }

    public function setLead(?Lead $lead): static
    {
        $this->lead = $lead;

        return $this;
    }

    public function getStatus(): ?LeadStatusType
    {
        return $this->status;
    }

    public function setStatus(LeadStatusType $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isFtd(): ?bool
    {
        return $this->ftd;
    }

    public function setFtd(bool $ftd): static
    {
        $this->ftd = $ftd;

        return $this;
    }
}
