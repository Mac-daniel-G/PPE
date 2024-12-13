<?php
// Inclusion du modèle des programmes
require_once '../Model/ProgrammeModel.php';

/**
 * Classe ProgrammeController
 * Contrôleur pour gérer les opérations liées aux programmes (musculation, yoga, etc.).
 */
class ProgrammeController {
    /**
     * Récupère tous les programmes d'un type spécifique.
     * 
     * @param string $type Type de programme (musculation, cardio, yoga, nutrition, etc.).
     * @return array Tableau des programmes du type demandé.
     * @throws Exception Si une erreur survient lors de la récupération des données.
     */
    public static function getProgrammesByType($type) {
        try {
            // Appel à la méthode du modèle pour récupérer les programmes
            return ProgrammeModel::fetchProgrammesByType($type);
        } catch (Exception $e) {
            // Gestion des erreurs et renvoi d'une exception
            throw new Exception("Erreur lors de la récupération des programmes : " . $e->getMessage());
        }
    }

    /**
     * Récupère les détails d'un programme spécifique via son ID.
     * 
     * @param int $id ID du programme.
     * @return array Tableau contenant les détails du programme.
     * @throws Exception Si une erreur survient lors de la récupération des données.
     */
    public static function getProgrammeDetails($id) {
        try {
            // Appel au modèle pour récupérer les détails
            return ProgrammeModel::fetchProgrammeById($id);
        } catch (Exception $e) {
            // Gestion des erreurs
            throw new Exception("Erreur lors de la récupération des détails du programme : " . $e->getMessage());
        }
    }
}
?>
