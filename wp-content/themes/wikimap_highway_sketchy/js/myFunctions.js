// JavaScript Document
function Oculta(id){document.getElementById(id).style.display = "none";}
function Muestra(id){document.getElementById(id).style.display = "";}
function CreaAjax(){var myConn = new XHConn(); if (!myConn) alert("XMLHTTP not available. Try a newer/better browser.");return myConn;}
function Loading() { return '<p style="text-align:center;"><img src="' + imgLoading + '" alt="Cargando..." /></p>';}

function comments(id,img){
        target= document.getElementById("divComment"+id);
            target.style.display= "";
						var myConn = CreaAjax();
			            var comments = function (oXML) { 
							target.style.display = "none";
							target.innerHTML = oXML.responseText;
							Muestra('divComment'+id);
						};
            myConn.connect(urlComments, "POST", "comment_post_ID="+id+"&index="+img, comments);
}

function NuevoComment(id,action,MiFormu)
{
		autor = MiFormu.elements["author"].value;
		email = MiFormu.elements["email"].value;
		url = MiFormu.elements["url"].value;
		comment = MiFormu.elements["comment"].value;
		target= document.getElementById('divComment'+id);
		target.innerHTML += '<p style="text-align:center;">Insertando comentario</p>';
		target.innerHTML += Loading();
		var myConn = CreaAjax();
    var inserta = function (oXML) {commentNew(id);};
    myConn.connect(action, "POST", "comment_post_ID="+ id +"&author=" + autor + "&email=" + email + "&url=" + url + "&comment=" + comment, inserta);
}
function commentNew(id){
        target= document.getElementById("divComment"+id);
        target.style.display= "";
		var myConn = CreaAjax();
	    var comments = function (oXML) {
			target.style.display = "none";
			target.innerHTML = oXML.responseText;
			Muestra("divComment"+id);
		};
		myConn.connect(urlComments, "POST", "comment_post_ID="+id, comments);
}
function autoComplete(donde,desde) {
    target= document.getElementById(donde);
	var myConn = CreaAjax();
	var buscar = desde.value;
	desde.autocomplete ="off";
	target.innerHTML = "Cargando...";
	var fncWhenDone = function (oXML) { 
		target.style.display = "none";
		target.innerHTML = oXML.responseText;
		Muestra(donde);
	};
	myConn.connect(urlSearch, "POST", "s=" + buscar, fncWhenDone);
}
/** XHConn - Simple XMLHTTP Interface - bfults@gmail.com - 2005-04-08        **
 ** Code licensed under Creative Commons Attribution-ShareAlike License      **
 ** http://creativecommons.org/licenses/by-sa/2.0/                           **/
function XHConn()
{
  var xmlhttp, bComplete = false;
  try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
  catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
  catch (e) { try { xmlhttp = new XMLHttpRequest(); }
  catch (e) { xmlhttp = false; }}}
  if (!xmlhttp) return null;
  this.connect = function(sURL, sMethod, sVars, fnDone)
  {
    if (!xmlhttp) return false;
    bComplete = false;
    sMethod = sMethod.toUpperCase();
    try {
      if (sMethod == "GET"){xmlhttp.open(sMethod, sURL+"?"+sVars, true); sVars = "";}
      else {
        xmlhttp.open(sMethod, sURL, true);
        xmlhttp.setRequestHeader("Method", "POST "+sURL+" HTTP/1.1");
        xmlhttp.setRequestHeader("Content-Type",
          "application/x-www-form-urlencoded");
      }
      xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && !bComplete){ bComplete = true;fnDone(xmlhttp);}};
      xmlhttp.send(sVars);
    }
    catch(z) { return false; }
    return true;
  };
  return this;
}