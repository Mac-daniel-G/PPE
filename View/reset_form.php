<!-- app/Views/reset_form.php -->
<div class="container py-5">
    <h2>Choisissez un nouveau mot de passe</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <a href="index.php?page=connexion" class="btn btn-success">Se connecter</a>
    <?php else: ?>
        <form method="post" action="">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">
            <div class="mb-3">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirm">Confirmer le mot de passe :</label>
                <input type="password" name="password_confirm" id="password_confirm" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Réinitialiser</button>
        </form>
    <?php endif; ?>
</div>