<?php 
include_once __DIR__ . '/../commun/header.php'; 
?>

<div class="container mt-5">
    <h1 class="text-center">Modifier un Produit</h1>
    <form method="POST" action="index.php?page=modifier_produit" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produit['id_article']) ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom_article']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($produit['descrption_article']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($produit['prix_article']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <img src="<?= htmlspecialchars($produit['photo_article']) ?>" alt="Photo actuelle" class="img-thumbnail mt-2" width="150">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<?php 
include_once __DIR__ . '/../commun/footer.php'; 
?>
