<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowingRepository::class)
 */
class Borrowing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="borrowings")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="borrowings")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $borrowingDate;

    /**
     * @ORM\Column(type="date")
     */
    private $returningDate;

    /**
     * @ORM\Column(type="date")
     */
    private $dueDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?book
    {
        return $this->book;
    }

    public function setBook(?book $book): self
    {
        $this->book = $book;

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

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->borrowingDate;
    }

    public function setBorrowingDate(\DateTimeInterface $borrowingDate): self
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
    
    public function generateReturningDate(\DateTimeInterface $date): self {
        $returning_date = $date ->add(new \DateInterval('P14D'));
        $this->dueDate = $returning_date;
        return $this;
    }

    public function getRemainingDays(\DateTimeInterface $date):string {
        $result = date_diff($date, date_create(date('Y-m-d')));
        $remainingDays = $result->format('%d');
        return $remainingDays;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }
}
