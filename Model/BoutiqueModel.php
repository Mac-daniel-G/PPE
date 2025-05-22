<?php
require_once __DIR__ . '/BaseModel.php';

class BoutiqueModel extends BaseModel
{
    public function getProduits()
    {
        $sql = "SELECT * FROM boutique ORDER BY nom_article";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitById($id)
    {
        $sql = "SELECT * FROM boutique WHERE id_article = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduit($nom, $description, $prix, $photo)
    {
        $sql = "INSERT INTO boutique (nom_article, description_article, prix_article, image_article) VALUES (:nom, :description, :prix, :photo)";

        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
        $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateProduit($id, $nom, $description, $prix, $photo)
    {
        $sql = "UPDATE boutique SET nom_article = :nom, description_article = :description, prix_article = :prix, image_article = :photo WHERE id_article = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
        $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteProduit($id)
    {
        $sql = "DELETE FROM boutique WHERE id_article = :id";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
