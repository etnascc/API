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

function myget_repo($name_orga)
{
	$parsed_json = json_decode(my_get_json("orgs/$name_orga/repos?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	$i = 0;
	while (isset($parsed_json[$i]['full_name']))
	{
		$tab[$i] = $parsed_json[$i]['full_name'];
		$i++;
	}
	return ($tab);
}

function get_nbr_contrib($tab)
{
	$weeks =  array('a' => 0, 'd' => 0, 'c' => 0, 'w', 'total' => 0);
	for ($i = 0; $i < count($tab); $i++)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/contributors?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		$nbr_total_semaine = 0;
		for($k = 0; $k < count($parsed_json); $k++)
		{
			$weeks['a'] = $weeks['a'] + $parsed_json[$k]['weeks'][0]['a'];
			$weeks['d'] = $weeks['d'] + $parsed_json[$k]['weeks'][0]['d'];
			$weeks['c'] = $weeks['c'] + $parsed_json[$k]['weeks'][0]['c'];
			$weeks['w'] = date('l d/m/y', $parsed_json[$k]['weeks'][0]['w']);
			$weeks['total'] = $weeks['total'] + $parsed_json[$k]['total'];
		}
		/*test
		echo "la semaine du {$weeks['w']}, vous avez effectuer {$weeks['a']} ajout(s), {$weeks['d']} supression et {$weeks['c']} commit <br/>";*/
	}
}

function get_info_by_organization($user) {
	//test if limit reach
	//$parsed_json = json_decode(my_get_json("rate_limit?client_id=656639965d2e27e42c7f6bbcc47e62e44e31345a&client_secret=656639965d2e27e42c7f6bbcc47e62e44e31345a"),true);
	$parsed_json = json_decode(my_get_json("rate_limit?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	//test limite
	//var_dump($parsed_json);
	if ($parsed_json['rate']['remaining'] != 0)
	{
		$repos_orgarnization = myget_repo($user);
		//test
		//var_dump($repos_orgarnization[$i]['full_name']);
		get_nbr_contrib($repos_orgarnization);
		//get_nbr_commit($repos_orgarnization[$i]['full_name']);
		//get_code_frequency($repos_orgarnization[$i]['full_name']);
		//get_participation($repos_orgarnization[$i]['full_name']);
	}
	else
	{
		echo "Une erreur est apparue (limite ou autres)<br/>";
	}
}

get_info_by_organization("etnascc");

?>