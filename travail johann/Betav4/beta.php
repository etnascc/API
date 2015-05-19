<?php

include "statistiques.php";

//connection at github
function my_get_json($url)
{
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

function get_info_by_organization($user) {
	//test if limit reach
	$parsed_json = json_decode(my_get_json("rate_limit?access_token=a6f162fe9dd5745cfaa1e387321b3ce59ede3a27"),true);
	if ($parsed_json['rate']['remaining'] != 0)
	{
		$repos_orgarnization = my_get_repo($user);
		//test
		//var_dump($repos_orgarnization[$i]['full_name']);
		var_dump(get_nbr_contrib($repos_orgarnization));
		var_dump(get_commit_activity($repos_orgarnization));
		var_dump(get_code_frequency($repos_orgarnization));
		var_dump(get_punch_card($repos_orgarnization));
		var_dump(get_participation($repos_orgarnization));
	}
	else
		echo "Une erreur est apparue (limite ou autres)<br/>";
}

?>