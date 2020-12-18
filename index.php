<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pulo_Anna's Journey</title>
    <link rel="icon" type="image/png" href="img/icon.png">

  <!--Bootsrap/JS dependencies-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/jquery-slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="ajax.js"></script> <!--this is for quotes API in ajax.js -->

  <!--Lato font -->
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

  </head>

  <body onload="getQuote()">

    <!--Static side-bar -->
    <button id="close" class="mt-4" onclick="toggle(this)">&#9776;</button>
    <div id="side" class="sidenav jumbotron text-center">
        <button class="shadow" onclick="toggle(this)">&#9776;</button>
        <p class="lead text-dark" onclick="window.location.reload();">Pulo Anna's Journal</p><hr>
        <a onclick="AJAX_GET('serve.php', {'action': '0'}, setAdd, '');" href="#">Add</a><hr>
        <a onclick="AJAX_GET('serve.php', {'action': '1'}, setView, '');" href="#">View</a><hr>
        <a href="#">About</a>
    </div>

    <!-- main feature for view/add/delete entries -->
    <div id="main" class="main">

      <div id="content" class="container text-center">
      <img id="icon" src="img/icon.png" class="bg-icon mt-4">
      <blockquote class="blockquote mt-3">
        <p id="quote" style="color: white;" class="mb-0 t-shadow"></p>
        <footer class="blockquote-footer"><cite id="author" style="color: #C0C0C0;" title="Source Title"></cite></footer>
      </blockquote>
      </div>

    </div>

    <!-- Modal for Edit -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body text-center">
        Do you want to edit this entry?
      </div>
      <div class="modal-footer text-center justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="edit(document.getElementById('id').innerHTML, document.getElementById('date').innerHTML, document.getElementById('subj').innerHTML, document.getElementById('enter').innerHTML )" >Edit</button>
      </div>
    </div>
  </div>
</div>
    <!-- Modal for Delete  -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body text-center">
        Do you want to delete this entry?
      </div>
      <div class="modal-footer text-center justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="del(document.getElementById('id').innerHTML)" >Delete</button>
      </div>
    </div>
  </div>
</div>


<!--START OF JAVASCRIPT PORTION-->
  <script>


    //DECLARED GLOBAL VARIABLES
    var storedEntries;


    /*This is for sideBar toggle feature *////
    var x = 1;
    var w = "130px";
    var m = "140px";

    function toggle(){
        if(x == 1){
          console.log("close");
          w = document.getElementById('side').style.width;
          m = document.getElementById('main').style.marginLeft;
          document.getElementById('side').style.width = "0px";
          document.getElementById('main').style.marginLeft = "0px";
          if(document.getElementById('icon')){
            document.getElementById('icon').height = document.getElementById('icon').height / 2;
          }
          document.getElementById('close').style.display = "inline";
          x = 0;
        }else{
          console.log("open");
          document.getElementById('close').style.display= "none";
          document.getElementById('side').style.width = w;
          document.getElementById('main').style.marginLeft = m;
          if(document.getElementById('icon')){
            document.getElementById('icon').height = document.getElementById('icon').height * 2;
          }
          x = 1;

        }
      }
      /**********************************************/
    /* this function gets called when Add link is clicked which then
       sends an AJAX call to serve.php to minimize sidbar and retrieve the post.html*/
    function setAdd(content){
      console.log("Add form set");
      $('#main').empty();
      $('#main').removeClass("text-center");
      $('#main').html(content);
      //toggle();
    }
    /* this function gets called when entry in post.html is clicked which then
       sends an AJAX call to serve.php to insert params into db*/
    function insert(){
      var subj = $('#subj').val();
      var entry = $('#entry').val();
      var id = $('#EntryID').attr('value');
      console.log(id);
      //determines if user is editing or submitting new entry based on if entryID already exists.
      if(id){
        console.log('theres an id');
        AJAX_GET('serve.php', {'action' : '3', 'subj': subj, 'entry' : entry, 'id' : id}, result, '');

      }else{
        console.log('theres no id');
        AJAX_GET('serve.php', { 'action' : '2', 'subj': subj, 'entry' : entry}, result, '');
      }
    }
    /*function gets called when AJAX call for insert() runs successfully
      this sets the main div to display that the insertion was sucessful */
    function result(x){
      document.getElementById("main").innerHTML =
      "<div class='text-center text-white' style='margin-top: 100px;'><h1 class='display-4 move'>" + x +
      "</h1><button type='button' class='btn btn-primary' onclick='window.location.reload()'>OK</button></div>";
    }

    //This function gets called when view button is clicked
    //and handles returned entries via AJAX
    function setView(entries){

        entries = JSON.parse(entries);
        console.log(entries);
        toggle();
        $('#main').empty();

        for(var obj in entries){
          /*debug purposes*/
        //  console.log(obj.Entry);
        //  console.log(entries[obj]);
        //  console.log(entries[obj].Entry + " " + entries[obj].Date + " " + entries[obj].EntryNumber );

          //////////////////////////////////////

          //create cards obj to contain entries and display to #main
          console.log("Add form set");
          $('#main').addClass("text-center"); //centers cards on display
          $('#main').css('marginLeft', "20px"); //adjust margin-Left
          //warp individual entries inside a card
          $('#main').append('<div class="text-left mx-auto mt-3 w-75 card shadow border border-secondary"><h5 class="card-header">' + entries[obj].Date + '</h5><div class="card-body"><h5 class="h3">"' +
          entries[obj].Subj + '</h5><p class="lead"> ' + entries[obj].Entry.slice(0,100) +
          '...<p></div><a onclick="showSingleEntry(\'' + obj + '\')" class="mb-0 btn-color btn  btn-lg btn-block rounded-0">Read</a></div></br>').hide();
          //animation to make card appear slowly
          $('#main').show('fast');

        }
        storedEntries = entries;


    }
    /* this function will display a single entry that is clicked on to the main div*/
    function showSingleEntry(d){
      toggle();
      console.log(storedEntries[d]);
      $('#main').empty();
      $('#main').removeClass("text-center");

      $('#main').append("<div id='singleEntry' class='ml-1 mt-3 jumbotron border border-light shadow '><div class='d-flex justify-content-between' ><span id='id' hidden>" +storedEntries[d].EntryNumber +"</span><h4 >Date:<span id='date'> " + storedEntries[d].Date + "</span></h4><div ><button  id='edit' type='button' class='btn btn-warning' data-toggle='modal' data-target='#exampleModal' alt='edit post' >&#10000;</button><button  id='delete' type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal2' alt='delete post'>&#10060;</button></div></div><hr><h4 id='subj'>" + storedEntries[d].Subj + "</h4><hr><p id='enter' style='white-space: pre-wrap;' class='lead'>" + storedEntries[d].Entry + "</p></div>").hide().fadeIn("slow");
      //<button id='edit' class='btn btn-warning'  data-container='body' data-toggle='popover' data-placement='left' data-content='you want to edit this entry?'>&#9998;</button>
    }
    /*
    This function is used to send an  AJAX call to the server and send back the form with pre-filled
    entry for submission
    */
    function edit(id, date, subj, entry){
      var info = [id, date, subj, entry];
      console.log(subj);
      //this AJAX contains callArgs to signal AJAX that user is editing an entry
      AJAX_GET('serve.php', {'action': '0'}, setAdd, info);
    }

    function del(id){
      console.log("EntryNumber: " + id + " is going to be deleted.");
       AJAX_GET('serve.php', {'action': '4', 'id' : id}, result, '');
    }


  </script>

  </body>
</html>
