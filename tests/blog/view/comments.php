<?php $title = 'Article'; ?>
<?php ob_start(); ?>
<header>
    <p>
        <a href="index.php" title="back to home page">Retour à la liste des billets</a>
    </p>
</header>
<section>
    <?php
    if ($displaydata)
    {
    ?>
        <h2>Zoom sur l'article <?php echo htmlspecialchars($article['aid']); ?></h2>
        <article>
            <h1><?php echo htmlspecialchars($article['atitle']); ?></h1>
            <p>
                Auteur: <?php echo htmlspecialchars($article['aauthor']); ?> <br>
                Date de création: <?php echo htmlspecialchars($article['acdate']); ?> <br>
                Dernière date de modification: <?php echo htmlspecialchars($article['amdate']); ?> <br>
                <span class="content">
                    <?php echo nl2br(htmlspecialchars($article['acontent'])); ?>
                </span>
            </p>
        </article>
        <div id="comments">
            <h3>Commentaires</h3>
            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <p>
                    <strong><?= htmlspecialchars($comment['cnick']) ?></strong> <?= htmlspecialchars($comment['cdate']) ?> 
                    (<a href="index.php?action=showComment&amp;id=<?= $id ?>&amp;cid=<?= $comment['cid']?>" title="modify">modifier</a>)
                    <br>
                    <?php echo nl2br(htmlspecialchars($comment['cmessage'])); ?>
                </p>
            <?php
            }
            $comments->closeCursor();
            ?>                            
            <form method="post" action="index.php?action=addComment&amp;id=<?= $id ?>">
                Ajouter un commentaire: <br>
                <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname">
                <textarea name="message" id="message" cols="50" rows="1"> </textarea>
                <input type="submit" id="submit" value="poster">
            </form>
        </div>
    <?php  
    }
    ?>
</section>
<footer>
<?php 
    if ($displaydata)
    {
        include('controller/pages.php'); 
    }
?>
</footer>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>