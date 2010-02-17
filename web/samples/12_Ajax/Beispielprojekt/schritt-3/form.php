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
function getFetchedInput() {
	var inputISBN = document.getElementById("ISBN").value;
	var query = "/home/htdocs/validation/checkISBN.php?input=" + escape(inputISBN);
	// ...Versenden der Anfrage...
	// ...Behandlung der Serverantwort...
}
function getCompleteInput () {
	var inputISBN = document.getElementById("ISBN").value;
	var query = "queryISBN.php?input=" + 
	          escape(inputISBN);
	//...Versenden der Anfrage...
	//...Behandlung der Serverantwort...
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