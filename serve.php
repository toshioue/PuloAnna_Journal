<?php
//connect to db and insert
class MyDB extends SQLite3 {
    function __construct() {
       $this->open('entries.db');
    }
 }


/* Ajax get request when user wants to pull up post form, view entries, or delete entry */
if(isset($_GET['action'])){
  $code = $_GET['action'];

  switch ($code) :
      case "0":
          echo file_get_contents("post.html");
          break;

      case "1":
          getEntries();
          break;

      case "2":
          insertEntry($_GET['subj'], $_GET['entry']);
          break;

      case "3":
          updateEntry($_GET['id'], $_GET['subj'], $_GET['entry']);
          break;

      case "4":
          deleteEntry($_GET['id']);
          break;

      default:
          echo "404 Not found";
  endswitch;
}
/*##########################################################################################*/



/* For when user submits journal entry --> connect to db --> store entry --> return sucess */
function insertEntry($subj, $entry){

   //open db connection
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
      //statement to insert entry into db
     $statement = $db->prepare("INSERT INTO entries (Date, Subj, Entry) VALUES (?, ?, ?)");
     $statement->bindParam(1, date('F d, Y'));
     $statement->bindValue(2, $subj);
     $statement->bindValue(3, $entry);
     $statement->execute(); // you can reuse the statement with different values
     $db->close();
     echo "Entry added for " . date('m-d-Y');

   }
 }

function getEntries(){

  //open db connection
  $db = new MyDB();
  if(!$db) {
    echo $db->lastErrorMsg();
  }else{
    $obj = array();
    $num = 0;
    $results = $db->query('SELECT * FROM entries');
      while ($row = $results->fetchArray()) {
        $obj[] = $row;
      }
      echo json_encode($obj);
    $db->close();
  }
}

/*##########################################################################################*/

function updateEntry($id, $subj, $entry){
  $db = new MyDB();
  if(!$db) {
     echo $db->lastErrorMsg();
  } else {
    $statement = $db->prepare("UPDATE entries SET Entry = ?, Subj = ? WHERE EntryNumber = ?");
    $statement->bindParam(1, $entry);
    $statement->bindValue(2, $subj);
    $statement->bindValue(3, $id);
    $statement->execute(); // you can reuse the statement with different values
    $db->close();
    echo "Entry edited for Title: " . $subj ;
  }

}

function deleteEntry($id){
  $db = new MyDB();
  if(!$db) {
     echo $db->lastErrorMsg();
  } else {
    $statement = $db->prepare("DELETE from entries WHERE EntryNumber = ?");
    $statement->bindParam(1, $id);
    $statement->execute(); // you can reuse the statement with different values
    $db->close();
    echo "EntryNumber " . $id . " has been deleted" ;
  }

}



  ?>
