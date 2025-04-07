<?php

namespace Libs\Database;

use PDO;
use Exception;
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
            SELECT 
                a.article_id,
                a.title,
                a.status,
                a.created_at,
                u.name,
                GROUP_CONCAT(DISTINCT d.docfile SEPARATOR '|||') as docfiles,
                GROUP_CONCAT(DISTINCT i.imagefile SEPARATOR '|||') as imagefiles
            FROM articles a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN doc_attachment d ON a.article_id = d.article_id
            LEFT JOIN img_attachment i ON a.article_id = i.article_id
            WHERE a.user_id = :user_id
            GROUP BY a.article_id
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
    public function getSelectedArticles($faculty_id)
    {
        try {
            $statement = $this->db->prepare("
            SELECT 
                a.article_id,
                a.title,
                a.status,
                a.created_at,
                u.name,
                f.faculty_name,
                GROUP_CONCAT(DISTINCT d.docfile SEPARATOR '|||') as docfiles,
                GROUP_CONCAT(DISTINCT i.imagefile SEPARATOR '|||') as imagefiles
            FROM articles a
            LEFT JOIN doc_attachment d ON a.article_id = d.article_id
            LEFT JOIN img_attachment i ON a.article_id = i.article_id
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN faculties f ON u.faculty_id = f.id
            WHERE a.status = 'selected'
            AND u.faculty_id = :faculty_id
            GROUP BY a.article_id, a.title, a.status, a.created_at, u.name, f.faculty_name
            ORDER BY a.created_at DESC
        ");
            $statement->execute(['faculty_id' => $faculty_id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Better error handling - log the error and return empty array
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    //get article by id
    public function getArticleById($article_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE article_id = :article_id");
        $stmt->execute([':article_id' => $article_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //get select contribution for article download
    public function getAllSelectedArticles()
    {
        try {
            $statement = $this->db->prepare("
                SELECT a.article_id,a.title,a.status,a.created_at,u.name,f.faculty_name,
                GROUP_CONCAT(DISTINCT d.docfile SEPARATOR '|||') as docfiles,
                GROUP_CONCAT(DISTINCT i.imagefile SEPARATOR '|||') as imagefiles
                FROM articles a
                LEFT JOIN doc_attachment d ON a.article_id = d.article_id
                LEFT JOIN img_attachment i ON a.article_id = i.article_id
                LEFT JOIN users u ON a.user_id = u.id
                LEFT JOIN faculties f on u.faculty_id = f.id
                WHERE a.status = 'selected'
                GROUP BY a.article_id, a.title, a.status, a.created_at, u.name, f.faculty_name
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
    public function getFacultyArticles($faculty_id)
    {
        try {
            $statement = $this->db->prepare("
            SELECT 
                a.article_id, 
                a.title, 
                a.status, 
                a.created_at,
                u.name AS student_name, 
                f.faculty_name,
                GROUP_CONCAT(DISTINCT d.docfile SEPARATOR '|||') AS docfiles,
                GROUP_CONCAT(DISTINCT i.imagefile SEPARATOR '|||') AS imagefiles
            FROM articles a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN faculties f ON u.faculty_id = f.id
            LEFT JOIN doc_attachment d ON a.article_id = d.article_id
            LEFT JOIN img_attachment i ON a.article_id = i.article_id
            WHERE u.faculty_id = :faculty_id
            GROUP BY a.article_id
            ORDER BY a.created_at DESC
        ");
            $statement->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error in getFacultyArticles: " . $e->getMessage());
            throw new Exception("Failed to fetch faculty articles");
        }
    }
    // get faculty student
    // public function getfacultyStudent($faculty_id){
    //     try{
    //         $statement-> = $this->db->prepare(
    //             "SELECT u.*, r.role_name from users u
    //             LEFT JOIN roles r ON u.id = r.user_id
    //             LEFT JOIN role_user ru u.id = ru.user_id
    //             WHERE r.role_name = 'Student'"
    //         );
    //     }catch(PDOException $e){
    //         echo "Error:" . $e->getMessage();
    //         exit();
    //     }
    // }
    //select faculty name
    public function getfacultyname($faculty_id)
    {
        try {
            $statement = $this->db->prepare(
                "SELECT faculty_name FROM faculties WHERE id = :faculty_id"
            );
            $statement->execute(['faculty_id' => $faculty_id]);
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    //get article faculty detail
    // public function articlebyfacultydetail($article_id)
    // {
    //     try {
    //         $statement = $this->db->prepare(
    //             "SELECT a.article_id,a.title,a.status,a.created_at,d.docfile,i.imagefile,u.name,f.faculty_name
    //             FROM articles a
    //             LEFT JOIN doc_attachment d ON a.article_id = d.article_id
    //             LEFT JOIN img_attachment i ON a.article_id = i.article_id
    //             LEFT JOIN users u ON a.user_id = u.id
    //             LEFT JOIN faculties f on u.faculty_id = f.id
    //             WHERE a.article_id = :article_id"
    //         );
    //         $statement->execute(['article_id' => $article_id]);
    //         return $statement->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         echo "Error:" . $e->getMessage();
    //         exit();
    //     }
    // }

    public function articlebyfacultydetail($article_id)
    {
        try {
            $statement = $this->db->prepare(
                "SELECT a.article_id, a.title, a.status, a.created_at,
             GROUP_CONCAT(DISTINCT d.docfile SEPARATOR ',') as documents,
             GROUP_CONCAT(DISTINCT i.imagefile SEPARATOR ',') as images,
             u.name, f.faculty_name
            FROM articles a
            LEFT JOIN doc_attachment d ON a.article_id = d.article_id
            LEFT JOIN img_attachment i ON a.article_id = i.article_id
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN faculties f ON u.faculty_id = f.id
            WHERE a.article_id = :article_id
            GROUP BY a.article_id"
            );
            $statement->execute(['article_id' => $article_id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }

    // insert notifications
    public function insertNotification(array $data): bool
    {
        try {
            $statement = $this->db->prepare(
                "INSERT INTO notifications (article_id,user_id,message,deadline_date) VALUES (:article_id,:user_id,:message,:deadline_date)"
            );
            return $statement->execute($data);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
    //get notifications by user_id
    // public function getNotiByuserId($article_id){
    //     try{
    //         $statement = $this->db->prepare(
    //             "SELECT * From notifications WHERE article_id = :article_id"
    //         );
    //         $statement->execute(['article_id' => $article_id]);
    //         return $statement->fetchAll(PDO::FETCH_ASSOC);
    //     }catch(PDOException $e){
    //         echo "Error:" . $e->getMessage();
    //         exit();
    //     }
    // }
    public function getCoordinatorNotifications($faculty_id)
    {
        try {
            $statement = $this->db->prepare("
            SELECT n.* 
            FROM notifications n
            JOIN users u ON n.user_id = u.id
            JOIN role_user ru ON u.id = ru.user_id
            JOIN roles r ON ru.role_id = r.id
            WHERE u.faculty_id = :faculty_id AND r.role_name = 'Coordinator'
        ");
            $statement->execute(['faculty_id' => $faculty_id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
    //get article with deadline
    public function getArticleWithDeadline($article_id)
    {
        try {
            $statement = $this->db->prepare(
                "SELECT a.*, n.deadline_date
                FROM articles a
                LEFT JOIN notifications n ON a.article_id = n.article_id
                WHERE a.article_id = :article_id
                LIMIT 1"
            );
            $statement->execute(['article_id' => $article_id]);
            return $statement->fetchColumn(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    //update status
    public function updateArticleStatus($article_id)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE articles SET status = 'selected' WHERE article_id = :article_id"
            );
            $statement->execute(['article_id' => $article_id]);
            return true;
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
    }
    //update article
    public function updateArticle($data)
    {
        try {
            $statement = $this->db->prepare(
                "UPDATE articles SET title = :title, status = :status, updated_at = NOW() WHERE article_id = :article_id"
            );
            $statement->execute($data);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function deleteArticleDocs($article_id)
    {
        try {
            $statement = $this->db->prepare("DELETE FROM doc_attachment WHERE article_id = :article_id");
            $statement->execute(["article_id" => $article_id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function deleteArticleImages($article_id)
    {
        try {
            $statement = $this->db->prepare("DELETE FROM img_attachment WHERE article_id = :article_id");
            $statement->execute(["article_id" => $article_id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    // articles without a comment
    public function getArticlesWithoutComment()
    {
        try {
            $statement = $this->db->prepare("
                SELECT a. * , f.faculty_name,u.name as student_name FROM articles a
                LEFT JOIN users u ON a.user_id = u.id
                LEFT JOIN faculties f ON u.faculty_id = f.id
                LEFT JOIN comments c ON a.article_id = c.article_id
                WHERE c.article_id IS NULL
            ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    // articles without a comment
    public function getArticlesWithoutComment14days()
    {
        try {
            $statement = $this->db->prepare("
                SELECT a. * , f.faculty_name,u.name as student_name FROM articles a
                LEFT JOIN users u ON a.user_id = u.id
                LEFT JOIN faculties f ON u.faculty_id = f.id
                LEFT JOIN comments c ON a.article_id = c.article_id
                WHERE c.article_id IS NULL
                AND DATEDIFF(NOW(), a.created_at) > 14
            ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    //coutn articles
    public function countArticles()
    {
        try {
            $statement = $this->db->prepare("
                SELECT COUNT(*) as total FROM articles
            ");
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    //count acricles created user
    public function articlesCreateUser()
    {
        try {
            $statement = $this->db->prepare("
            SELECT COUNT(DISTINCT user_id) AS total_users FROM articles;
            ");
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    //count faculties
    public function countFaculties()
    {
        try {
            $statement = $this->db->prepare("
                SELECT COUNT(*) as total FROM faculties
            ");
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    //count Coordinator
    public function countCoordinators()
    {
        try {
            $statement = $this->db->prepare("
                SELECT COUNT(*) as total FROM users 
                JOIN role_user ON users.id = role_user.user_id
                JOIN roles ON role_user.role_id = roles.id
                WHERE roles.role_name = 'Coordinator'
            ");
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }


    public function deleteArticle($article_id, $user_id)
    {
        try {
            $this->db->beginTransaction();

            // Step 1: Verify ownership
            $stmt = $this->db->prepare("SELECT user_id FROM articles WHERE article_id = :article_id");
            $stmt->execute([':article_id' => $article_id]);
            $article = $stmt->fetch();

            if (!$article) {
                $this->db->rollBack();
                return false; // Article not found
            }

            if ($article->user_id != $user_id) {
                $this->db->rollBack();
                return false; // Unauthorized
            }

            // Step 2: Delete related comments
            $stmt = $this->db->prepare("DELETE FROM comments WHERE article_id = :article_id");
            $stmt->execute([':article_id' => $article_id]);

            // Step 3: Delete document attachments
            $stmt = $this->db->prepare("DELETE FROM doc_attachment WHERE article_id = :article_id");
            $stmt->execute([':article_id' => $article_id]);

            // Step 4: Delete image attachments
            $stmt = $this->db->prepare("DELETE FROM img_attachment WHERE article_id = :article_id");
            $stmt->execute([':article_id' => $article_id]);

            // Step 5: Delete notifications
            $stmt = $this->db->prepare("DELETE FROM notifications WHERE article_id = :article_id");
            $stmt->execute([':article_id' => $article_id]);

            // Step 6: Delete the article itself
            $stmt = $this->db->prepare("DELETE FROM articles WHERE article_id = :article_id AND user_id = :user_id");
            $stmt->execute([
                ':article_id' => $article_id,
                ':user_id' => $user_id
            ]);

            $this->db->commit();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new PDOException("Article deletion failed: " . $e->getMessage());
        }
    }
}
