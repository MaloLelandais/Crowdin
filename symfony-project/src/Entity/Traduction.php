<?php

namespace App\Entity;

use App\Repository\TraductionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraductionRepository::class)]
class Traduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $lang_from;

    #[ORM\Column(type: 'string', length: 255)]
    private $lang_to;

    #[ORM\Column(type: 'string', length: 255)]
    private $project;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $result;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'traductions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangFrom(): ?string
    {
        return $this->lang_from;
    }

    public function setLangFrom(string $lang_from): self
    {
        $this->lang_from = $lang_from;

        return $this;
    }

    public function getLangTo(): ?string
    {
        return $this->lang_to;
    }

    public function setLangTo(string $lang_to): self
    {
        $this->lang_to = $lang_to;

        return $this;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(string $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
