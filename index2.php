<?php

$email = "samsono@gmail.com";
$password = "Edosa03217";
echo $email;
echo rawurlencode($email);

//curl get
function curl_get( $curl, $url, $cookiefile) {
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT,"Windows NT 6.1; WOW64; rv:5.0) Gecko/20100101 Firefox/5.0" );
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
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT,"Windows NT 6.1; WOW64; rv:5.0) Gecko/20100101 Firefox/5.0" );
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiefile);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiefile);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    return $data;
}


//function
$cookiefile = realpath('./cookie.txt');
if (is_writeable($cookiefile)) {
echo '<p>WRITEABLE</p>';
} else {
echo '<p>NOT WRITEABLE</p>';
}
$curl = curl_init( );


//get url to grab GALX & dsh to login
$data = curl_get( $curl, "https://accounts.google.com/Login", $cookiefile);

//print_r($data);
preg_match('/name="GALX"\s*value="(.*?)"/', $data, $galx);

preg_match('/name="dsh" id="dsh"\s*value="(.*?)"/', $data, $dsh);

var_dump($galx);
var_dump($dsh);
//login
$data = curl_post( $curl, "https://www.google.com/accounts/ServiceLoginAuth", $cookiefile, "ltmpl=sso&continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252Findex&service=youtube&uilel=3&dsh=$dsh[1]&ltmpl=sso&hl=en_US&ltmpl=sso&timeStmp=&GALX=$galx[1]&Email=$email&Passwd=$password&PersistentCookie=yes&rmShown=1&signIn=Sign+in&asts=");
print_r($data);

//auth url
$data = curl_get( $curl, "https://www.google.com/accounts/b/0/ManageAccount", $cookiefile);
print_r($data);

// youtube 
//$data = curl_get( $curl, "http://www.youtube.com/inbox?feature=mhsn", $cookiefile);
//print_r($data);

