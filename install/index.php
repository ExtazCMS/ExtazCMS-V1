<?php
/**
 * Extaz-CMS - install.php
 * Coded by TristanCode
 * Created: 10/13/15 at 10:34 AM
 */
 
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);

class Alert {
    public function danger($message) {
        return '<div class="ui negative message"><p>'.$message.'</p></div>';
    }

    public function success($message) {
        return '<div class="ui success message"><p>'.$message.'</p></div>';
    }
}
$alert = new Alert();

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Installation de ExtazCMS 1.13</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.4/semantic.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.4/semantic.min.js"></script>
    <style type="text/css">
        body {
            background-color: #FFFFFF;
        }
        .ui.menu .item img.logo {
            margin-right: 1.5em;
        }
        .main.container {
            margin-top: 7em;
        }
        .wireframe {
            margin-top: 2em;
        }
        .ui.footer.segment {
            margin: 5em 0em 0em;
            padding: 5em 0em;
        }
        #bg {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;

            /* Preserve ratio */
            min-width: 100%;
            min-height: 100%;
        }
    </style>
</head>
<body>
<img src="http://img04.deviantart.net/25a2/i/2013/346/6/8/minecraft_sunset_by_axlrosie-d6xpuyr.jpg" id="bg" alt="">
<div class="ui fixed inverted menu">
    <div class="ui container">
        <div href="#" class="header item">
            ExtazCMS 1.13
        </div>
    </div>
</div>

<div class="ui main text container" style="background-color: white;padding:25px;border-radius:5px;">
    <h1 class="ui header" style="text-align:center;">ExtazCMS &raquo; Installation</h1>
    <?php $error = false; ?>
    <table class="ui celled table">
        <thead>
            <tr>
                <th>Config</th>
                <th>Statut</th>
            </tr>
        </thead>
            <tbody>
            <tr>
                <td>Fichier app/Config en CHMOD 777 (Minimum 755)</td>
                <?php
                    if(is_writable("../app/Config")) {
                        echo "<td class='positive'>Approuvé</td>";
                    } else {
                        echo "<td class='negative'>Désapprouvé</td>";
                        $error = true;
                    }
                ?>
            </tr>
            <tr>
                <td>Fichier app/tmp en CHMOD 777 (Minimum 755)</td>
                <?php
                    if(is_writable("../app/tmp")) {
                        echo "<td class='positive'>Approuvé</td>";
                    } else {
                        echo "<td class='negative'>Désapprouvé</td>";
                        $error = true;
                    }
                ?>
            </tr>
            <tr>
                <td>Version PHP > 5.5.0</td>
                <?php
                    if(version_compare(PHP_VERSION, "5.5.0", ">")) {
                        echo "<td class='positive'>Approuvé</td>";
                    } else {
                        echo "<td class='negative'>Désapprouvé</td>";
                        $error = true;
                    }
                ?>

            </tr>
            <tr>
                <td>MySQL PDO</td>
                <?php
                    if(extension_loaded("PDO")) {
                        echo "<td class='positive'>Approuvé</td>";
                    } else {
                        echo "<td class='negative'>Désapprouvé</td>";
                        $error = true;
                    }
                ?>
            </tr>
        </tbody>
    </table>
    <?php
        if(!$error) {
            echo "<button class='ui secondary button' id='loadStep1'>Install</button><br><br>";
        } else {
            echo "<a href='#' class='ui secondary button disabled'>Install</a><br><br>";
        }

    $step = 1;
    $done = false;
    /*
     * Step 1
     * Install database
     */
    if(isset($_POST["post1"])) {
        $sql_host = $_POST["sql_host"];
        $sql_name = $_POST["sql_name"];
        $sql_user = $_POST["sql_user"];
        $sql_pass = $_POST["sql_pass"];

        if(empty($sql_host) || empty($sql_name) || empty($sql_user) || empty($sql_pass)) {
            echo $alert->danger("Tous les champs sont requis!");
        } else {
            try {
                $pdo = new PDO("mysql:host=$sql_host;dbname=$sql_name;", $sql_user, $sql_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $sql_error = false;
            }
            catch(PDOException $ex) {
                $sql_error = true;
            }
            if($sql_error == true) {
                echo $alert->danger("Erreur MySQL!");
            } else {
                $pathdb= '../app/Config/database.php';

                $databaseStructure = "<?php
class DATABASE_CONFIG {
    public \$default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => '$sql_host', // Hôte
        'login' => '$sql_user', // Nom d'utilisateur
        'password' => '$sql_pass', // Mot de passe
        'database' => '$sql_name', // Database
        'prefix' => 'extaz_',
        'encoding' => 'utf8',
    );
}";
                file_put_contents($pathdb, $databaseStructure);
                $sql = file_get_contents("ExtazCMS.sql");
                $pdo->query($sql);
                echo $alert->success("Votre base de données a bien été installée, supprimer le fichier /install/.<br>");
                $done = true;

            }
        }
    }

    if($step == 1 && $done != true) { ?>
	<?php if(!file_exists('../app/Config/database.php')){ ?>
        <div id="bdd">
            <form class="ui form" action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="field">
                    <label>Hôte SQL</label>
                    <input type="text" name="sql_host" placeholder="Hôte SQL">
                </div>
                <div class="field">
                    <label>Nom de la base SQL</label>
                    <input type="text" name="sql_name" placeholder="Nom de la base SQL">
                </div>
                <div class="field">
                    <label>Nom de l'utilisateur SQL</label>
                    <input type="text" name="sql_user" placeholder="Nom de l'utilisateur SQL">
                </div>
                <div class="field">
                    <label>Mot de passe de l'utilsateur SQL</label>
                    <input type="text" name="sql_pass" placeholder="Mot de pass de l'utilsateur SQL">
                </div>
				
                <button class="ui button" type="submit" name="post1">Installer la BDD.</button>
			</form>
		</div>
				<?php } else { ?>
		<center>		
		<div id="bdd">
            <form class="ui form" action="<?= $_SERVER["PHP_SELF"]; ?>">	
				<div class="field">
				 <label>Votre Base De données est déjà installée</label>
				 <a href="/">Me diriger vers mon site.</a>
				</div>
            </form>
        </div>
		</center>
		<?php } ?>
    <?php } ?>

    <small><a href="http://extaz-cms.fr">ExtazCMS &copy; <?php echo date("Y"); ?> Clyese Systems - Tous droits réservés</a></small>
</div>
<script type="text/javascript">
    $("#bdd").hide();

    $("#loadStep1").on("click", function () {
        $("#bdd").show();
        $(this).hide();
        $.cookie('step1', "ok", {expires: 1, path: '/'});
    });


    if($.cookie("step1") == "ok") {
        $("#loadStep1").hide();
        $("#bdd").show();
    }
</script>
</body>
</html>
