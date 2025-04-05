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


// Status of submitted articles (e.g., pending review, selected, rejected)

$status_articles_q = "SELECT title AS Title, status AS Status
                    FROM articles
                    WHERE user_id = 2;";
$status_articles_res = $con->query($status_articles_q);
$status_articles = $status_articles_res->fetch_assoc();
echo "Article Title: " . $status_articles['Title'] . " | Status: " . $status_articles['Status'];
echo "<hr/>";

// Number of comments received on their articles

$num_comments_q = "SELECT COUNT(*) AS comments_count
                FROM comments
                WHERE article_id IN (SELECT article_id FROM articles WHERE user_id = 2);";
$num_comments_res = $con->query($num_comments_q);
$num_comments = $num_comments_res->fetch_assoc()['comments_count'];
echo "<br>Number of comments received: ", $num_comments;
echo "<hr/>";

// Articles with comments
$arti_comm_q = "SELECT 
                    a.article_id, 
                    a.title, 
                    a.created_at AS article_created_at, -- remove if unncessary
                    a.updated_at AS article_updated_at, -- remove if unncessary
                    c.comment_id, 
                    c.comment_text, 
                    c.created_at AS comment_created_at, 
                    c.updated_at AS comment_updated_at
                FROM articles a
                LEFT JOIN comments c ON a.article_id = c.article_id
                WHERE a.user_id = 2 -- change according to user_id (Student)
                ORDER BY a.article_id, c.created_at;";

$arti_comm_res = $con->query($arti_comm_q);

// An array to store articles and their comments
$articles = [];

while ($row = $arti_comm_res->fetch_assoc()) {
    $article_id = $row['article_id'];

    // If the article is not yet in the array, add it
    if (!isset($articles[$article_id])) {
        $articles[$article_id] = [
            'title' => $row['title'],
            'created_at' => $row['article_created_at'],
            'updated_at' => $row['article_updated_at'],
            'comments' => []
        ];
    }

    // Add comment if it exists
    if (!empty($row['comment_text'])) {
        $articles[$article_id]['comments'][] = [
            'text' => $row['comment_text'],
            'created_at' => $row['comment_created_at'],
            'updated_at' => $row['comment_updated_at']
        ];
    }
}

// Show articles and comments
foreach ($articles as $article_id => $article) {
    echo "<h3>Article: " . htmlspecialchars($article['title']) . "</h3>";
    echo "<p><strong>Created At:</strong> " . htmlspecialchars($article['created_at']) . "</p>";
    echo "<p><strong>Updated At:</strong> " . htmlspecialchars($article['updated_at']) . "</p>";

    if (!empty($article['comments'])) {
        echo "<h4>Comments:</h4><ul>";
        foreach ($article['comments'] as $comment) {
            echo "<li>";
            echo "<p>" . htmlspecialchars($comment['text']) . "</p>";
            echo "<p><small>Created At: " . htmlspecialchars($comment['created_at']) . "</small></p>";
            echo "<p><small>Updated At: " . htmlspecialchars($comment['updated_at']) . "</small></p>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No comments yet.</p>";
    }
}
echo "<hr/>";


// Total number of articles submitted by a student

$num_submitted_q = "SELECT COUNT(*) AS articles_submitted
                    FROM articles
                    WHERE user_id =2 AND status='submitted';";
$num_submitted_res = $con->query($num_submitted_q);
$num_submitted = $num_submitted_res->fetch_assoc()['articles_submitted'];
echo "Number of submitted articles = ", $num_submitted;
echo "<hr/>";
