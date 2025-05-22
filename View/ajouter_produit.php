<?php 
include_once __DIR__ . '/../commun/header.php'; 
?>

<div class="container mt-5">
    <h1 class="text-center">Ajouter un Produit</h1>
    <form method="POST" action="index.php?page=ajouter_produit" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php 
include_once __DIR__ . '/../commun/footer.php'; 
?>
