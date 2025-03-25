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
// echo "Total Students = ",$total_students_count;

// Total Contribution
$total_articles_q = "SELECT COUNT(*) AS total_articles
                     FROM articles a
                     JOIN users u ON a.user_id = u.id
                     JOIN faculties f ON u.faculty_id = f.id";
$total_articles_res = $con->query($total_articles_q);
$total_articles_count = $total_articles_res->fetch_assoc()['total_articles'];
// echo "Total Articles = ",$total_articles_count;

// Total Faculty
$total_faculties_q = "SELECT COUNT(*) AS total_faculties
                    FROM faculties;";
$total_faculties_res = $con->query($total_faculties_q);
$total_faculties_count = $total_faculties_res->fetch_assoc()['total_faculties'];
// echo "Total Faculties in Riverstone University = ", $total_faculties_count;

// Total Marketing Coordinator
$total_managers_q = "SELECT COUNT(users.id) AS total_managers
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    WHERE role_user.role_id = 3;";
$total_managers_res = $con->query($total_managers_q);
$total_managers_count = $total_managers_res->fetch_assoc()['total_managers'];
// echo "Total Managers = ", $total_managers_count;
