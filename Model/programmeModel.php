<?php
require_once '../.vscode/config.php';

class ProgrammeModel {
    /**
     * Récupère tous les programmes d'un type spécifique.
     * 
     * @param string $type Type de programme.
     * @return array Tableau des programmes correspondants.
     */
    public static function fetchProgrammesByType($type) {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM programme WHERE type = :type";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les détails d'un programme via son ID.
     * 
     * @param int $id ID du programme.
     * @return array Tableau des détails du programme.
     */
    public static function fetchProgrammeById($id) {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM programme WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
