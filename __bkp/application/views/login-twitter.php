<?php
require("twitter/twitteroauth.php");
define('GD8e8qsoJgh5IW0ww1Kqg', 'Twitter Key');
define('5jYnI1zav13ZgNCnqnMH6M09EdwLVkg4doWARA0Kmm0', 'Twitter Secret Key');

session_start();

$twitteroauth = new TwitterOAuth('GD8e8qsoJgh5IW0ww1Kqg','5jYnI1zav13ZgNCnqnMH6M09EdwLVkg4doWARA0Kmm0');
// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('http://www.tellitize.com/index.php/twitterdata');
// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

// If everything goes well..
if ($twitteroauth->http_code == 200) {
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
?>
