<!-- app/Views/reset_request.php -->
<div class="container py-5">
    <h2>Réinitialisation du mot de passe</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="email">Votre adresse email :</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer le lien</button>
    </form>
</div>