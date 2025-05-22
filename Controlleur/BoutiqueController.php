<?php
session_start();
require_once __DIR__ . '/../Model/BoutiqueModel.php';

class BoutiqueController
{
    private $boutiqueModel;

    public function __construct()
    {
        $this->boutiqueModel = new BoutiqueModel();
    }

    public function afficherBoutique()
    {
        $produits = $this->boutiqueModel->getProduits();
        include __DIR__ . '/../View/boutique.php';
    }

    public function ajouterAuPanier()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produit_id'])) {
            $produit_id = $_POST['produit_id'];
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }
            $_SESSION['panier'][] = $produit_id;
            header('Location: index.php?page=boutique');
            exit();
        }
    }

    public function afficherPanier()
    {
        $panier = $_SESSION['panier'] ?? [];
        $produits_panier = array_filter($this->boutiqueModel->getProduits(), function($produit) use ($panier) {
            return in_array($produit['id_article'], $panier);
        });

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'payer') {
            unset($_SESSION['panier']);
            header('Location: index.php?page=panier');
            exit();
        }

        include __DIR__ . '/../View/panier.php';
    }

    public function afficherFormulaireAjout()
    {
        include __DIR__ . '/../View/ajouter_produit.php';
    }

    public function ajouterProduit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $photo = $this->uploadPhoto();
            $this->boutiqueModel->addProduit($nom, $description, $prix, $photo);
            header('Location: index.php?page=boutique');
            exit();
        }
    }

    public function afficherFormulaireModification($id)
    {
        $produit = $this->boutiqueModel->getProduitById($id);
        include __DIR__ . '/../View/modifier_produit.php';
    }

    public function modifierProduit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $photo = $this->uploadPhoto();
            if (!$photo) {
                $produit = $this->boutiqueModel->getProduitById($id);
                $photo = $produit['photo_article'];
            }
            $this->boutiqueModel->updateProduit($id, $nom, $description, $prix, $photo);
            header('Location: index.php?page=boutique');
            exit();
        }
    }

    public function supprimerProduit($id)
    {
        $this->boutiqueModel->deleteProduit($id);
        header('Location: index.php?page=boutique');
        exit();
    }

    private function uploadPhoto()
    {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../uploads/';

            // Vérifie si le dossier existe, sinon le créer
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['photo']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                return 'uploads/' . $fileName;
            }
        }
        return null;
    }

}
?>
