// Handle multiple window onloads

window.addOnload = function (fn) {
    if (!window.OnloadCache) window.OnloadCache = [];
    var ol = window.OnloadCache;
    ol.push(fn);
}

window.onload = function () {
    var ol = window.OnloadCache;
    if (ol)
        for (var x = 0; x < ol.length; x++)
            ol[x]();
}

// <Element> draw settings

// Declare global variable settings for <h1>

var path = "/home/root/site";			// Absolute path to siir generator folder
var elements = new Array("h1","h2","h3","h4");		// Elements within this array will run SIIR
var settings = new Array();

settings["h1"] = new Array();				// Element setting array
settings["h1"]["padding"] = 1;				
settings["h1"]["bgcolor"] = "FFFFFF";
settings["h1"]["transparentbg"] = 0;			// Transparent background? (1=Yes, 0=No)
settings["h1"]["font_color"] = "2F3C42";
settings["h1"]["shadow_color"] = "E2E2E2";
settings["h1"]["font_file"] = "font.ttf";
settings["h1"]["font_size"] = 44;
settings["h1"]["antialias"] = 1;				// Turn on text antialiasing? (1=Yes, 0=No)
settings["h1"]["resizevalue"] = 2;				// Number of points to resize text by
settings["h1"]["h"] = (parseInt(settings["h1"]["font_size"])+parseInt(settings["h1"]["padding"]));

settings["h2"] = new Array();	
settings["h2"]["padding"] = 0;
settings["h2"]["bgcolor"] = "FFFFFF";
settings["h2"]["transparentbg"] = 0;
settings["h2"]["font_color"] = "5F7A87";
settings["h2"]["shadow_color"] = "EEEEEE";
settings["h2"]["font_file"] = "font2.ttf";
settings["h2"]["font_size"] = 22;
settings["h2"]["antialias"] = 1;
settings["h2"]["resizevalue"] = 2;
settings["h2"]["h"] = (parseInt(settings["h2"]["font_size"])+parseInt(settings["h2"]["padding"])+10);

settings["h3"] = new Array();
settings["h3"]["padding"] = 1;
settings["h3"]["bgcolor"] = "FFFFFF";
settings["h3"]["transparentbg"] = 1;
settings["h3"]["font_color"] = "A8A556";
settings["h3"]["shadow_color"] = "F0F0F0";
settings["h3"]["font_file"] = "font2.ttf";
settings["h3"]["font_size"] = 14;
settings["h3"]["antialias"] = 1;
settings["h3"]["resizevalue"] = 2;
settings["h3"]["h"] = (parseInt(settings["h3"]["font_size"])+parseInt(settings["h3"]["padding"])+10);

settings["h4"] = new Array();
settings["h4"]["padding"] = 3;
settings["h4"]["bgcolor"] = "F0F0F0";
settings["h4"]["transparentbg"] = 1;
settings["h4"]["font_color"] = "697A9A";
settings["h4"]["shadow_color"] = "FFFFFF";
settings["h4"]["font_file"] = "font.ttf";
settings["h4"]["font_size"] = 12;
settings["h4"]["antialias"] = 1;
settings["h4"]["resizevalue"] = 2;
settings["h4"]["h"] = (parseInt(settings["h4"]["font_size"])+parseInt(settings["h4"]["padding"])+10);

// SIIR - Element innerhtml

function SIIR_normalizeWhiteSpace(txt) {
	var rE = /\s+/gi;
	return txt.replace(rE,' ');
}

function SIIR_get_href(txt) {
	var text = txt;
	var thishref = text.replace(/<a(.*)href=\"/gi,'');
	thishref = thishref.replace(/\">(.*)/gi,'');
	return thishref;
}

function SIIR_get_id(txt) {
	var text=txt;
	var thisid = text.replace(/<a(.*)id=\"/gi,'');
	thisid = thisid.replace(/\">(.*)/gi,'');
	return thisid;
}

function SIIR_get_text(txt) {
	var text = txt;
	var txt = text.replace(/<\/a>/gi,'');
	txt = txt.replace(/<a(.*)>/gi,'');
	return txt;
}

// SIIR - Replace the element with an iframe

function SIIR_replace() {
	var d = document;

	for (var a = (elements.length-1); a >= 0; a--) {

		var current_element = elements[a];
		var element = d.getElementsByTagName(current_element);

		// Loop through each <element>
		for (var i = (element.length-1); i >= 0; i--) {
			contain = element[i];

			// Container to work with
			var c = d.createElement('div');
			c.className = current_element;
			// Swap <element> tag with the container
			contain.parentNode.replaceChild(c,contain);
			// Set the "current_element.Text" variable
			settings[current_element]["text"] = SIIR_normalizeWhiteSpace(contain.innerHTML);

			var thisid = '';
			reg = /id/i;
			if (reg.test(settings[current_element]["text"])){
				var thisid = SIIR_get_id(settings[current_element]["text"]);
			}

			var href = '';
			reg = /href/i;
			if (reg.test(settings[current_element]["text"])) {
				var href = SIIR_get_href(settings[current_element]["text"]);
			}

			settings[current_element]["text"] = SIIR_get_text(settings[current_element]["text"]);
			settings[current_element]["text"] = escape(settings[current_element]["text"]);

			// The img html
			pasteHTML = '';

			if (href != '' || thisid != '') {
				pasteHTML += '<a';
			}
			
			if (href != '') {
				pasteHTML += ' href="'+href+'"';
			}

			if (thisid != '') {
				pasteHTML += ' id="'+thisid+'"';
			}

			if (href != '' || thisid != '') {
				pasteHTML += '>';
			}

			pasteHTML += '<img class="'+current_element+'" id="'+current_element+'_'+i+'" name="'+current_element+'_'+i+'" src="'+path+'generate.php?action=display&w='+settings[current_element]["w"]+'&h='+settings[current_element]["h"]+'&padding='+settings[current_element]["padding"]+'&transparentbg='+settings[current_element]["transparentbg"]+'&bgcolor='+settings[current_element]["bgcolor"]+'&font_color='+settings[current_element]["font_color"]+'&shadow_color='+settings[current_element]["shadow_color"]+'&font_file='+settings[current_element]["font_file"]+'&font_size='+settings[current_element]["font_size"]+'&antialias='+settings[current_element]["antialias"]+'&text='+settings[current_element]["text"]+'" title="'+unescape(settings[current_element]["text"])+'" alt="'+unescape(settings[current_element]["text"])+'"  />';

			if (href != '' || thisid != '') {
				pasteHTML += '</a>';
			}

			c.innerHTML = pasteHTML;

		}
	}
}

// Make changes to the <element> tags

function SIIR_add() {
	for (var i = (elements.length-1); i >= 0; i--) {
		var current_element = elements[i];
		settings[current_element]["font_size"]=parseInt(settings[current_element]["font_size"])+settings[current_element]["resizevalue"];

		if (settings["h1"]["font_size"] > 32)
			settings["h1"]["font_size"] = 32;
		if (settings["h2"]["font_size"] > 16)
			settings["h2"]["font_size"] = 16;
		if (settings["h4"]["font_size"] > 16)
		 	settings["h4"]["font_size"] = 16;

		settings[current_element]["h"] = (parseInt(settings[current_element]["font_size"])+parseInt(settings[current_element]["padding"]));
	}

	SIIR_refresh();
}

function SIIR_subtract() {
	for (var i = (elements.length-1); i >= 0; i--) {
	var current_element = elements[i];
	settings[current_element]["font_size"] = parseInt(settings[current_element]["font_size"])-settings[current_element]["resizevalue"];

	if (settings["h1"]["font_size"] < 28)
		settings["h1"]["font_size"] = 28;
	if (settings["h2"]["font_size"] < 14)
		settings["h2"]["font_size"] = 14;
	if (settings["h4"]["font_size"] < 14)
		settings["h4"]["font_size"] = 14;

	settings[current_element]["h"] = (parseInt(settings[current_element]["font_size"])+parseInt(settings[current_element]["padding"]));
	}

	SIIR_refresh();
}

// Refresh the respective img

function SIIR_refresh () {
	var d = document;
	var element = d.getElementsByTagName('img');
	for (var i = (elements.length-1); i >= 0; i--) {
		var current_element = elements[i];
	
		for (var a = (element.length-1); a >= 0; a--) {
			elementid = current_element+"_"+a;
			if (document[elementid]) {
				text = document[elementid].alt;
				document[elementid].src = path+'generate.php?action=display&w='+settings[current_element]["w"]+'&h='+settings[current_element]["h"]+'&padding='+settings[current_element]["padding"]+'&transparentbg='+settings[current_element]["transparentbg"]+'&bgcolor='+settings[current_element]["bgcolor"]+'&font_color='+settings[current_element]["font_color"]+'&shadow_color='+settings[current_element]["shadow_color"]+'&font_file='+settings[current_element]["font_file"]+'&font_size='+settings[current_element]["font_size"]+'&antialias='+settings[current_element]["antialias"]+'&text='+text;
			}
		}
	}
}

// SIIR - Onload call

function SIIR_init() {
	SIIR_replace();
}