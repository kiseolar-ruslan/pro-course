<?php

declare(strict_types=1);

namespace App\ORM\ActiveRecord\Models;

use App\ORM\ActiveRecord\NormalModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends NormalModel
{
    protected const DEFAULT_STATUS = 0;

    protected $table      = 'users';
    public    $timestamps = false;

    private ?int $id     = null;
    private int  $status = self::DEFAULT_STATUS;

    public function __construct(
        private string $name = '',
        private string $email = '',
        array          $attributes = []
    ) {
        parent::__construct($attributes);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public static function getAll(): Collection
    {
        return User::query()->where('status', '>=', 0)->get();
    }

    public static function getActiveUsers(): Collection|array
    {
        return User::query()->where('status', 1)->get();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}