<?php
namespace Libs\Database;

use PDO;
use PDOException;

class ArticleTable {
    private $db;

    public function __construct(MySQL $mysql) {
        $this->db = $mysql->connect();
    }

    // Insert Article
    public function articleInsert($data) {
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
    public function insertDoc($data) {
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
    public function insertImage($data) {
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
    public function getArticlesByUserId($user_id){
        try{
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
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            exit();
        }
    }


}
?>
