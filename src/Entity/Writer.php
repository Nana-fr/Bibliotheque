<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Writer
 *
 * @ORM\Table(name="writer", indexes={@ORM\Index(name="FK_nationalityId", columns={"nationalityId"})})
 * @ORM\Entity
 */
class Writer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var \Nationality
     *
     * @ORM\ManyToOne(targetEntity="Nationality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nationalityId", referencedColumnName="id")
     * })
     */
    private $nationalityid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNationalityid(): ?Nationality
    {
        return $this->nationalityid;
    }

    public function setNationalityid(?Nationality $nationalityid): self
    {
        $this->nationalityid = $nationalityid;

        return $this;
    }


}
