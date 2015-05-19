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
	$parsed_json = json_decode(my_get_json("orgs/$name_orga/repos?access_token=864c7603a908717989fdea759e7c46b7048e080b"),true);
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
	$weeks = array();
	$first = true;
	for ($i = 0; $i < count($tab); $i++)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/contributors?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		for($j = 0; $j < count($parsed_json); $j++)
		{
			for($k = 0; $k < count($parsed_json[$j]['weeks']); $k++)
			{
				$date = $parsed_json[$j]['weeks'][$k]['w'];
				if (isset($weeks[$date]))
				{
					$weeks[$date]['a'] = $weeks[$date]['a'] + $parsed_json[$j]['weeks'][$k]['a'];
					$weeks[$date]['d'] = $weeks[$date]['d'] + $parsed_json[$j]['weeks'][$k]['d'];
					$weeks[$date]['c'] = $weeks[$date]['c'] + $parsed_json[$j]['weeks'][$k]['c'];
				}
				else
				{
					$weeks[$date]['a'] = $parsed_json[$j]['weeks'][$k]['a'];
					$weeks[$date]['d'] = $parsed_json[$j]['weeks'][$k]['d'];
					$weeks[$date]['c'] = $parsed_json[$j]['weeks'][$k]['c'];
				}
			}
			$first = false;
		}
	}
	var_dump($weeks);
}

function get_code_frequency($tab)
{
	$weeks = array();
	for ($i = 0; $i < count($tab); $i++)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/code_frequency?access_token=aa7de7b2dbde85ccba017cd41a271560f0c1b4b0"),true);
		for($j = 0; $j < count($parsed_json); $j++)
		{
			$date = $parsed_json[$j][0];
			if (isset($weeks[$date]))
			{
				$weeks[$date]['a'] = $weeks[$date]['a'] + $parsed_json[$j][1];
				$weeks[$date]['d'] = $weeks[$date]['d'] + $parsed_json[$j][2];
			}
			else
			{
				$weeks[$date]['a'] = $parsed_json[$j][1];
				$weeks[$date]['d'] = $parsed_json[$j][2];
			}
		}
	}
	var_dump($weeks);
}

function get_info_by_organization($user) {
	//test if limit reach
	//$parsed_json = json_decode(my_get_json("rate_limit?client_id=656639965d2e27e42c7f6bbcc47e62e44e31345a&client_secret=656639965d2e27e42c7f6bbcc47e62e44e31345a"),true);
	$parsed_json = json_decode(my_get_json("rate_limit?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	if ($parsed_json['rate']['remaining'] != 0)
	{
		$repos_orgarnization = myget_repo($user);
		//test
		//var_dump($repos_orgarnization[$i]['full_name']);
		get_nbr_contrib($repos_orgarnization);
		//get_nbr_commit($repos_orgarnization[$i]['full_name']);
		get_code_frequency($repos_orgarnization);
		//get_participation($repos_orgarnization[$i]['full_name']);
	}
	else
	{
		echo "Une erreur est apparue (limite ou autres)<br/>";
	}
}

get_info_by_organization("etnascc");

?>