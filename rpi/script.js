function GereChkbox(conteneur,a_faire) {
var blnEtat=null;
var Chckbox = document.getElementById(conteneur).firstChild;
	while (Chckbox!=null) {
		if (Chckbox.nodeName=="INPUT")
			if (Chckbox.getAttribute("type")=="checkbox") {
				blnEtat = (a_faire=='0') ? false : (a_faire=='1') ? true : (document.getElementById(Chckbox.getAttribute("id")).checked) ? false : true;
				document.getElementById(Chckbox.getAttribute("id")).checked=blnEtat;
			}
		Chckbox = Chckbox.nextSibling;
	}
}
