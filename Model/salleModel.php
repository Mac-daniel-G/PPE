<?php
require_once __DIR__ . '/BaseModel.php';

class SalleModel extends BaseModel
{
    /**
     * Récupère toutes les salles disponibles.
     *
     * @return array Tableau des salles.
     */
    public function getAllSalles()
    {
        $sql = "SELECT * FROM salles ORDER BY nom";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une salle par son identifiant.
     *
     * @param int $id Identifiant de la salle.
     * @return array|false Informations de la salle ou false si non trouvée.
     */
    public function getSalleById($id)
    {
        $sql = "SELECT * FROM salles WHERE id = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ajoute une nouvelle salle.
     *
     * @param string $nom Nom de la salle.
     * @param string $adresse Adresse de la salle.
     * @param int $capacite Capacité de la salle.
     * @return bool True si l'ajout a réussi, false sinon.
     */
    public function addSalle($nom, $adresse, $capacite)
    {
        $sql = "INSERT INTO salles (nom, adresse, capacite) VALUES (:nom, :adresse, :capacite)";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindValue(':capacite', $capacite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Met à jour une salle existante.
     *
     * @param int $id Identifiant de la salle.
     * @param string $nom Nom de la salle.
     * @param string $adresse Adresse de la salle.
     * @param int $capacite Capacité de la salle.
     * @return bool True si la mise à jour a réussi, false sinon.
     */
    public function updateSalle($id, $nom, $adresse, $capacite)
    {
        $sql = "UPDATE salles SET nom = :nom, adresse = :adresse, capacite = :capacite WHERE id = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindValue(':capacite', $capacite, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Supprime une salle par son identifiant.
     *
     * @param int $id Identifiant de la salle.
     * @return bool True si la suppression a réussi, false sinon.
     */
    public function deleteSalle($id)
    {
        $sql = "DELETE FROM salles WHERE id = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Recherche des salles.
     *
     * @param string|null $search Mot-clé pour la recherche.
     * @return array Résultats correspondant à la recherche.
     */
    public function searchSalles($ville)
    {
        $sql = "SELECT * FROM salles where ville= :ville";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':ville', $ville, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

?>
