<?php function displayArtistes(){?>

<!DOCTYPE html>

<!-- HEADING-->
<?php $listGroupe = $_SESSION['listGroupes']; ?>
<html lang="fr">
<head>
    <link rel="stylesheet" href="view/css/artistes.css"> <!--script styles.css-->

    <meta charset="UTF-8">
    <title>Artistes</title>

    <div class="barre">
        <nav>
            <ul>
                <li class="about"><a href="about.html">About</a></li>
                <li class="contact"><a href="contact.html">Contact</a></li>
                <li class="artistes"><a href="artistes.php">Artistes</a></li>
                <li class="actu"><a href="actu.html">Actu</a></li>
                <li class="logo"><a href="actu.html"><img src="view/img/loup.png" alt="loup"></a></li>
            </ul>
        </nav>
    </div>
</head>


<body>
<div class="content">
    <?php
    foreach($listGroupe as $groupe){
        echo '<img src="'.$groupe->getimageHeader().'" alt="cara">';
    ?>
    <img src="../data/cara.jpg" alt="cara">
    <div class="cara">
        <div class="zoneArtistes">

            <center><b><h1>  <?php echo $groupe->getNom();?></h1></b>
                <p><?php echo $groupe->getDescription(); ?></p>
                <a href=".?page=artistedetail&id="<?php echo $groupe->getId(); ?>> VOIR </a>
                <p>---------------------------------</p>
            </center>
        </div>
    </div>
    <?php } ?>
</div>

</body>                               <!-- end BODY-->

</html>
<?php } ?>