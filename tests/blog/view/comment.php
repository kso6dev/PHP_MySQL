<?php $title = 'Commentaire'; ?>
<?php ob_start(); ?>
<header>
    <p>
        <a href="index.php" title="back to home page">Retour à la liste des billets</a>
    </p>
</header>
<section>
    <h3>Modifier commentaire</h3>
    <form method="post" action="index.php?action=updateComment&amp;id=<?= $comment['article_id'] ?>&amp;cid=<?= $comment['cid'] ?>">
        <strong><?= htmlspecialchars($comment['cnick']) ?></strong> <?= htmlspecialchars($comment['cdate']) ?> 
        <br>
        
        Modifier le commentaire: <br>
        <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname" value="<?= htmlspecialchars($comment['cnick']) ?>">
        <textarea name="message" id="message" cols="50" rows="1"><?= nl2br(htmlspecialchars($comment['cmessage'])) ?></textarea>
        <input type="submit" id="submit" value="modifier">
    </form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>