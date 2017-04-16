 <?php
// Author: Xuesen Tan 
// LAB 11
class DatabaseAdaptor {
  // The instance variable used in every one of the functions in class DatbaseAdaptor
  private $DB;
  // Make a connection to an existing data based named 'imdb_small' that has
  // table . In this assignment you will also need a new table named 'users'
  public function __construct() {
    $db = 'mysql:dbname=imdb_small;host=127.0.0.1;charset=utf8';
//  	$db = 'mysql:dbname=test;host=127.0.0.1;charset=utf8';
  	 
    $user = 'root';
    $password = '';
    
    try {
      $this->DB = new PDO ( $db, $user, $password );
      $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
      echo ('Error establishing Connection');
      exit ();
    }
  }
  
  // Return all movies records as an associative array.

  public function getAllActors ($substring ) {
  	$stmt = $this->DB->prepare ( "SELECT * FROM actors WHERE first_name like '%"
  			. $substring . "%'");
  	$stmt->execute ();
  	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
  }
  public function getAllRolls ($substring ) {
  	$stmt = $this->DB->prepare ( "SELECT * FROM roles WHERE role like '%"
  			. $substring . "%'");
  	$stmt->execute ();
  	return $stmt->fetchAll ( PDO::FETCH_ASSOC );
  }
  public function getAllMoviesAndRoles() {
  	// TODO: Return an array containing all roles in all movies.
  	$stmt = $this->DB->prepare ("SELECT actors.first_name,actors.last_name,roles.role,movies.name FROM roles JOIN actors ON actors.id = roles.actor_id JOIN movies ON movies.id = roles.movie_id");
  	$stmt->execute();

  	return $stmt->fetchAll ( PDO::FETCH_ASSOC);
  }
 
} // End class DatabaseAdaptor

// Testing code that should not be run when a part of MVC
$theDBA = new DatabaseAdaptor ();
$arr = $theDBA->getAllMoviesAndRoles ();

$str;
$array = $arr;

for ($i = 0; $i < sizeof($array); $i++)
{
	if($i ==0 ){
		$movie = $array{$i}{'name'};
		//print_r($movie);
		$str = "\n" . "\n" . $movie . "\n";
		
	}
	else if ($movie != $array{$i}{'name'}){
		$movie = $array{$i}{'name'};
		$str .= "\n" . "\n" . $movie . "\n";
	}
	$str .= ' ' . ' ' . $array{$i}{'first_name'}. ' ' . $array{$i}{'last_name'} . "---" . $array{$i}{'role'} . "\n";

}
print_r($str); 
?>