<?php

namespace App\Entity;

use App\Repository\CurrentWeatherRequestRepository;
use App\Validator\DoCityExists;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrentWeatherRequestRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[DoCityExists]
class CurrentWeatherRequest
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $lat = null;

    #[ORM\Column]
    private ?float $lon = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $cityName = null;

    #[ORM\Column(length: 255)]
    private ?string $searchText = null;

    #[ORM\Column(nullable: true)]
    private ?float $averageTmp = null;

    #[ORM\Column(nullable: true)]
    private array $weatherDataDetails = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): self
    {
        $this->cityName = $cityName;

        return $this;
    }

    public function getSearchText(): ?string
    {
        return $this->searchText;
    }

    public function setSearchText(string $searchText): self
    {
        $this->searchText = $searchText;

        return $this;
    }

    public function getAverageTmp(): ?float
    {
        return $this->averageTmp;
    }

    public function getAverageTmpRounded(): int
    {
        return round($this->averageTmp);
    }

    public function setAverageTmp(?float $averageTmp): self
    {
        $this->averageTmp = $averageTmp;

        return $this;
    }

    public function getWeatherDataDetails(): array
    {
        return $this->weatherDataDetails;
    }

    public function setWeatherDataDetails(?array $weatherDataDetails): self
    {
        $this->weatherDataDetails = $weatherDataDetails;

        return $this;
    }

    public function addWeatherDataDetail(string $providerName, string|float $data): self
    {
        $this->weatherDataDetails[$providerName] = $data;

        return $this;
    }
}
