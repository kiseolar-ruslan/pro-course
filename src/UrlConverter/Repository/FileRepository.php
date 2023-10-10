<?php

declare(strict_types=1);

namespace App\UrlConverter\Repository;

use App\UrlConverter\Interfaces\ICodeRepository;
use InvalidArgumentException;

class FileRepository implements ICodeRepository
{
    protected const DEFAULT_FILE_NAME = 'url.json';
    protected array $dataContainer = [];

    public function __construct(protected string $dataFileName = self::DEFAULT_FILE_NAME)
    {
        $this->getDataFromStorage();
    }

    public function getDataFromStorage(): void
    {
        if (file_exists($this->dataFileName) === true) {
            $content = file_get_contents($this->dataFileName);
            $this->dataContainer = (array)json_decode($content, true);
        }
    }

    public function CodeIsset(string $code): bool
    {
        return isset($this->dataContainer[$code]);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getUrlByCode(string $code): string
    {
        if ($this->codeIsset($code) === false) {
            throw new InvalidArgumentException();
        }

        return $this->dataContainer[$code];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getCodeByUrl(string $url): string
    {
        if (false === $key = array_search($url, $this->dataContainer)) {
            throw new InvalidArgumentException();
        }

        return $key;
    }
}