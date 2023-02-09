<?php

namespace Entity;

use Attributes\Table;
use Attributes\TargetRepository;
use Repositories\CommentRepository;

#[Table(name: "comments")]
#[TargetRepository(repositoryName: CommentRepository::class)]
class Comment extends AbstractEntity
{



    private int $id;

    private string $content;

    private int $film_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getFilmId(): int
    {
        return $this->film_id;
    }

    /**
     * @param int $film_id
     */
    public function setFilmId(int $film_id): void
    {
        $this->film_id = $film_id;
    }
}