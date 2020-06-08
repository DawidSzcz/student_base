<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Student
{
    use Timestamps;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $album_no;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="integer")
     */
    private $start_year;

    /**
     * @ORM\Column(type="integer")
     */
    private $semester;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $card_uid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getStartYear(): ?int
    {
        return $this->start_year;
    }

    public function setStartYear(int $start_year): self
    {
        $this->start_year = $start_year;

        return $this;
    }

    public function getSemester(): ?int
    {
        return $this->semester;
    }

    public function setSemester(int $semester): self
    {
        $this->semester = $semester;

        return $this;
    }

    public function getAlbumNo(): ?string
    {
        return $this->album_no;
    }

    public function setAlbumNo(string $album_no): self
    {
        $this->album_no = $album_no;

        return $this;
    }

    public function getCardUid(): ?string
    {
        return $this->card_uid;
    }

    public function setCardUid(string $card_uid): self
    {
        $this->card_uid = $card_uid;

        return $this;
    }
}
