<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>PHP images</title>
</head>
<body>
    <h1>PHP images</h1>
    <p>
        <a href="imgjpg.php" title="jpg image">Une image jpg</a> <br>
        <a href="imgpng.php" title="png image">Une image png</a> <br>
        <a href="newimgpng.php" title="new png image">Une nouvelle image png</a> <br>
        <a href="imgfusion.php" title="images fusion">Fusion de 2 images</a> <br>
        <a href="copyrighter.php?image=1.jpg" title="image with copyright">Image copyrighté</a>
    </p>

    <h2>On peut aussi afficher les images png directement dans la balise img</h2>
    <img src="imgjpg.php" alt="image jpeg"> <br>
    <img src="imgpng.php" alt="image png"> <br>
    <img src="newimgpng.php" alt="new image png"> <br>
    <img src="imgfusion.php" alt="images fusion"> <br>
    <h3>Images copyrightées</h3> <br>
    <img src="copyrighter.php?image=../images/1.jpg" alt="image copyrightée"> <br>
    
</body>
</html>