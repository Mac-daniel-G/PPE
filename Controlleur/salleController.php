<?php
// Inclusion du modèle des salles pour interagir avec la base de données
require_once '../Model/SalleModel.php';

/**
 * Classe SalleController
 * Contrôleur qui gère les opérations liées aux salles.
 */
class SalleController
{
    /**
     * Méthode pour récupérer toutes les salles.
     *
     * @return array|false Retourne un tableau des salles ou false en cas d'erreur.
     */
    public static function getAllSalles()
    {
        try {
            // Instancier le modèle et récupérer les données
            $salleModel = new SalleModel();
            return $salleModel->getAllSalles();
        } catch (Exception $e) {
            // Journalisation de l'erreur pour le débogage
            error_log("Erreur dans SalleController::getAllSalles : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Méthode pour ajouter une nouvelle salle.
     *
     * @param string $nom Nom de la salle.
     * @param string $adresse Adresse de la salle.
     * @param int $capacite Capacité de la salle.
     * @return bool Retourne true si l'ajout a réussi, false sinon.
     */
    public static function addSalle($nom, $adresse, $capacite)
    {
        try {
            $salleModel = new SalleModel();
            return $salleModel->addSalle($nom, $adresse, $capacite);
        } catch (Exception $e) {
            error_log("Erreur dans SalleController::addSalle : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Méthode pour récupérer une salle par ID.
     *
     * @param int $id Identifiant de la salle.
     * @return array|false Retourne les données de la salle ou false si non trouvée.
     */
    public static function getSalleById($id)
    {
        try {
            $salleModel = new SalleModel();
            return $salleModel->getSalleById($id);
        } catch (Exception $e) {
            error_log("Erreur dans SalleController::getSalleById : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Méthode pour mettre à jour une salle.
     *
     * @param int $id Identifiant de la salle.
     * @param string $nom Nom de la salle.
     * @param string $adresse Adresse de la salle.
     * @param int $capacite Capacité de la salle.
     * @return bool Retourne true si la mise à jour a réussi, false sinon.
     */
    public static function updateSalle($id, $nom, $adresse, $capacite)
    {
        try {
            $salleModel = new SalleModel();
            return $salleModel->updateSalle($id, $nom, $adresse, $capacite);
        } catch (Exception $e) {
            error_log("Erreur dans SalleController::updateSalle : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Méthode pour supprimer une salle.
     *
     * @param int $id Identifiant de la salle.
     * @return bool Retourne true si la suppression a réussi, false sinon.
     */
    public static function deleteSalle($id)
    {
        try {
            $salleModel = new SalleModel();
            return $salleModel->deleteSalle($id);
        } catch (Exception $e) {
            error_log("Erreur dans SalleController::deleteSalle : " . $e->getMessage());
            return false;
        }
    }
}
