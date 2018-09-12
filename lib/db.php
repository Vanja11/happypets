<?php

class DB {
    function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if ($this->mysqli->connect_errno) {
            die('Failed to connect to MySQL: (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }

    public function getCategories() {
        if ($statement = $this->mysqli->prepare('SELECT * FROM categories')) {
            $statement->execute();

            $res = $statement->get_result();
            $categories = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            return $categories;
        }

        return [];
    }

    public function getCategory($category) {
        if ($statement = $this->mysqli->prepare('SELECT * FROM categories WHERE id = ?')) {
            $statement->bind_param('i', $category);

            $statement->execute();

            $res = $statement->get_result();
            $categories = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();

            return $categories[0];
        }

        return null;
    }

    public function getUser($user) {
        if ($statement = $this->mysqli->prepare('SELECT * FROM users WHERE id = ?')) {
            $statement->bind_param('i', $user);

            if ($statement->execute()) {
                $res = $statement->get_result();
                $users = $res->fetch_all(MYSQLI_ASSOC);
                $statement->close();
    
                if (count($users) > 0) {
                    return $users[0];
                }
            }
        }
        return null;
    }

    public function getAd($ad) {
        if ($statement = $this->mysqli->prepare('SELECT ads.*, users.phone as uphone, users.name FROM ads LEFT JOIN users ON users.id = users_id WHERE ads.id = ?')) {
            $statement->bind_param('i', $ad);

            $statement->execute();

            $res = $statement->get_result();
            $ads = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();

            return $ads[0];
        }

        return null;
    }

    public function getPhoto($photo) {
        if ($statement = $this->mysqli->prepare('SELECT uploads.*, ads.users_id FROM uploads LEFT JOIN ads ON ads_id = ads.id WHERE uploads.id = ?')) {
            $statement->bind_param('i', $photo);

            $statement->execute();

            $res = $statement->get_result();
            $photos = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();

            return $photos[0];
        }

        return null;
    }


    public function deleteAd($ad) {
        if ($statement = $this->mysqli->prepare('DELETE FROM ads WHERE id = ?')) {
            $statement->bind_param('i', $ad);

            $statement->execute();

            $statement->close();

            return true;
        }

        return false;
    }

    public function deletePhoto($photo) {
        if ($statement = $this->mysqli->prepare('DELETE FROM uploads WHERE id = ?')) {
            $statement->bind_param('i', $photo);

            $statement->execute();

            $statement->close();

            return true;
        }

        return false;
    }

    public function getAds($category) {
        if ($statement = $this->mysqli->prepare('SELECT *, ads.id as id FROM ads LEFT JOIN users ON users_id = users.id LEFT JOIN uploads ON ads.id = ads_id WHERE categories_id = ? AND expires_at >= NOW() GROUP BY ads.id')) {
            $statement->bind_param('i', $category);
            
            $statement->execute();

            $res = $statement->get_result();
            $ads = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            return $ads;
        }

        return [];
    }

    public function getPhotos($ad) {
        if ($statement = $this->mysqli->prepare('SELECT * FROM uploads WHERE ads_id = ?')) {
            $statement->bind_param('i', $ad);
            
            $statement->execute();

            $res = $statement->get_result();
            $photos = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            return $photos;
        }

        return [];
    }

    public function getAdsByUser($user) {
        $me = $_SESSION['user'];
        if (isset($me) && $user == $me['id']) {
            $statement = $this->mysqli->prepare('SELECT ads.*, users.name, uploads.path FROM ads LEFT JOIN users ON users_id = users.id LEFT JOIN uploads ON ads.id = ads_id WHERE users_id = ? GROUP BY ads.id');
        } else {
            $statement = $this->mysqli->prepare('SELECT ads.*, users.name, uploads.path FROM ads LEFT JOIN users ON users_id = users.id LEFT JOIN uploads ON ads.id = ads_id WHERE users_id = ? AND expires_at >= NOW() GROUP BY ads.id');
        }

        if ($statement) {
            $statement->bind_param('i', $user);
            
            $statement->execute();

            $res = $statement->get_result();
            $ads = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();
            return $ads;
        }

        return [];
    }

    public function register($name, $phone, $email, $password) {
        if ($statement = $this->mysqli->prepare('INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)')) {
            $statement->bind_param('ssss', $name, $phone, $email, sha1($password));

            $statement->execute();
            $statement->close();
        }
    }

    public function login($email, $password) {
        if ($statement = $this->mysqli->prepare('SELECT * FROM users WHERE email = ? AND password = ?')) {
            $statement->bind_param('ss', $email, sha1($password));
            $statement->execute();

            $res = $statement->get_result();
            $users = $res->fetch_all(MYSQLI_ASSOC);
            $statement->close();

            $user = count($users) > 0 ? $users[0] : false;

            return $user;
        } 

        return false;
    }

    public function create($category, $title, $description, $phone, $photos) {
        $user = $_SESSION['user'];

        if ($statement = $this->mysqli->prepare('INSERT INTO ads (title, description, users_id, phone, categories_id, expires_at) VALUES (?, ?, ?, ?, ?, ?)')) {
            $statement->bind_param('ssisis', $title, $description, $user['id'], $phone, $category, date('Y-m-d H:i:s', strtotime('+1 month')));

            $statement->execute();

            $adId = $statement->insert_id;

            $statement->close();
        
            for ($i = 0; $i < 5; $i++) {
                if ($photos['tmp_name'][$i] !== '' && strpos($photos['type'][$i], 'image/') === 0) {
                    $this->uploadPhoto($adId, $photos['name'][$i], $photos['tmp_name'][$i]);
                }
            }      
            
            return $adId;
        }
    }

    public function updateAd($id, $category, $title, $description, $phone, $photos) {
        $user = $_SESSION['user'];

        if ($statement = $this->mysqli->prepare('UPDATE ads SET categories_id = ?, title = ?, description = ?, phone = ?, updated_at = ? WHERE id = ? AND users_id = ?')) {
            $date = date('Y-m-d H:i:s');
            $statement->bind_param('issssii', $category, $title, $description, $phone, $date, $id, $user['id']);

            $statement->execute();

            $statement->close();

            for ($i = 0; $i < 5; $i++) {
                if ($photos['tmp_name'][$i] !== '' && strpos($photos['type'][$i], 'image/') === 0) {
                    $this->uploadPhoto($id, $photos['name'][$i], $photos['tmp_name'][$i]);
                }
            }     
        }
    }

    public function renewAd($id) {
        $user = $_SESSION['user'];

        if ($statement = $this->mysqli->prepare('UPDATE ads SET expires_at = ?, updated_at = ? WHERE id = ? AND users_id = ?')) {
            $date = date('Y-m-d H:i:s');
            $expires = date('Y-m-d H:i:s', strtotime('+1 month'));
            $statement->bind_param('ssii', $expires, $date, $id, $user['id']);

            $statement->execute();

            $statement->close();
        }
    }

    private function uploadPhoto($adId, $name, $path) {
        $filePath = $adId . '-' . $name;
        move_uploaded_file($path, 'uploads/' . $filePath);

        if ($statement = $this->mysqli->prepare('INSERT INTO uploads (path, ads_id) VALUES (?, ?)')) {
            $statement->bind_param('ss', $filePath, $adId);

            $statement->execute();
            $statement->close();
        }
    }

}