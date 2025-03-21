<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE tasks
                                SET is_completed = 1
                                WHERE id = :id");
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            echo "Successfully";
        } catch (\Throwable $th) {
            echo "Something went wrong. Please try again later.";
        }
}