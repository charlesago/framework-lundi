<?php

namespace Repositories;

use Attributes\TargetEntity;
use Entity\Comment;
use Entity\Film;

#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends AbstractRepository
{
    public function findAllByFilm(Film $film){

        $query= $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE film_id= :film_id");

        $query->execute(["film_id"=>$film->getId()]);
        $comment = $query->fetchAll(\PDO::FETCH_CLASS, get_class($this->targetEntity));


        return $comment;
    }

    public function insert(Comment $comment){
        $request = $this->pdo->prepare("INSERT INTO {$this->tableName} SET film_id = :film_id, content = :content");


        $request->execute([
            "film_id"=> $comment->getFilmId(),
            "content"=>$comment->getContent()
        ]);
    }
    public function update(\Entity\Comment $comment){
        $requete = $this->pdo->prepare("UPDATE {$this->tableName} SET content = :content WHERE id = :id");
        $requete->execute([
            'id'=>$comment->getId(),
            'content'=>$comment->getContent(),
        ]);
    }
}