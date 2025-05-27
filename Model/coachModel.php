<?php
// Inclure la classe de base pour les modèles
require_once 'BaseModel.php';

/**
 * Modèle pour les entraîneurs (coach)
 */
class coachModel extends BaseModel {
    /**
     * Récupère tous les entraîneurs dans la base de données
     *
     * @return array Liste des entraîneurs sous forme de tableau associatif
     * @throws PDOException En cas d'erreur lors de l'exécution de la requête
     */
    public static function fetchAllcoaches() {
        try {
            // Préparer la requête pour plus de sécurité
            $stmt = self::$pdo->prepare("SELECT * FROM coach");
            $stmt->execute();

            // Retourner les résultats sous forme d'un tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des erreurs : journalisation ou ré-élévation de l'exception
            throw new PDOException("Erreur lors de la récupération des coachs : " . $e->getMessage());
        }
    }

    /**
     * Récupère un entraîneur par son ID
     *
     * @param int $id L'identifiant de l'entraîneur
     * @return array|null Les informations de l'entraîneur ou null s'il n'existe pas
     */
    public static function fetchcoachById($id) {
        try {
            // Préparer la requête avec un paramètre
            $stmt = self::$pdo->prepare("SELECT * FROM coach WHERE Id_coach = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Retourner les résultats ou null si aucun résultat
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la récupération du coach : " . $e->getMessage());
        }
    }

    /**
     * Ajoute un nouvel entraîneur dans la base de données
     *
     * @param string $specialite La spécialité de l'entraîneur
     * @param string $matricule Le matricule de l'entraîneur
     * @return bool Succès ou échec de l'insertion
     */
    public static function addcoach($specialite, $matricule) {
        try {
            // Préparer la requête d'insertion
            $stmt = self::$pdo->prepare("
                INSERT INTO coach (Specialité, Maticule) 
                VALUES (:specialite, :matricule)
            ");
            $stmt->bindParam(':specialite', $specialite, PDO::PARAM_STR);
            $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);

            // Exécuter la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'ajout du coach : " . $e->getMessage());
        }
    }

    /**
     * Supprime un entraîneur par son ID
     *
     * @param int $id L'identifiant de l'entraîneur
     * @return bool Succès ou échec de la suppression
     */
    public static function deletecoachById($id) {
        try {
            // Préparer la requête de suppression
            $stmt = self::$pdo->prepare("DELETE FROM coach WHERE Id_coach = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Exécuter la requête
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la suppression du coach : " . $e->getMessage());
        }
    }
}
