<?php

declare(strict_types=1);

namespace App\ORM\DataMapper\Entity;


use App\ORM\ActiveRecord\Models\Phone;
use App\ORM\DataMapper\Repositories\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
//#[PrivateProperties(['id', 'password', 'status'])]
class User implements \JsonSerializable
{
//    use JsonSerializableTrait;

    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE   = 1;
    public const STATUS_VIP      = 2;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 60)]
    private string $name;

//    #[ORM\Column(length: 32)]
//    private string $password;

//    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Phone::class, fetch: 'LAZY')]
//    private Collection $phones;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $status = 0;

    #[ORM\Column]
    private string $email;

    /**
     * @param string $name
     * @param string $email
     * @param int $status
     */
    public function __construct(string $name, string $email, int $status = self::STATUS_DISABLED)
    {
        $this->name = $name;
//        $this->changePassword($password);
        $this->status = $status;
        $this->email  = $email;
//        $this->phones = new ArrayCollection();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function changeName(string $name): void
    {
        $this->name = $name;
    }

//    /**
//     * @return mixed
//     */
//    public function getPassword(): string
//    {
//        return $this->password;
//    }

//    /**
//     * @param mixed $password
//     */
//    public function changePassword(string $password): void
//    {
//        $this->password = md5($password);
//    }

    public function isActiveUser(): bool
    {
        return $this->status === static::STATUS_ACTIVE;
    }

    public function isDisabledUser(): bool
    {
        return $this->status === static::STATUS_DISABLED;
    }

    public function isVIPUser(): bool
    {
        return $this->status === static::STATUS_VIP;
    }

    public function setStatusDisabled(): void
    {
        $this->status = static::STATUS_DISABLED;
    }

    public function setStatusActive(): void
    {
        $this->status = static::STATUS_ACTIVE;
    }

    public function setStatusVIP(): void
    {
        $this->status = static::STATUS_VIP;
    }


//    /**
//     * @return Collection
//     */
//    public function getPhones(): Collection
//    {
//        return $this->phones;
//    }

//    /**
//     * @param Phone $phone
//     */
//    public function addPhone(Phone $phone): void
//    {
//        $this->phones->add($phone);
//    }
//
    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}