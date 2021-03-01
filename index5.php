<?php
// Construct an HTTP POST request
$clientlogin_url = "https://www.google.com/accounts/ClientLogin";
$clientlogin_post = array(
    "accountType" => "google",
    "Email" => "samsono@gmail.com",
    "Passwd" => "Edosa032171",
    "service" => "bookmarks"
);

// Initialize the curl object
$curl = curl_init($clientlogin_url);

// Set some options (some for SHTTP)
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $clientlogin_post);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// Execute
$response = curl_exec($curl);

// Get the Auth string and save it
preg_match("/Auth=([a-z0-9_\-]+)/i", $response, $matches);
$auth = $matches[1];

echo "The auth string is: " . $auth;


$headers = array(
    "Authorization: GoogleLogin auth=" . $auth,
    "GData-Version: 3.0",
);


// Make the request
curl_setopt($curl, CURLOPT_URL, "https://www.google.com/bookmarks/api/threadsearch?q=&start=&fo=&g=");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, false);

$response = curl_exec($curl);
curl_close($curl);

print_r($response);
?>