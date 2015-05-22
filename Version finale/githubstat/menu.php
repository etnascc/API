<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Acceuil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/main.css" rel="stylesheet" />
        <link rel="stylesheet" href='./css/bootstrap.css'>
    </head>
    <body>
        <main>
            <div id="my_menu" class="container col-lg-12">
            </div>
			<div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
						<H1>Statistiques disponibles</H1>
						<p align="justify">
							<H4>Veullez selectionner votre graphique.</h4>
						</p>
						<p align="justify">
							Afficher le graphique qui donne le nombre de commit sur la derniere annee
							<A HREF="./ressources/get_comit_activity/histo_f2.php"><input type="button" value="Comit activity"></A>
						</p>
						<p align="justify">
							Afficher le nombre de commit des utilisateurs et de l'auteur sur la derniere annee
						<A HREF="./ressources/get_participations/participations.php"><input type="button" value="Participation"></A>
						</p>
						<p align="justify">
							Afficher le nombre d'ajouts
						<A HREF="./ressources/code_frequency/courbe_a_code_freq.php"><input type="button" value="Ajout"></A>
						</p>
						<p align="justify">
							Afficher le nombre de deletion
						<A HREF="./ressources/code_frequency/courbe_d_code_freq.php"><input type="button" value="Deletion"></A>
						</p>
					</div>
                </div>
            </div>
			<div id="carousel-testimonial" class="carousel slide"
                 data-ride="carousel">
                <div class="carousel-inner testimonial" 
                     style="background-image:url(./img/testo.jpg);">
                    <div class="item active">
                        <div class="unit">
                            <h3>Un excellent collaborateur avec qui je n'hésiterai
                                pas à retravailler.</h3>
                            <div></div>
                            <p class="byline">- Rocket Singh, Rocket Corp</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="unit unit-2">
                            <h3>Il n'y a pas meilleur comme développeur.</h3>
                            <div></div>
                            <p class="byline">- Mike, Bread Inc</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="unit unit-3">
                            <h3>Like a boos !!!</h3>
                            <div></div>
                            <p class="byline">- Nik, TCB</p>
                        </div>
                    </div>
                </div>
            </div>
		</main>
        <footer>
            <div class="container" id="my_footer">
            </div>
            <script type="text/javascript" src="./js/jquery.min.js"></script>
            <script type="text/javascript" src="./js/bootstrap.min.js"></script>
            <script type="text/javascript" src="./js/scripts.js"></script>
        </footer>
    </body>
</HTML>