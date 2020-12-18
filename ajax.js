
/*this function gets called in index.php to retrieve quote content from API via AJAX */
function getQuote(){

var data = null;
var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
	if (this.readyState === this.DONE ) {

		/*print to console, set quote and originator to site on done laoding */
		console.log(this.responseText);
		console.log(this.statusText);
		if (this.statusText == "OK"){
		 var quote = JSON.parse(this.responseText);
		 	document.getElementById('quote').innerHTML = "\"" + quote.content + "\"";
		 	document.getElementById('author').innerHTML = quote.originator.name;
		 	document.getElementById('quote').classList.add('move');
	 	}else{
			document.getElementById('quote').innerHTML = "\" If you cannot hang, onom tang\"";
	 		document.getElementById('author').innerHTML = "Mr. Tang";
			document.getElementById('quote').classList.add('move');
		}
	}
});

xhr.open("GET", "https://quotes15.p.rapidapi.com/quotes/random/?language_code=en");
xhr.setRequestHeader("x-rapidapi-host", "quotes15.p.rapidapi.com");
xhr.setRequestHeader("x-rapidapi-key", "2a9508ecd5msh2624289ed7691dbp18d02bjsnf44baa84284c");

xhr.send(data);

}


function AJAX_GET(ajaxBaseUrl, ajaxVars, callFunction, callArgs) {
  var xhttp;
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xhttp =new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			callFunction(xhttp.responseText);
			//if there are callArgs that means the user wants to edit a post not submit a new one.
			if(!callArgs){
					console.log("there were no call Args");
			}else{
					console.log("there were  call Args");

					$("#datetime").html(callArgs[1]);
					$("#subj").attr('value', callArgs[2]);
					$("#entry").html(callArgs[3]);
					$("#main").append("<span id='EntryID' hidden value=" + callArgs[0] + "></span>");

			}
    }
  };
  let counter = 0;
  for (let key in ajaxVars) {
    if (counter == 0) {
      ajaxBaseUrl += '?';
    } else {
      ajaxBaseUrl += '&';
    }
    ajaxBaseUrl += encodeURIComponent(key) + '=' + encodeURIComponent(ajaxVars[key]);
    counter++;
  }
  console.log("Ajax GET URL:", ajaxBaseUrl);
  xhttp.open("GET", ajaxBaseUrl, true);
  xhttp.send();
}

//ajax call to server to get discussion posts.
// AJAX_GET('next.php', {'postCount': globalPostCount}, setFeed, '');
