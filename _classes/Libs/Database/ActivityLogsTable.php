<?php
namespace Libs\Database;

use PDO;
use PDOException;

class ActivityLogsTable
{
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    // Log User Activity (Insert or Update)
    public function logPageView($user_id, $pageUrl, $browser, $ipAddress,$fileName)
    {
        try {
            // Check if this page is already logged
            $statement = $this->db->prepare(
                "SELECT active_id FROM activity_logs WHERE user_id = :user_id AND page_url = :page_url AND browser = :browser"
            );
            $statement->execute([
                'user_id' => $user_id,
                'page_url' => $pageUrl,
                'browser' => $browser
            ]);
            $log = $statement->fetch(PDO::FETCH_ASSOC);

            if ($log) {
                // Update view count
                $statement = $this->db->prepare(
                    "UPDATE activity_logs SET view_count = view_count + 1, last_viewed_at = NOW() WHERE active_id = :active_id"
                );
                $statement->execute(['active_id' => $log['active_id']]);
            } else {
                // Insert a new log
                $statement = $this->db->prepare(
                    "INSERT INTO activity_logs (user_id, page_url, file_name, browser, ip_address, view_count, last_viewed_at) 
                    VALUES (:user_id, :page_url, :file_name, :browser, :ip_address, 1, NOW())"
                );
                $statement->execute([
                    'user_id' => $user_id,
                    'page_url' => $pageUrl,
                    'file_name' => $fileName,
                    'browser' => $browser,
                    'ip_address' => $ipAddress
                ]);
            }
        } catch (PDOException $e) {
            error_log("Logging error: " . $e->getMessage());
        }
    }

    // Get Most Viewed Pages
    public function getMostViewedPages()
    {
        $statement = $this->db->query(
            "SELECT page_url,file_name, SUM(view_count) as total_views 
             FROM activity_logs 
             GROUP BY page_url 
             ORDER BY total_views DESC 
             LIMIT 5"
        );
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Get Most Active Users
    public function getMostActiveUsers()
    {
        $statement = $this->db->query(
            "SELECT users.name, roles.role_name, COUNT(activity_logs.active_id) as total_activity 
             FROM activity_logs 
             JOIN users ON activity_logs.user_id = users.id 
             JOIN role_user ON users.id = role_user.user_id
             JOIN roles ON role_user.role_id = roles.id 
             GROUP BY activity_logs.user_id 
             ORDER BY total_activity DESC 
             LIMIT 5"
        );
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    // Get Most Used Browsers
    // public function getMostUsedBrowsers($limit = 5)
    // {
    //     $statement = $this->db->query(
    //         "SELECT browser, COUNT(browser) as total_usage 
    //          FROM activity_logs 
    //          GROUP BY browser 
    //          ORDER BY total_usage DESC 
    //          LIMIT :limit"
    //     );
    //     $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    //     $statement->execute();
    //     return $statement->fetchAll(PDO::FETCH_OBJ);
    // }

    public function getMostUsedBrowsers($limit = 5)
{
    $statement = $this->db->prepare(
        "SELECT browser, COUNT(*) as total_usage 
         FROM activity_logs 
         GROUP BY browser 
         ORDER BY total_usage DESC 
         LIMIT :limit"
    );
    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_OBJ);
}
}
?>
