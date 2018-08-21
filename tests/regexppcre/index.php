<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>REGEXP</title>
</head>
<body>
    <h1>REGEXP</h1>
    <?php
    echo 'preg_match("/^j\'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave$/i", "j\'ai une Guitare dans mon placard") = '; 
    echo (preg_match("/^j'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave$/i", "j'ai une Guitare dans mon placard"));
    echo '<br>';
    echo '<br>';
   
    echo 'preg_match("/^j\'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave$/i", "j\'ai un PIANO DANS MON GRENIER") = ';
    echo (preg_match("/^j'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave$/i", "j'ai un PIANO DANS MON GRENIER"));
    echo '<br>';
    echo '<br>';
    
    echo 'preg_match("/^j\'[a-z]+.[a-z]+.guitare|piano|banjo.+[a-z]+.[a-z]+.placard|grenier|cave$/i", "j\'ai des banjos dans ma cave") = ';
    echo (preg_match("/^j'[a-z]+.[a-z]+.guitare|piano|banjo.+[a-z]+.[a-z]+.placard|grenier|cave$/i", "j'ai des banjos dans ma cave"));
    echo '<br>';
    echo '<br>';
    
    echo 'preg_match("/^j\'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave\?$/i", "j\'ai un banjo dans ma cave?") = ';
    echo (preg_match("/^j'[a-z]+ [a-z]+ guitare|piano|banjo [a-z]+ [a-z]+ placard|grenier|cave\?$/i", "j'ai un banjo dans ma cave?"));
    echo '<br>';
    echo '<br>';
    
    //chercher une balise de titre:
    echo htmlspecialchars('preg_match("/<h[1-6]>/i","<h2>Mon titre</h2>") = ');
    echo (preg_match("/<h[1-6]>/i","<h2>Mon titre</h2>"));
    echo '<br>';
    echo '<br>';

    //vérifier un numéro de tel de 01 à 07 tout attaché
    echo 'preg_match("/^0[1-7][0-9]{8}$/","0607060607") = ';
    echo (preg_match("/^0[1-7][0-9]{8}$/","0607060607"));
    echo '<br>';
    echo '<br>';
    
    //vérifier un numéro de tel de 01 à 07 tout attaché ou espacé avec des espaces, des points ou des tirets
    //([-. ]?[0-9]{2}){4} permet de dire qu'on attend un espace, un tiret, un point ou rien, suivi de 2 nbr de 0 à 9, 4 fois en tout! 
    echo 'preg_match("/^0[1-7]([-. ]?[0-9]{2}){4}$/","06 07-06.0607") = ';
    echo (preg_match("/^0[1-7]([-. ]?[0-9]{2}){4}$/","06 07-06.0607"));
    echo '<br>';
    echo '<br>';

    //vérifier une adresse mail avec @ au milieu et extension de 2 à 4 caractères
    echo 'preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/","saucisseweb@gmail.com") = ';
    echo (preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/","saucisseweb@gmail.com"));
    echo '<br>';
    echo '<br>';

    //MYSQL comprend les regexp
    echo 'SELECT name FROM visitor WHERE ip REGEXP \'^184\.254(\.[0-9]{1,3}){2}\'';
    echo '<br>';
    echo '<br>';
?>

    
    <form method="post" action="index.php">
        Tapez du texte ici pour l'afficher plus bas en convertissant les urls en liens cliquables et les balises [b] [/b] en gras, [i] [/i] en italique et [color=red] [/color] en couleur! <br>
        <textarea name="content" id="content" cols="30" rows="10"></textarea> <br>
        <input type="submit" id="submit" name="submit" value="Convertir">
    </form>

    <?php
    //RECHERCHE ET REMPLACE, HYPER UTILE
    /*
    Pour que ça marche, on va avoir besoin d'utiliser trois options :
    i : pour accepter les majuscules comme les minuscules ([B]et[b]) ;
    s : pour que le « point » fonctionne aussi pour les retours à la ligne (pour que le texte puisse être en gras sur plusieurs lignes) ;
    U : le U majuscule est une option que vous ne connaissez pas et qui signifie « Ungreedy » (« pas gourmand »). Je vous passe les explications un peu complexes sur son fonctionnement, mais sachez que, grosso modo, ça ne marcherait pas correctement s'il y avait plusieurs[b]dans votre texte. 
    ATTENTION: U ne marche pas avec les liens et mails, et s ne sert pas dans ces cas là car on ne retourne pas à la ligne dans un lien ou une adresse..
    */
    if (isset($_POST['content']))
    {
        //$content = htmlspecialchars($_POST['content']);
        $content = ($_POST['content']);
        
        //pour mettre mettre le html en couleur, il faut qu'on echappe le html après avoir trouvé les balises html et inséré notre bbcode qui sera retraduis plus loin
        $content = preg_replace("/<[a-z0-9\/ =:\"]+>/isU", "[color=blue]$0[/color]", $content);
        //$content = preg_replace("/(<[a-z0-9\/\[\]]+) ([a-z]+=\"[a-z0-9:]+\") ?([a-z0-9\/\[\]]+?)>/isU", "[color=blue]$1[/color][color=red]$2[/color][color=blue]$3[/color]", $content);
        $content = htmlspecialchars($content);
    

        $content = preg_replace("/https?:\/\/[a-z0-9._\/-?=&]+/i","<a href=$0 >$0</a>",$content);
        $content = preg_replace("/[a-z0-9._-]+@[a-z0-9._-]+/i", "<a href=mailto:$0 >$0</a>",$content);
        $content = preg_replace("/\[b\](.+)\[\/b\]/isU", "<strong>$1</strong>", $content);
        $content = preg_replace("/\[i\](.+)\[\/i\]/isU", "<em>$1</em>", $content);
        $content = preg_replace("/\[color=(red|green|blue)\](.+)\[\/color\]/isU", "<span style=color:$1;>$2</span>", $content);

        
        echo '<h2>Voici votre contenu traduit</h2>';
        echo '<p>'.$content.'</p>';
    }
    ?>
</body>
</html>
