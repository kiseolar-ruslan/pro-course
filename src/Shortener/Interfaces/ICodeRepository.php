<?php

namespace App\Shortener\Interfaces;

use App\Shortener\ValueObjects\UrlCodePair;
use App\Shortener\Exceptions\DataNotFoundException;

interface ICodeRepository
{
    /**
     * @param UrlCodePair $urlUrlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlUrlCodePair): bool;

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @return string url
     * @throws DataNotFoundException
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @return string code
     * @throws DataNotFoundException
     */
    public function getCodeByUrl(string $url): string;

}