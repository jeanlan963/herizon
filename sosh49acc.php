<?
  session_start();
// cette fonction permet de récupérer les données du serveur
/*
 * sosh49acc.php
 * 
 * Copyright 2022  <jean.lamaison@cegetel.net>
 * 
 * Cette page est la page d'accueil du programme de gestion des hérissons
 * L'utilisateur doit se logger pour modifier la base de donnee, sinon il pourra uniquement consulter.
 * il est dirige automatiquement vers la page sosh49login pour verifier ses droits d'acces.
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
	<title>SOS_HERISSON49 Accueil</title>
</head>

<body>
	<?
		$monserveur="localhost";
		$utilisateur="jean.lamaison";
		$motpasse="JLN8563";
		$dbase="herisson";
		$tempo=5;
		$_SESSION["monserveur"]=$monserveur;
		$_SESSION["utilisateur"]=$utilisateur;
		$_SESSION["motpasse"]=$motpasse;
		$_SESSION["dbase"]=$dbase;
		$_SESSION["tempo"]=$tempo;
	?>
	<div class="TitrePage">SOS_HERISSON49</div>
	<br>
	<div class="EnteteTableau">Gestion des hérisson<br>
	Rentrez votre nom d'utilisateur et votre mot de passe pour y accéder:
	<form method="POST" action="sosh49login.php?TrierPar=num" name="Login">
		<table id="table1">	
			<tr>
				<td width=10%> Utilisateur</td>
				<td width=40%><input class="TexteModifiable" type="text" name="user" size="20" autofocus></td>
				<td width=40%><input class="TexteModifiable" type="password" name="pwuser" size="20"></td>
				<td width=10%><input type="submit" value="Accéder à la base" name="SeLoguer"></td>
			</tr>
		</table>
	</form>
	<br></div>
	<div class="EnteteTableau">Si vous n'avez pas encore de nom d'utilisater ni le mot de passe, vous devrez <a href="mailto:jean.caro.tricot@laposte.net">m'envoyer un mail pour l'obtenir</a></div>
	
</body>

</html>
