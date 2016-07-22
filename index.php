<?php 

error_reporting(0);

require 'simple_html_dom.php';

function current_link() {

 $pageURL = 'http';

 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}



function redirectUrl() {

	global $currentpage;

	global $current_domain;

	global $domain_to_redirect;

	return str_replace($current_domain,$domain_to_redirect,$currentpage);

}



$currentpage = current_link();

$current_domain = "noodlafact.com";

$domain_to_redirect = "viraldamn.net";





function getTitle($str){

    if(strlen($str)>0){

        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);

        return $title[1];

    }

}







$page_content = file_get_contents(redirectUrl());



$dom_obj = new DOMDocument();

$dom_obj->loadHTML($page_content);

$meta_val = null;



foreach($dom_obj->getElementsByTagName('meta') as $meta) {



if($meta->getAttribute('property')=='og:image'){ 



    $meta_val = $meta->getAttribute('content');

}

}





$title = getTitle($page_content);





		

?>
<!DOCTYPE html>

<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:image" content="<?php echo $meta_val ?>" />
    <meta property="og:url" content="<?php echo $currentpage ?>" />
    <meta property="og:site_name" content="ViralDamn" />
    <meta property="article:section" content="Uncategorized" />    
</head>



Please wait while the article is loaded. <a href="<?php echo redirectUrl() ?>"><h1>Click Here to continue</h1></a>

<script type="text/javascript">

    <!--

    window.location = "<?php echo redirectUrl() ?>";

    //-->

</script>





<h1><?php echo $title; ?></h1><br />

<img src="<?php echo $meta_val ?>" alt="<?php echo $title; ?>" /><br />






</body>

</html>