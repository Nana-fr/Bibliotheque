<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", indexes={@ORM\Index(name="FK_categoryId", columns={"categoryId"}), @ORM\Index(name="FK_statusId", columns={"statusId"}), @ORM\Index(name="FK_writerId", columns={"writerId"}), @ORM\Index(name="FK_languageId", columns={"languageId"})})
 * @ORM\Entity
 */
class Book
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
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="plot", type="text", length=65535, nullable=false)
     */
    private $plot;

    /**
     * @var string
     *
     * @ORM\Column(name="publication_date", type="string", length=20, nullable=false)
     */
    private $publicationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="borrowing_date", type="date", nullable=true)
     */
    private $borrowingDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="returning_date", type="date", nullable=true)
     */
    private $returningDate;

    /**
     * @var \Writer
     *
     * @ORM\ManyToOne(targetEntity="Writer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="writerId", referencedColumnName="id")
     * })
     */
    private $writerid;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     * })
     */
    private $categoryid;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="statusId", referencedColumnName="id")
     * })
     */
    private $statusid;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     * })
     */
    private $languageid;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books")
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->plot;
    }

    public function setPlot(string $plot): self
    {
        $this->plot = $plot;

        return $this;
    }

    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(string $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->borrowingDate;
    }

    public function setBorrowingDate(?\DateTimeInterface $borrowingDate): self
    {
        $this->borrowingDate = $borrowingDate;

        return $this;
    }

    public function getReturningDate(): ?\DateTimeInterface
    {
        return $this->returningDate;
    }

    public function setReturningDate(?\DateTimeInterface $returningDate): self
    {
        $this->returningDate = $returningDate;

        return $this;
    }

    public function getWriterid(): ?Writer
    {
        return $this->writerid;
    }

    public function setWriterid(?Writer $writerid): self
    {
        $this->writerid = $writerid;

        return $this;
    }

    public function getCategoryid(): ?Category
    {
        return $this->categoryid;
    }

    public function setCategoryid(?Category $categoryid): self
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    public function getStatusid(): ?Status
    {
        return $this->statusid;
    }

    public function setStatusid(?Status $statusid): self
    {
        $this->statusid = $statusid;

        return $this;
    }

    public function getLanguageid(): ?Language
    {
        return $this->languageid;
    }

    public function setLanguageid(?Language $languageid): self
    {
        $this->languageid = $languageid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function generateReturningDate(\DateTimeInterface $date): self {
        $returning_date = $date->add(new \DateInterval('P14D'));
        $this->returningDate = $returning_date;
        return $this;
    }

}
