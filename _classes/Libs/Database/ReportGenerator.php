<?php
namespace Libs\Database;
use PDO;
use Exception;
use PDOException;

class ReportGenerator {
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    // 1. Number of contributions within each Faculty for each academic year
    public function getContributionsByFacultyAndYear() {
        $query = "
            SELECT 
                f.faculty_name,
                s.academicyear,
                COUNT(a.article_id) AS contribution_count
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            JOIN settings s ON 1=1  -- Assuming one active setting record
            WHERE YEAR(a.created_at) = YEAR(s.closure_date)
            GROUP BY f.faculty_name, s.academicyear
            ORDER BY s.academicyear, f.faculty_name
        ";
        
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Percentage of contributions by each Faculty for any academic year
    public function getContributionPercentageByFaculty($academicYear) {
        $query = "
            SELECT 
                f.faculty_name,
                COUNT(a.article_id) AS contribution_count,
                ROUND(COUNT(a.article_id) * 100.0 / (
                    SELECT COUNT(*) 
                    FROM articles 
                    WHERE YEAR(created_at) = YEAR(:closure_date)
                ), 2) AS percentage
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            JOIN settings s ON 1=1
            WHERE s.academicyear = :academic_year
            GROUP BY f.faculty_name
            ORDER BY percentage DESC
        ";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':academic_year' => $academicYear,
            ':closure_date' => $this->getClosureDate($academicYear)
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Number of contributors within each Faculty for each academic year
    public function getContributorsByFacultyAndYear() {
        $query = "
            SELECT 
                f.faculty_name,
                s.academicyear,
                COUNT(DISTINCT a.user_id) AS contributor_count
            FROM articles a
            JOIN users u ON a.user_id = u.id
            JOIN faculties f ON u.faculty_id = f.id
            JOIN settings s ON 1=1
            WHERE YEAR(a.created_at) = YEAR(s.closure_date)
            GROUP BY f.faculty_name, s.academicyear
            ORDER BY s.academicyear, f.faculty_name
        ";
        
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Contributions without any comment
    public function getArticlesWithoutComments() {
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
    public function getArticlesWithoutCommentsAfterDeadline() {
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

    private function getClosureDate($academicYear) {
        $query = "SELECT closure_date FROM settings WHERE academicyear = :academic_year LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':academic_year' => $academicYear]);
        return $stmt->fetchColumn();
    }
}
