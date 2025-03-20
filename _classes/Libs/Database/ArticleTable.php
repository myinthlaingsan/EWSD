<?php
namespace Libs\Database;

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
                "INSERT INTO articles (user_id,setting_id,title,status, created_at) VALUES (:user_id,:setting_id,:title,:status, NOW())"
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
}
?>
