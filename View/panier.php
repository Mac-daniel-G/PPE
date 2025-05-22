<?php
include_once __DIR__ . '/../commun/header.php';
?>

<div class="container mt-5">
    <h1 class="text-center">Panier</h1>
    <?php if (!empty($produits_panier)) : ?>
        <div class="row">
            <?php foreach ($produits_panier as $produit) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($produit['nom_article']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($produit['description_article']) ?></p>
                            <p class="card-text"><strong>Prix :</strong> <?= htmlspecialchars($produit['prix_article']) ?> €</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="action" value="payer">
            <button type="submit" class="btn btn-success">Passer au paiement</button>
        </form>
    <?php else : ?>
        <p class="text-center text-muted">Votre panier est vide.</p>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../commun/footer.php'; ?>
