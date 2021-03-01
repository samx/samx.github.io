<?php


$email = rawurlencode("samsono@gmail.com");
$password = "Edosa032171";
echo $email;

//curl get
function curl_get( $curl, $url, $cookiefile) {
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    return $data;
}

//curl post

function curl_post( $curl, $url, $cookiefile, $post) {
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    return $data;
}
$curl = curl_init( );

//cookie file
$cookiefile = "cookie.txt";
$data = curl_get( $curl, "https://www.google.com/accounts/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl
 &followup=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&service=bookmarks&chtml=LoginDoneHtml", $cookiefile);

print_r($data);




echo "<br><br><br>-----------------------------------<br><br><br>";

//get url to grab GALX & dsh to login
$data = curl_get( $curl, "https://accounts.google.com/Login", $cookiefile);

//print_r($data);
preg_match('/name="GALX"\s*value="(.*?)"/', $data, $galx);

preg_match('/name="dsh" id="dsh"\s*value="(.*?)"/', $data, $dsh);

echo $galx[1];
//login
$data = curl_post( $curl, "https://www.google.com/accounts/ServiceLoginAuth", $cookiefile, "?Email=".$email."&GALX=".$galx[1]."&Passwd=".$password."&PersistentCookie=yes&asts=
 &continue=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&dsh=".$dsh[1]."
 &followup=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&nui=1&rmShown=1&secTok=
 &service=bookmarks&signIn=Sign%20in&timeStmp=");

//auth url
$data = curl_get( $curl, "https://www.google.com/accounts/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl
 &followup=https%3A%2F%2Fwww.google.com%2Fbookmarks%2Fl&service=bookmarks&chtml=LoginDoneHtml", $cookiefile);



print_r($data);

$data = curl_get( $curl, "https://www.google.com/bookmarks/api/thread?op=ShowThread&threadID=GMMTuirVbnLU%2FBDSAnDAoQmcDiiK4m", $cookiefile);

print_r($data);

?>
