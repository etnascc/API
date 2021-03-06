<?php

//connection at github
function my_get_json($url){
  $base = "https://api.github.com/";
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $base . $url);
  curl_setopt($curl, CURLOPT_USERAGENT, "Farconer");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    //curl_setopt($curl, CONNECTTIMEOUT, 1);
  $content = curl_exec($curl);
  curl_close($curl);
  return $content;
}

function get_nbr_contrib($full_name)
{
	echo "nom complet: $full_name<br/>";
	$parsed_json = json_decode(my_get_json("repos/$full_name/stats/contributors?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	//test
	//var_dump($parsed_json);
	$nbr_total_semaine = 0;
	$weeks = array('a' => 0 'd' => 0, 'c' => 0, 'w');
	for($i = 0; $i < count($parsed_json); $i++)
		for($j = 0; $i < count($weeks); $j++)
		{
			$weeks['a'] = $weeks['a'] + $parsed_json[$i]['weeks'][$j]['a'];
			$weeks['d'] = $weeks['d'] + $parsed_json[$i]['weeks'][$j]['d'];
			$weeks['c'] = $weeks['c'] + $parsed_json[$i]['weeks'][$j]['d'];
			$weeks['w'] = date('l d/m/y', $weeks[$i]['w']);
		}
		echo "la semaine du {$weeks['w']}, vous avez effectuer {$weeks['a']} ajout(s), {$weeks['d']} supression et {$weeks['c']} commit <br/>";
	}
}

function get_nbr_commit($full_name)
{
	$parsed_json = json_decode(my_get_json("repos/$full_name/stats/commit_activity?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	//contient 52 tableau qui correspont au activité 52 semaines avant aujourd'hui
	//une semaine est un tableau qui contient 3 lignes :
	//-la semaine (tableau de 7 jours qui va de Dimanche à samedi et contient le nb de "commit")
	//-le total (entier qui indique le nb total de "commit" dans la semaine)
	//-la date de semaine en timelaps (date de chaque dimanche de chaque semaine)
	for($i = 0; $i < count($parsed_json); $i++)
	{
		echo "pour la semaine du ".date('l d/m/y', $parsed_json[$i]['week'])."<br/>";
		for ($j = 0; $j < count($parsed_json[$i]['days']); $j++)
		{
			$jour = $j + 1;
			echo "le jour {$jour}, il y a eu ".$parsed_json[$i]['days'][$j]." actions effectuer<br/>";
		}
		echo "le total de cette semaine est de {$parsed_json[$i]['total']} actions effectuer<br/><br/>";
	}
}

//Additions and Deletions per week
function get_code_frequency($full_name)
{
	$parsed_json = json_decode(my_get_json("repos/$full_name/stats/code_frequency?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	//table de 52 entrée correspondant à 52 ligne retournant un entier
	$all = $parsed_json['all'];
	//table de 52 entrée correspondant à 52 ligne retournant un entier
	$owner = $parsed_json['owner'];
}

function get_participation($full_name)
{
	$parsed_json = json_decode(my_get_json("repos/$full_name/stats/participation?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
}

//test stats
function get_info_by_organization($user) {
	//test if limit reach
	//$parsed_json = json_decode(my_get_json("rate_limit?client_id=656639965d2e27e42c7f6bbcc47e62e44e31345a&client_secret=656639965d2e27e42c7f6bbcc47e62e44e31345a"),true);
	$parsed_json = json_decode(my_get_json("rate_limit?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	//test limite
	//var_dump($parsed_json);
	if ($parsed_json['rate']['remaining'] != 0)
	{
		$repos_orgarnization = json_decode(my_get_json("orgs/$user/repos?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		for ($i = 0; $i < count($repos_orgarnization); $i++)
		{
			//test
			//var_dump($repos_orgarnization[$i]['full_name']);
			get_nbr_contrib($repos_orgarnization[$i]['full_name']);
			//get_nbr_commit($repos_orgarnization[$i]['full_name']);
			//get_code_frequency($repos_orgarnization[$i]['full_name']);
			//get_participation($repos_orgarnization[$i]['full_name']);
		}
	}
	else
	{
		echo "Une erreur est apparue (limite ou autres)<br/>";
	}
}

get_info_by_organization("etnascc");

?>