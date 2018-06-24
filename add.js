function addInput(){
	var node = document.createElement("div");
	var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
	x.setAttribute("name", "user");
	x.setAttribute("class", "user");
	node.append(x);  
	document.getElementById("inputs").appendChild(node);
}