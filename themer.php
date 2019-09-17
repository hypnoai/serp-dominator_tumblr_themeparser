<?php
/**
 * Themer
 *
 * A Tumblr theme parser for local development.
 *
 * @package   Themer
 * @author    Braden Schaeffer 
 * @version   beta
 * @link      http://github.com/bschaeffer/themer
 *
 * @copyright Copyright (c) 2011
 * @license   http://www.opensource.org/licenses/mit-license.html MIT
 *
 * @filesource
 */

// We are either being required from source
if(strpos('@php_bin@', '@php_bin') === 0)
{
  define('THEMER_BASEPATH', __DIR__.'/');
}
// or a PEAR installation
else
{
  define('THEMER_BASEPATH', 'themer/');
}

$servername = "localhost";
$username = "root";
$password = "CleverMarketingDuo5";
$db = "serpdominator";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
define('THEME_ID', $_GET["themeid"]);
$themeid = 1;

if( null !== (htmlspecialchars($_COOKIE["themeid"])) ) {
   $themeid = $_COOKIE["themeid"]; 
} 

$sql = "SELECT * FROM `tumblr_themes` where id = ".$themeid;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //print("got theme!");
      define('HTML_SCRIPT', $row["theme_html"]);
      //echo "id: " . $row["id"]. " - Name: " . $row["theme_name"]. " " . $row["theme_html"]. "<br>";
    }
} else {
  $sql = "SELECT * FROM `tumblr_themes` order by id asc";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        //print("got theme!");
        define('HTML_SCRIPT', $row["theme_html"]);
        //echo "id: " . $row["id"]. " - Name: " . $row["theme_name"]. " " . $row["theme_html"]. "<br>";
      }
  } 
  define('HTML_SCRIPT', '<html><h1>No Theme loaded!</h1></html>');
}


/*-------------------------------------------------------
* Setup Themer
-------------------------------------------------------*/

require THEMER_BASEPATH.'themer/autoloader.php';
require THEMER_BASEPATH.'themer/themer.php';

set_exception_handler('Themer\Error::exception_handler');
set_error_handler('Themer\Error::php_error');

/* End of file themer.php */
/* Location: ./themer.php */