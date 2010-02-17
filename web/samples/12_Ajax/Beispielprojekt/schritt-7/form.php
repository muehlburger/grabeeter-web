<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
     <head>
          <title>Ajax: Beispiel</title>
          <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
          <link rel="stylesheet" href="css.css" type="text/css" media="screen" />

<script type="text/javascript">
var request = false;
try {
	request = new XMLHttpRequest();
}
catch (msxml2failure) {
	try {
		request = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (msfailure) {
		try {
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (failure) {
			request = false;
		}
	}
}
if (!request)
       alert("Your browser doesn’t support XMLHttpRequest! Please update your browser.");
function getFetchedInput () {
	var inputISBN = document.getElementById("isbn").value;
	var urlQuery = "/home/htdocs/validation/checkISBN.php?input=" + escape(inputISBN);
	request.open ("GET", urlQuery, true);
	request.onreadystatechange = updateISBNField;
	request.send (null);
}
function getCompleteInput () {
	var inputISBN = document.getElementById("ISBN").value;
	var urlQuery = "queryISBN.php?input=" + 
	          escape(inputISBN);
	setupPreview( );
	request.open ("GET", urlQuery, true);
	request.onreadystatechange = updatePreview;
	request.send (null);
}
function updateISBNField () {
	if (request.readyState == 4) {
		if (request.status == 200) {
			var response = request.responseText;
			if (response == true) {
				document.getElementById("ISBN").className = 'verified';
			} else {
				document.getElementById("ISBN").className = 'failed';
			}
		}
	}
}
function updatePreview () {
	if (request.readyState == 4) {
		if (request.status == 200) {
			// Der Serverskript liefert die Daten aus der Datenbank, getrennt // durch das Pipe-Zeichen zurück; die einzelnen Einträge werden
			// mit der split(‘separator’)-Methode in Array response abgelegt.
			var response = request.responseText.split("|");
			// Die Daten werden von Array innerhalb der jeweiligen
			// Seitenelemente über das innerHTML-Attribut gespeichert.
			document.getElementById("isbnnum").innerHTML = response[0];
			document.getElementById("autor").innerHTML = response[1];
			document.getElementById("buchtitel").innerHTML = response[2];
			document.getElementById("preis").innerHTML = response[3];
			document.getElementById("vorschau").innerHTML = response[4];
			// Die Klasse des div-Blocks #info wird auf ‚visible’gesetzt
			// <=> Der Inhalt des Blocks soll angezeigt werden. 
			document.getElementById("info").className = 'visible';
		}
	}
}
function setupPreview () {
	// Details zur ISBN-Nummer (Daten in der Tabelle)
	// werden mit temporärem Preloader versehen
	document.getElementById("isbnnum").innerHTML = '<img src=\"preloading.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	...Analog für alle Eingabefelder...
	          document.getElementById("preis").innerHTML = '<img src=\"preloading.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	// Der Infoblock wird eingeblendet
	document.getElementById("info").className = 'visible';
}
</script>
     </head>
<body>

<form action="form.php" method="post">
	<div id="wrapper">
		<div id="content" class="narrowcolumn">
			<h2>Katalog</h2>
			<div class="contactform">
				<div class="contactleft">
					<label for="ISBN">ISBN: </label>
				</div>
				<div class="contactright">
					<input name="ISBN" id="ISBN" onchange="getCompleteInput();" class="passive" onkeydown="getFetchedInput();" size="30" maxlength="50" value="" type="text" /><span class="required">*</span>
				</div>
				<div id="separatorTop">
				</div>
				<div id="info" class="invisible">
					<table summary="Daten zu einer ISBN-Nummer" id="details">
					<caption>Vorschau des Buches zu einer ISBN-Nummer</caption>
					<thead>
          				<tr>
          					<th>
          						ISBN
          					</th>
          					<th>
          						Autor
          					</th>
          					<th>
          						Buchtitel
          					</th>
          					<th>
          						Preis (EUR)
          					</th>
          				</tr>
					</thead>
					<tbody>
					<tr>
						<td id="isbnnum">
						</td>
						<td id="autor">
						</td>
						<td id="buchtitel">
						</td>
						<td id="preis">
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<div id="separatorBottom">
				</div>
				<div class="contactleft">
					<label for="Feedback">Rückmeldung: </label>
				</div>
				<div class="contactright">
					<textarea name="Feedback" id="Feedback" cols="35" rows="8"></textarea>
				</div>
				<div class="contactleft">
					<label for="Email">Email:</label>
				</div>
				<div class="contactright">
					<input name="Email" id="Email" size="30" maxlength="50" value="" type="text" /><span class="required">*</span>
				</div>
				<div class="contactright">
					<input name="submit" value="Absenden!" id="subm" type="submit">
				</div>
			</div>
		</div>
	</div>
</form>

</body>
</html>