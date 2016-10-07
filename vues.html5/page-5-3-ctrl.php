<?php

	if(!isset($_POST["txtNouveauMdp"]) && !isset($_POST["txtConfirmation"]))
	{
		$nouveauMdp = '';
		$confirmationMdp='';
		$afficherMdp = 'off';
		$message = '';
		$typeMessage = '';
		include_once("page-5-3-vue.php");		
	}
	else
	{
		if (empty ($_POST["txtNouveauMdp"]) == true) $nouveauMdp="";
			else $nouveauMdp = $_POST["txtNouveauMdp"];
		if (empty ($_POST ["txtConfirmation"]) == true) $confirmationMdp="";
			else $confirmationMdp = $_POST["txtConfirmation"];
		if (empty ($_POST ["caseAfficherMdp"]) == true) $afficherMdp="off";
			else $afficherMdp= $_POST["caseAfficherMdp"];
			
		if ($nouveauMdp == "" || $confirmationMdp == "")
		{
			$message ='Données incomplètes !';
			$typeMessage = 'avertissement';
			include_once 'page-5-3-vue.php';
		}
		else
		{
			if($nouveauMdp != $confirmationMdp)
			{
				$message = "Le nouveau mot de passe et sa confirmation sont différents !";
				$typeMessage = "avertissement";
				include_once 'page-5-3-vue.php';
			}
			else 
			{
				$sujet = "Modification de votre mot de passe";
				$message = "Votre mot de passe a été modifié";
				$message = "Votre nouveau mot de passe est :".$nouveauMdp;
				$adresseEmetteur = "delasalle.sio.eleves@gmail.com";
				$adresseDestinataire = "delasalle.sio.paquet.t@gmail.com";
				
				if (preg_match("#^.+@gmail\.com$#", $adresseDestinataire)==true)
				{
					$adresseDestinataire = str_replace(".", "", $adresseDestinataire);
					$adresseDestinataire=str_replace("@gmailcom", "@gmail.com", $adresseDestinataire);
				}
				$ok = mail($adresseDestinataire, $sujet, $message, "From : ".$adresseEmetteur);
			}
			
			if ($ok)
			{
				$message = "Enregistrement effectué. <br>Vous allez recevoir un mail de confirmation.";
				$typeMessage='information';
			}
			else
			{
				$message = "Enregistrement effectué.<br>L'envoi du mail de confirmation a rencontré un problème.";
				$typeMessage = "avertissement";
			}
			include_once ('page-5-3-vue.php');
			}
		}
?>