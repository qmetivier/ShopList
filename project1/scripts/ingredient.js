function showList(self, elements){
// pour chaque element on génère une div que l'on rajoute sur la page
for (var i = 0; i < elements.length; i++) {
	self.appendChild(new Container(elements[i]).container);
}
}
// forme de la div ajouter a la page
function Container(element){
	var div = document.createElement('form');
	div.className = 'element-div';
	div.setAttribute("method", "post");
	div.setAttribute("action", "ingredient.php");

	var titre = document.createElement('span');
	titre.className = 'element-titre';
	titre.innerHTML = element.label;

	var hidden = document.createElement("input");
	hidden.setAttribute("type", "hidden");
	hidden.setAttribute("name", "id");
	hidden.setAttribute("value", element.identifiant);

	var btnDelete = document.createElement("input");
	btnDelete.setAttribute("type", "submit");
	btnDelete.setAttribute("value", "X");
	btnDelete.className = "element-delete";

	var clearboth = document.createElement('div');
	clearboth.className = 'clearboth';

	div.appendChild(titre);
	div.appendChild(hidden);
	div.appendChild(btnDelete);
	div.appendChild(clearboth);

	this.__defineGetter__('container', () => div);
}

var container = document.getElementById("container-ingredients");
showList(container, ingredients);

var select = document.getElementById("select-cat-ing");

for (var i = 0; i < cat_ingredient.length; i++) {
	var option = document.createElement("option");
	option.setAttribute("value", cat_ingredient[i].label);
	option.innerHTML += cat_ingredient[i].label;
	select.appendChild(option);
}

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