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
                <?php include("header.php"); ?>
                <h2>Bonjour <?php echo "Ben"; ?></h2>
            </header>
            <section>
                <article>
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
                    echo "<br />";
                    $visitor_age = 31;
                    $visitor_name = "Ben";
                    $visitor_height = "1.75";
                    $visitor_logged = false;
                    $visitor_account = null;
                    echo "le visiteur a $visitor_age ans, il s'appelle $visitor_name et il mesure $visitor_height.";
                    echo "<br />";
                    echo 'j\' ai '.$visitor_age;
                    echo "<br />";
                    if ($visitor_age > 30 && $visitor_name == "Ben")
                    {
                        echo "&& works";
                    }
                    if ($visitor_age < 32 AND $visitor_account == NULL)
                    {
                        echo " AND works too";
                    }
                    if ($visitor_account == null OR $visitor_age > 33)
                    {
                        echo " OR also works";
                    }
                    if (!$visitor_logged || $visitor_name == "rene")
                    {
                        echo " || also also !notworking";
                    }
                    if ($visitor_age == 31)
                    {
                    ?>
                    <br />
                    <strong>Waou!</strong> On peut donc ajouter du HTML en PHP sans utiliser echo..
                    <?php
                    }
                    else
                    {
                    ?>
                    <br />
                    <strong>faux!</strong> On ne peut pas ajouter du HTML en PHP sans utiliser echo!
                    <?php
                    }

                    echo "<br/>";
                    switch ($visitor_name)
                    {
                        case "Ben": 
                            echo "hey master";
                        break;
                        case "Sonia":
                            echo "hey sweety";
                        break;
                        default:
                            echo 'bonjour '.$visitor_name.' et bienvenue';
                    }
                    echo "<br />";
                    $count = 0;
                    while ($count < 10)
                    {
                        echo 'ligne n°'.$count.'. <br />';
                        $count++;
                    }
                    for ($i = 0; $i < 10; $i++)
                    {
                    ?>
                    <br/>
                    <strong>For n° $i n'affiche pas la var $i</strong>
                    <?php
                    }
                    echo "<br />";
                    $names = array ("Ben", "Sonia", "Flo", "Alex");
                    //$len = $names.length;
                    for ($i = 0; $i < 4; $i++)
                    {
                        echo 'bonjour '.$names[$i].'. <br />';
                    }
                    $benji = array (
                        "firstname" => "Benji",
                        "lastname" => "Chaut",
                        "age" => "31"
                    );
                    echo 'alors benji tu t\'appelles '.$benji['lastname'].'? <br />';
                    echo '<br />Prénom, nom, age: ';
                    foreach ($benji as $info)
                    {
                        echo $info.' ';
                    }
                    foreach ($benji as $key => $element)
                    {
                        echo '<br />'.$key.': '.$element.'.';
                    }
                    echo '<pre>';
                    print_r($benji);
                    echo '</pre>';
                    if (array_key_exists('age', $benji))
                    {
                        echo '<br /> la clé age existe';
                    }
                    if (in_array('31', $benji))
                    {
                        echo '<br /> la valeur 31 existe';
                    }
                    $nameKey = array_search('Chaut', $benji);
                    echo '<br />Chaut is '.$nameKey.' key';
                    $sentence = "hello world";
                    $slen = strlen($sentence);
                    $newsentence = str_replace("d", "k", $sentence);
                    echo '<br /> '.$sentence.' '.$slen.' '.$newsentence;
                    echo '<br />upper '.strtoupper($sentence);
                    echo '<br />lower '.strtolower($sentence);
                    echo '<br />shuffle! '.str_shuffle($sentence);
                    $day = date('d');                
                    $month = date('m');                
                    $year = date('Y');                
                    $hour = date('H');                
                    $min = date('i');                
                    echo '<br />'.$day.'/'.$month.'/'.$year.' '.$hour.':'.$min.'';
                    echo "<br />";
                    function sayHello($name)
                    {
                        echo 'Hello '.$name.'! <br/>';
                    }
                    sayHello("Ben");
                    sayHello("Sonia");
                    function whatTime()
                    {
                        $time = array (
                            'H' => date('H'),
                            'i' => date('i')
                        );
                        return $time;
                    }
                    $currtime = whatTime();
                    echo 'ma fonction whatTime renvoie heure sous forme de tableau avec 2 clés: H et i. => '.$currtime['H'].':'.$currtime['i'].'<br/>ça ne sert à rien car date() fait la même<br />';
                    echo "</p>";
                    ?>
                </article>
                <aside>
                    <?php include("menus.php") ?>
                </aside>
            </section>
            <footer>
                <?php include("footer.php") ?>
            </footer>
        </div>
        <script type="text/Javascript" src="test.js">
        </script>
    </body>
</html>