<?php
session_start();
?>

<HTML>
	<HEAD>
		<TITLE>
			Menu Principal
		</TITLE>
	</HEAD>
	
	<BODY>
	<CENTER>
		<H1>Statistiques disponibles</H1>
			<p align="justify">
				Afficher le graphique qui donne le nombre d'ajout depuis la creation du repertoire
				<A HREF="code_frequency/double_courbe3.php"><input type="button" value="Code frequency"></A>
			</p>
			<p align="justify">
				Afficher le graphique qui donne le nombre de commit sur la derniere annee
				<A HREF="get_comit_activity/histo_f2.php"><input type="button" value="Comit activity"></A>
			</p>
			<p align="justify">
				Afficher le nombre de commit des utilisateurs et de l'auteur sur la derniere annee
			<A HREF="get_participations/participations.php"><input type="button" value="Participation"></A>
			</p>
			<p align="justify">
				Afficher le nombre d'ajouts
			<A HREF="code_frequency/courbe_a_code_freq.php"><input type="button" value="Ajout"></A>
			</p>
			<p align="justify">
				Afficher le nombre de deletion
			<A HREF="code_frequency/courbe_d_code_freq.php"><input type="button" value="Deletion"></A>
			</p>
	</CENTER>
	</BODY>
</HTML>