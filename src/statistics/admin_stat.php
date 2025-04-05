<?php 
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'ewsd';
$port = '3306';

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}

// Total Student
//Total number of students in the entire university

$total_students_q = "SELECT COUNT(users.id) AS total_students
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    WHERE role_user.role_id = 2;";
$total_students_res = $con->query($total_students_q);
$total_students_count = $total_students_res->fetch_assoc()['total_students'];
echo "Total Students = ",$total_students_count;
echo "<hr/>";

// Total Marketing Coordinator
$total_managers_q = "SELECT COUNT(users.id) AS total_managers
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    WHERE role_user.role_id = 3;";
$total_managers_res = $con->query($total_managers_q);
$total_managers_count = $total_managers_res->fetch_assoc()['total_managers'];
echo "Total Managers = ", $total_managers_count;
echo "<hr/>";

// Total Contribution
$total_articles_q = "SELECT COUNT(*) AS total_articles
                     FROM articles a
                     JOIN users u ON a.user_id = u.id
                     JOIN faculties f ON u.faculty_id = f.id";
$total_articles_res = $con->query($total_articles_q);
$total_articles_count = $total_articles_res->fetch_assoc()['total_articles'];
echo "Total Articles = ",$total_articles_count;
echo "<hr/>";

// Total Faculty
$total_faculties_q = "SELECT COUNT(*) AS total_faculties
                    FROM faculties;";
$total_faculties_res = $con->query($total_faculties_q);
$total_faculties_count = $total_faculties_res->fetch_assoc()['total_faculties'];
echo "Total Faculties in Riverstone University = ", $total_faculties_count;
echo "<hr/>";

// Total number of articles submitted by each faculty

$arti_by_fac_q = "SELECT f.faculty_name, COUNT(a.article_id) AS total_articles_by_faculty
                  FROM articles a
                  JOIN users u ON a.user_id = u.id
                  JOIN faculties f ON u.faculty_id = f.id
                  GROUP BY f.faculty_name;";

$arti_by_fac_res = $con->query($arti_by_fac_q);
if ($arti_by_fac_res->num_rows > 0) {
    echo "<h3>Total Articles by Each Faculty:</h3><ul>";
    
    while ($row = $arti_by_fac_res->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['faculty_name']) . ": " . $row['total_articles_by_faculty'] . "</li>";
    }
    
    echo "</ul>";
} else {
    echo "No articles found.";
}
echo "<hr/>";



// Percentage of contributions by each faculty for this academic year

$fac_cont_perc_q = "SELECT
                f.faculty_name,(COUNT(a.article_id) * 100.0 / (SELECT COUNT(*) FROM articles WHERE YEAR(created_at) = 2025)) AS contribution_percentage
                FROM articles a
                JOIN users u ON a.user_id = u.id
                JOIN faculties f ON u.faculty_id = f.id
                WHERE YEAR(a.created_at) = 2025
                GROUP BY f.faculty_name;";
$fac_cont_perc_res = $con->query($fac_cont_perc_q);


if($fac_cont_perc_res->num_rows>0){
    echo "<h3>Percentage of contribution by each faculty in 2025<h3/><ul>";
    while ($row = $fac_cont_perc_res->fetch_assoc())
    {
        echo "<li>" . htmlspecialchars($row['faculty_name']) . ": " . number_format($row['contribution_percentage'],2) . " %</li>";
    }
    echo"</ul>";
}
echo "<hr/>";

// Total number of comments added to contributions (Entire University)
$with_comm_q = "SELECT COUNT(*) AS total_comments
                FROM comments
                WHERE article_id IN 
                    (SELECT article_id FROM articles);";
$with_comm_q_res = $con->query($with_comm_q);
$with_comm = $with_comm_q_res->fetch_assoc()['total_comments'];
echo "Total number of comments added to contributions: ", $with_comm, "<hr/>";

// Contributions without a comment (Entire University)
$no_comm_q = "SELECT COUNT(*) AS contributions_without_comment
              FROM articles a
              LEFT JOIN comments c ON a.article_id = c.article_id
              WHERE c.comment_id IS NULL;";
$no_comm_q_res = $con->query($no_comm_q);
$no_comm = $no_comm_q_res->fetch_assoc()['contributions_without_comment'];
echo "Total contributions without comments: ", $no_comm, "<hr/>";

// Contributions without a comment after 14 days (Entire University)
$no_comm_14_q = "SELECT COUNT(*) AS contributions_without_comment_14_days
                 FROM articles a
                 LEFT JOIN comments c ON a.article_id = c.article_id
                 WHERE c.comment_id IS NULL AND a.created_at <= NOW() - INTERVAL 14 DAY;";
$no_comm_14_q_res = $con->query($no_comm_14_q);
$no_comm_14 = $no_comm_14_q_res->fetch_assoc()['contributions_without_comment_14_days'];
echo "Total contributions without comments after 14 days: ", $no_comm_14, "<hr/>";
