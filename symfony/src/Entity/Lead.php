<?php

namespace App\Entity;

use App\Repository\LeadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeadRepository::class)]
class Lead
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 2)]
    private ?string $country_code = null;

    #[ORM\Column]
    private ?int $box_id = null;

    #[ORM\Column]
    private ?int $offer_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $landing_url = null;

    #[ORM\Column(length: 40)]
    private ?string $ip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $language = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $click_id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $quiz_answers = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $custom1 = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $custom2 = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $custom3 = null;

    #[ORM\Column(type: "datetime", options: ["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeImmutable $createdAt;

    /**
     * @var Collection<int, LeadStatus>
     */
    #[ORM\OneToMany(targetEntity: LeadStatus::class, mappedBy: 'lead', orphanRemoval: true)]
    private Collection $leadStatuses;

    public function __construct()
    {
        $this->leadStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $firstName): static
    {
        $this->first_name = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $lastName): static
    {
        $this->last_name = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $countryCode): static
    {
        $this->country_code = $countryCode;

        return $this;
    }

    public function getBoxId(): ?int
    {
        return $this->box_id;
    }

    public function setBoxId(int $box_id): static
    {
        $this->box_id = $box_id;

        return $this;
    }

    public function getOfferId(): ?int
    {
        return $this->offer_id;
    }

    public function setOfferId(int $offer_id): static
    {
        $this->offer_id = $offer_id;

        return $this;
    }

    public function getLandingUrl(): ?string
    {
        return $this->landing_url;
    }

    public function setLandingUrl(string $landing_url): static
    {
        $this->landing_url = $landing_url;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getClickId(): ?string
    {
        return $this->click_id;
    }

    public function setClickId(string $click_id): static
    {
        $this->click_id = $click_id;

        return $this;
    }

    /**
     * @return Collection<int, LeadStatus>
     */
    public function getLeadStatuses(): Collection
    {
        return $this->leadStatuses;
    }

    public function addLeadStatus(LeadStatus $leadStatus): static
    {
        if (!$this->leadStatuses->contains($leadStatus)) {
            $this->leadStatuses->add($leadStatus);
            $leadStatus->setLead($this);
        }

        return $this;
    }

    public function removeLeadStatus(LeadStatus $leadStatus): static
    {
        if ($this->leadStatuses->removeElement($leadStatus)) {
            // set the owning side to null (unless already changed)
            if ($leadStatus->getLead() === $this) {
                $leadStatus->setLead(null);
            }
        }

        return $this;
    }
}
