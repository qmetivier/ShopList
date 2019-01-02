function showList(self, elements){
// pour chaque element on génère une div que l'on rajoute sur la page
for (var i = 0; i < elements.length; i++) {
	self.appendChild(new Container(elements[i]).container);
}
}
// forme de la div ajouter a la page
function Container(element){
	var div = document.createElement('div');
	div.className = 'element-div';

	var titre = document.createElement('span');
	titre.className = 'element-titre';
	titre.innerHTML = element.label;

	var clearboth = document.createElement('div');
	clearboth.className = 'clearboth';

	div.appendChild(titre);
	div.appendChild(clearboth);

	this.__defineGetter__('container', () => div);
}

var container = document.getElementById("container-ingredients");
showList(container, ingredients);

//Gestion du menu vertical par le bouton
var btnMenu = document.getElementById("btn-gest-menu");
btnMenu.addEventListener("click", function($self){
	var menu = document.getElementById("container-menu");
	if (menu.getAttribute("active") == "off"){
		menu.setAttribute("active", "on");
		$self.target.innerHTML = "&larr;";
	}
	else{
		menu.setAttribute("active", "off");
		$self.target.innerHTML = "&rarr;";
	}
});