<?
	session_start();
	// cette fonction permet de récupérer les données du serveur
	$monserveur=$_SESSION['monserveur'];
	$utilisateur=$_SESSION['utilisateur'];
	$motpasse=$_SESSION['motpasse'];
	$dbase=$_SESSION['dbase'];
	$tempo=$_SESSION['tempo'];
/*
 * sosh49login.php
 * 
 * Copyright 2017  <jean.lamaison@cegetel.net>
 * 
 * Cette page est la page qui permet de valider les droits du visiteur et le diriger suivant l'activit qu'il veut faire
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Language" content="fr" />
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link href="StyleSOSH49.css" rel="stylesheet" type="text/css" />
	<title>SOS_HERISSON49 Login</title>
</head>

<body bgcolor="#C0C0CF">
	<?
		//on récupère les informations à partir de la page précédente et on les inscrit en paramètre de session
		$user= $_POST['user'];
		$pwuser = $_POST['pwuser'];
		$ordre = $_GET['TrierPar'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$_SESSION["user"]=$user;
		$_SESSION["pwuser"]=$pwuser;
		$_SESSION["ordre"]=$ordre;
		$_SESSION["ip"]=$ip;
	?>
	<div class="TitrePage">SOS_HERISSON49 <a href="sosh49acc.php">Bienvenue <?echo($user)?></a></div>
	<br>
	<div class="EnteteTableau">Programme de suivi des hérissons</div><br>
	<?
		//echo("Demande d'ouverture de session pour ".$user." avec comme mot de passe ".$pwuser."<br>");
		//echo("Serveur ".$monserveur."@". $utilisateur." si le nom n'est pas juste avant, c'est pas bon<br>");	
		@mysql_connect($monserveur, $utilisateur, $motpasse) or die("Impossible de se connecter au serveur $monserveur pour l'utilisateur $utilisateur");
		@mysql_select_db("$dbase") or die("connexion à la base $dbase impossible");
		$matable="soignant";
		$monordre ='user';
		// sélectionne toutes les fiches de la table $user
		$query = "SELECT * FROM `".$matable."` WHERE `user`='".$user."'";
		//echo("$query<br>");
		$result = mysql_query($query);
		//echo("resultat ".$result);
		// tant qu'il y a des fiches
		$ctrlok=0;	
		while ($val = mysql_fetch_array($result)) { 		
			//echo("Premier enregistrement trouve<br>");
				$monuser=$val['user'];
				//echo("Utilisateur inscrit ".$monuser."<br>");
				$monpwuser=$val['pwuser'];
				$monid=$val["codes"];
				//echo("comparaison avec les individus de la base de donnee ".$monuser." et ".$user." avec comme mot de passe ".$monpwuser."<br>");
				if ($monuser==$user AND $monpwuser==$pwuser){
					$ctrlok=$ctrlok+1;
					$_SESSION["habilite"]=1;
					$_SESSION["tempo"]=30;
					echo("<br><div class=\"Titreok\">Vous êtes autorisé à modifier la base de données</div>");
					//on enregistre son passage dans la table
					$query="INSERT INTO visiteurs (user,ip)VALUES('$user','$ip')";
					mysql_query($query);
					$rep = mysql_query($query) or die("<br>ATTENTION ! la requette ".$query." n' a pas pu aboutir <br>".mysql_error());
				}else{
					$_SESSION["habilite"]=2;
					$_SESSION["tempo"]=2;
				}		
		}
		mysql_close();
		if ($ctrlok>=1){
			$rubr="chil";
			echo ("<br>
			<a href=\"sosh49util.php?rubr=".$rubr."\"> Vous pouvez enregistrer un nouveau soin</a><br><br><br><br>
			<a href=\"sosh49indi.php?rubr=".$rubr."&fami=0&chil=0&pere=0&mere=0\"> Vous pouvez saisir un nouveau hérisson</a><br><br><br><br>
			<a href=\"sosh49union.php?rubr=".$rubr."&fami=0\"> Vous pouvez saisir un nouveau soignant</a><br><br><br><br>
			");
		}
		echo ("Vous pouvez lancer une <a href=\"sosh49search.php?\">recherche dans la base de données.</a>");
	?>

</body>

</html>
