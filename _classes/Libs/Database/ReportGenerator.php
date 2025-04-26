<?php

namespace Libs\Database;

use PDO;
use Exception;
use PDOException;

class ReportGenerator
{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    // 1. Number of contributions within each Faculty for each academic year
    public function getContributionsByFacultyAndYear()
    {
        $query = "
            SELECT 
                f.faculty_name,
                a.academicyear,
                COUNT(a.article_id) AS contribution_count
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            GROUP BY f.faculty_name, a.academicyear
            ORDER BY a.academicyear, f.faculty_name
        ";

        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Percentage of contributions by each Faculty for any academic year
    public function getContributionPercentageByFaculty($academicYear)
    {
        
        $query = "
            SELECT 
                f.faculty_name,
                COUNT(a.article_id) AS contribution_count,
                ROUND(COUNT(a.article_id) * 100.0 / (
                    SELECT COUNT(*) 
                    FROM articles 
                    WHERE academicyear = :academic_year
                ), 2) AS percentage
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            WHERE a.academicyear = :academic_year
            GROUP BY f.faculty_name
            ORDER BY percentage DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':academic_year' => $academicYear
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Number of contributors within each Faculty for each academic year
    public function getContributorsByFacultyAndYear()
    {
        $query = "
            SELECT 
                f.faculty_name,
                a.academicyear,
                COUNT(DISTINCT a.user_id) AS contributor_count
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            GROUP BY f.faculty_name, a.academicyear
            ORDER BY a.academicyear DESC, f.faculty_name
        ";

        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Contributions without any comment
    public function getArticlesWithoutComments()
    {
        $query = "
            SELECT 
                a.article_id,
                a.title,
                u.name AS author,
                f.faculty_name,
                a.created_at
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            LEFT JOIN comments c ON a.article_id = c.article_id
            WHERE c.comment_id IS NULL
            ORDER BY a.created_at DESC
        ";

        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 5. Contributions without comment after 14 days
    public function getArticlesWithoutCommentsAfterDeadline()
    {
        $query = "
            SELECT 
                a.article_id,
                a.title,
                u.name AS author,
                f.faculty_name,
                a.created_at,
                DATEDIFF(NOW(), a.created_at) AS days_without_comment
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            LEFT JOIN comments c ON a.article_id = c.article_id
            WHERE c.comment_id IS NULL
            AND DATEDIFF(NOW(), a.created_at) > 14
            ORDER BY days_without_comment DESC
        ";

        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getClosureDate($academicYear)
    {
        $query = "SELECT closure_date FROM settings WHERE academicyear = :academic_year LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':academic_year' => $academicYear]);
        return $stmt->fetchColumn();
    }

    //get academicyear
    public function getacademicyear()
    {
        $query = "SELECT DISTINCT academicyear FROM articles ORDER BY academicyear DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function percentage($academicYear)
    {
        $fac_cont_perc_q = "
        SELECT
            f.faculty_name,
            (COUNT(a.article_id) * 100.0 / (
                SELECT COUNT(*) FROM articles WHERE academicyear = :academic_year
            )) AS contribution_percentage
        FROM articles a
        JOIN users u ON a.user_id = u.id
        JOIN faculties f ON u.faculty_id = f.id
        WHERE a.academicyear = :academic_year
        GROUP BY f.faculty_name
    ";

        $stmt = $this->db->prepare($fac_cont_perc_q);
        $stmt->execute([
            ':academic_year' => $academicYear
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesByFaculty()
    {
        $query = "
            SELECT f.faculty_name, COUNT(a.article_id) AS total_articles_by_faculty
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            GROUP BY f.faculty_name
        ";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
