var request = false;
try {
	request = new XMLHttpRequest();
}
catch (trymicrosoft) {
	try {
		request = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (othermicrosoft) {
		try {
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (failed) {
			request = false;
		}
	}
}
if (!request)
  alert("Error initializing XMLHttpRequest!");
function setupPreview () {
	document.getElementById("isbnnum").innerHTML = '<img src=\"gen.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	document.getElementById("autor").innerHTML = '<img src=\"gen.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	document.getElementById("buchtitel").innerHTML = '<img src=\"gen.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	document.getElementById("preis").innerHTML = '<img src=\"gen.gif\" width=\"16\" height=\"16\" alt=\"Preloading\" title=\"Preloading \" />';
	document.getElementById("info").className = 'visible';
}
function getFetchedInput () {
	var inputISBN = document.getElementById("ISBN").value;
	var query = "checkISBN.php?input=" + 
	escape(inputISBN);
	// request.open ("GET", url, true);
	// request.onreadystatechange = updateISBNField;
	// request.send (null);
	if (inputISBN == '1234') {
		document.getElementById("ISBN").className = 'mistake';
	} else {
		document.getElementById("ISBN").className = 'verified';
	}
}
function getCompleteInput () {
	setupPreview( );
	var inputISBN = document.getElementById("ISBN").value;
	var query = "queryISBN.php?input=" + 
	escape(inputISBN);
	request.open ("GET", query, true);
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
				document.getElementById("ISBN").className = 'mistake';
			}
		}
	}
}
function updatePreview () {
	setupPreview ();
	if (request.readyState == 4) {
		if (request.status == 200) {
			alert(request.responseText);
			var response = request.responseText.split("|");
			document.getElementById("isbnnum").innerHTML = response[0];
			document.getElementById("autor").innerHTML = response[1];
			document.getElementById("buchtitel").innerHTML = response[2];
			document.getElementById("preis").innerHTML = response[3];
			document.getElementById("info").className = 'visible';
		}
	}
}
