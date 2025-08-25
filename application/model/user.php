<?php
class UserModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Check if username or email is unique
    private function isUnique($user_name, $email, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE (user_name=:user_name OR email=:email)";
        $params = [
            ':user_name' => $user_name,
            ':email' => $email
        ];

        if ($excludeId) {
            $sql .= " AND id != :id";
            $params[':id'] = $excludeId;
        }

        $count = $this->db->count($sql, $params);
        return $count === 0; // true if unique
    }

    // Insert user
    public function insertUser($data) {
        if (!$this->isUnique($data['user_name'], $data['email'])) {
            return 0; // Duplicate found
        }

        $sql = "INSERT INTO users (name, user_name, email, role, password, address, birthday, nid_card)
                VALUES (:name, :user_name, :email, :role, :password, :address, :birthday, :nid_card)";
        $this->db->insert($sql, [
            ':name' => $data['name'],
            ':user_name' => $data['user_name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':address' => $data['address'] ?? null,
            ':birthday' => $data['birthday'] ?? null,
            ':nid_card' => $data['nid_card'] ?? null
        ]);

        return 1; // Insert successful
    }

    // Update user by id
    public function updateUser($id, $data) {
        if (!$this->isUnique($data['user_name'], $data['email'], $id)) {
            return 0; // Duplicate found
        }

        $sql = "UPDATE users SET name=:name, user_name=:user_name, email=:email, role=:role, password=:password, 
                address=:address, birthday=:birthday, nid_card=:nid_card WHERE id=:id";
        $this->db->update($sql, [
            ':name' => $data['name'],
            ':user_name' => $data['user_name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':address' => $data['address'] ?? null,
            ':birthday' => $data['birthday'] ?? null,
            ':nid_card' => $data['nid_card'] ?? null,
            ':id' => $id
        ]);

        return 1; // Update successful
    }

    // Delete user by id
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id=:id";
        return $this->db->delete($sql, [':id' => $id]);
    }

    // Get single user by id
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id=:id";
        return $this->db->fetch($sql, [':id' => $id]);
    }

    // Get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        return $this->db->select($sql);
    }
}

?>