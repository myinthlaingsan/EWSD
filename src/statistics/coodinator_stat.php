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

// Total number of students in their faculty

$fac_stud_q = "SELECT COUNT(users.id) AS total_students
                FROM users
                JOIN role_user ON users.id = role_user.user_id
                WHERE role_user.role_id = 2 AND users.faculty_id = 1;";
$fac_stud_res = $con->query($fac_stud_q);
$fac_stud = $fac_stud_res->fetch_assoc()['total_students'];
echo "Number of students in faculty: ", $fac_stud, "<hr/>";

// Total number of articles submitted by students in their faculty

$fac_arti_q = "SELECT COUNT(*) AS total_articles
                    FROM articles
                    WHERE user_id IN (SELECT id FROM users WHERE faculty_id = 1) 
                    AND status='submitted';";
$fac_arti_res = $con->query($fac_arti_q);
$fac_arti = $fac_arti_res->fetch_assoc()['total_articles'];
echo "Number of articles in faculty: ", $fac_arti, "<hr/>";

// Percentage of students who submitted at least one article

$sub_percent_q = "SELECT (COUNT(DISTINCT a.user_id) * 100.0 / COUNT(u.id)) AS percentage_students_submitted
                    FROM users u
                    LEFT JOIN articles a ON u.id = a.user_id
                    WHERE u.faculty_id = 1 ;";
$sub_percent_res = $con->query($sub_percent_q);
$sub_percent = $sub_percent_res->fetch_assoc()['percentage_students_submitted'];
echo "Percentage of student who submitted articles: ", number_format($sub_percent, 2), "%<hr/>";

// Total number of comments added to contributions (Faculty)
$with_comm_q = "SELECT COUNT(*) AS total_comments
                  FROM comments
                  WHERE article_id IN 
                        (SELECT article_id FROM articles WHERE user_id IN 
                            (SELECT id FROM users WHERE faculty_id = 1));";
$with_comm_res = $con->query($with_comm_q);
$with_comm = $with_comm_res->fetch_assoc()['total_comments'];
echo "Total number of comments added to contributions: ", $with_comm, "<hr/>";

// Contributions without a comment (Faculty)
$no_comm_q = "SELECT COUNT(*) AS contributions_without_comment
                    FROM articles a
                    LEFT JOIN comments c ON a.article_id = c.article_id
                    WHERE c.comment_id IS NULL AND a.user_id IN 
                            (SELECT id FROM users WHERE faculty_id = 1);";
$no_comm_res = $con->query($no_comm_q);
$no_comm = $no_comm_res->fetch_assoc()['contributions_without_comment'];
echo "Total number of comments added to contributions: ", $no_comm, "<hr/>";

// Contributions without a comment after 14 days (Faculty)
$no_comm_14_q = "SELECT COUNT(*) AS contributions_without_comment_14_days
                FROM articles a
                LEFT JOIN comments c ON a.article_id = c.article_id
                WHERE c.comment_id IS NULL AND a.created_at <= NOW() - INTERVAL 14 DAY
                AND a.user_id IN (SELECT id FROM users WHERE faculty_id = 1);";
$no_comm_14_res = $con->query($no_comm_14_q);
$no_comm_14 = $no_comm_14_res->fetch_assoc()['contributions_without_comment_14_days'];
echo "Total number of comments added to contributions: ", $no_comm, "<hr/>";
