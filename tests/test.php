<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="test.css">
        <title>Ceci est une page HTML de test avec des balises PHP <?php echo "voici du txt via PHP"; ?></title>
    </head>

    <body>
        <div id="main_wrapper">
            <header>
                <h2>Bonjour <?php echo "Ben"; ?></h2>
            </header>
            <section>
                <p>
                    Cette page contient du code HTML avec des balises PHP.<br />
                    ET LE PHP s'affiche via APACHE grâce à l'extension .php <br />
                    <?php echo "voici du txt écrit via instruction echo"; ?>
                    Voici quelques petits tests :
                </p>
                <ul>
                    <li id="blue">Texte en bleu</li>
                    <li id="red">Texte en rouge</li>
                    <li id="green">Texte en vert</li>
                </ul>

                <?php
                echo "<p>";
                echo "hello je suis là grace au PHP"; echo "<br />";
                echo "et j'ai fait des <strong>liens physiques</strong> entre mes fichiers";
                echo "<br />";
                echo "afficher des \"guillemets\" c'est facile";
                echo "<br />";
                echo "aujourd'hui nous sommes le ";
                echo date("d/m/Y h:i:s");
                /* encore du PHP
                toujours du PHP */
                echo "</p>";
                ?>
            </section>
            <footer>

            </footer>
        </div>
        <script type="text/Javascript" src="test.js">
        </script>
    </body>
</html>