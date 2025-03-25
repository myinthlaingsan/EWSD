<?php

namespace Libs\Database;

use PDO;
use PDOException;

class ArticleTable
{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    // Insert Article
    public function articleInsert($data)
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO articles (user_id,title,status, created_at) VALUES (:user_id,:title,:status, NOW())"
            );
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    // Insert Document File
    public function insertDoc($data)
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO doc_attachment (article_id, docfile, created_at) VALUES (:article_id, :docfile, NOW())"
            );
            $statement->execute($data);
            return $this->db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    // Insert Image File
    public function insertImage($data)
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO img_attachment (article_id, imagefile, created_at) VALUES (:article_id, :imagefile, NOW())"
            );
            $statement->execute($data);
            return $this->db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    //select articles by insert student id
    public function getArticlesByUserId($user_id)
    {
        try {
            $statement = $this->db->prepare("
                SELECT a.article_id,a.title,a.status,a.created_at,d.docfile,i.imagefile from articles a
                LEFT JOIN doc_attachment d on a.article_id = d.article_id
                LEFT JOIN img_attachment i on a.article_id = i.article_id
                WHERE a.user_id = :user_id
                ORDER BY a.created_at DESC;
            ");
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
    // insert comment
    public function insertComment($data)
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO comments (user_id,article_id,comment_text,created_at,updated_at) VALUES (:user_id,:article_id,:comment_text,NOW(), NOW())"
            );
            $statement->execute($data);
            return $this->db;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    //select comment article_id
    public function getCommnetbyarticleid($article_id)
    {
        try {
            $statement = $this->db->prepare(
                "SELECT comments.*, roles.role_name
                FROM comments
                JOIN users ON comments.user_id = users.id
                JOIN role_user ON users.id = role_user.user_id
                JOIN roles ON role_user.role_id = roles.id
                WHERE comments.article_id = :article_id"
            );
            $statement->execute(['article_id' => $article_id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }

    //get select contribution for article download
    public function getSelectedArticles(){
        try{
            $statement = $this->db->prepare("
                SELECT a.article_id,a.title,a.status,a.created_at,d.docfile,i.imagefile,u.name,f.faculty_name
                FROM articles a
                LEFT JOIN doc_attachment d ON a.article_id = d.article_id
                LEFT JOIN img_attachment i ON a.article_id = i.article_id
                LEFT JOIN users u ON a.user_id = u.id
                LEFT JOIN faculties f on u.faculty_id = f.id
                WHERE a.status = 'selected'
                ORDER BY a.created_at DESC
            ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    //get articles by each faculty
    public function getFacultyArticles($faculty_id) {
        try {
            $statement = $this->db->prepare("
                SELECT a.article_id, a.title, a.status, a.created_at, 
                       d.docfile, i.imagefile, 
                       u.name AS student_name, f.faculty_name
                FROM articles a
                LEFT JOIN doc_attachment d ON a.article_id = d.article_id
                LEFT JOIN img_attachment i ON a.article_id = i.article_id
                LEFT JOIN users u ON a.user_id = u.id  -- Get student
                LEFT JOIN faculties f ON u.faculty_id = f.id  -- Get faculty
                WHERE u.faculty_id = :faculty_id
                ORDER BY a.created_at DESC
            ");
            $statement->execute(['faculty_id' => $faculty_id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    
}
