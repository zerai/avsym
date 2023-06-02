<?php declare(strict_types=1);

namespace Publishing\Cms\Adapter\HttpWeb\WebAdmin\Form\Dto;

class ArticleDto
{
    public string $title;

    public string $content;

    public ?\DateTimeImmutable $publicationStart = null;

    public ?\DateTimeImmutable $publicationEnd = null;
}
