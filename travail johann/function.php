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

function myget_commit_activity($tab)
{
	$length = count($tab);
	$i = 0;
	$tab_activity = null;
	while ($i < $length)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/commit_activity?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		if (!isset($tab_activity))
		{
			$tab_activity = $parsed_json;
			$i++;
			$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/commit_activity?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		}
		
		$k = 0;
		while (isset($parsed_json[$k]))
		{
			$j=0;
			while (isset($parsed_json[$k]['days'][$j]))
			{
				$tab_activity[$k]['days'][$j] = $parsed_json[$k]['days'][$j] + $tab_activity[$k]['days'][$j];
				$tab_activity[$k]['total'] = $tab_activity[$k]['total'] + $parsed_json[$k]['total'];
				$j++;
			}
			$k++;
		}
		$i++;
	}
	return ($tab_activity);
}

function myget_punch_card($tab)
{
	$length = count($tab);
	$i = 0;
	$tab_punch = null;
	while ($i < $length)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/punch_card?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		if (!isset($tab_punch))
		{
			$tab_punch = $parsed_json;
			$i++;
			$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/punch_card?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
		}
		
		$k = 0;
		while (isset($parsed_json[$k]))
		{

			$tab_punch[$k][2] = $tab_punch[$k][2] + $parsed_json[$k][2];
			$k++;
		}
		$i++;
	}
	return ($tab_punch);
}

function myget_participation($tab)
{
	$length = count($tab);
	$i = 0;
	$tab_parti = null;
	while ($i < $length)
	{
		$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/participation?access_token=ea0723fa28d6dde7ccfd7a9b46c457398ca8685a"),true);
		if (!isset($tab_parti))
		{
			$tab_parti = $parsed_json;
			$i++;
			$parsed_json = json_decode(my_get_json("repos/$tab[$i]/stats/participation?access_token=ea0723fa28d6dde7ccfd7a9b46c457398ca8685a"),true);
		}

			$j=0;
			while(isset($parsed_json['all'][$j]))
			{
				$tab_parti['all'][$j] = $parsed_json['all'][$j] +  $tab_parti['all'][$j];
				$j++;
			}
			$j = 0;
			while(isset($parsed_json['owner'][$j]))
			{
				$tab_parti['owner'][$j] = $parsed_json['owner'][$j] +  $tab_parti['owner'][$j];
				$j++;
			}
		$i++;
	}
	return ($tab_parti);
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
		//var_dump(myget_commit_activity($repos_orgarnization));
		//var_dump(myget_punch_card($repos_orgarnization));
		var_dump(myget_participation($repos_orgarnization));
		
	}
	else
	{
		echo "Une erreur est apparue (limite ou autres)<br/>";
	}
}

get_info_by_organization("etnascc");

?>