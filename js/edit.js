	function saveText()
	{
		var textToSave = document.getElementById("inputTextToSave").value;
		var textToSaveAsBlob = new Blob([textToSave], {type:"text/plain"});
		var textToSaveAsURL = window.URL.createObjectURL(textToSaveAsBlob);
		var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;
	 
		var downloadLink = document.createElement("a");
		downloadLink.download = fileNameToSaveAs;
		downloadLink.innerHTML = "Download File";
		downloadLink.href = textToSaveAsURL;
		downloadLink.onclick = destroyClickedElement;
		downloadLink.style.display = "none";
		document.body.appendChild(downloadLink);
	 
		downloadLink.click();
	}
	
	function saveHtml()
	{
		var textToSave = document.getElementById("inputTextToSave").value;
		var textToSaveAsBlob = new Blob([textToSave], {type:"text/html"});
		var textToSaveAsURL = window.URL.createObjectURL(textToSaveAsBlob);
		var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;
	 
		var downloadLink = document.createElement("a");
		downloadLink.download = fileNameToSaveAs;
		downloadLink.innerHTML = "Download File";
		downloadLink.href = textToSaveAsURL;
		downloadLink.onclick = destroyClickedElement;
		downloadLink.style.display = "none";
		document.body.appendChild(downloadLink);
	 
		downloadLink.click();
	}
	 
	function destroyClickedElement(event)
	{
		document.body.removeChild(event.target);
	}
	
	function saveTextAsFile()
	{
		var x = document.getElementById("text").checked;
		if (x) {
			saveText();
		} else { 
			saveHtml();
		}
	}
	
function addInput1(){
	var node = document.createElement("div");
	var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
	x.setAttribute("name", "user1[]");
	x.setAttribute("class", "user");
	node.append(x);  
	document.getElementById("inputs1").appendChild(node);
}

function addInput2(){
	var node = document.createElement("div");
	var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
	x.setAttribute("name", "user2[]");
	x.setAttribute("class", "user");
	node.append(x);  
	document.getElementById("inputs2").appendChild(node);
}

		  function formatText(el,tagstart,tagend) {
			if (el.setSelectionRange) {
				el.value = el.value.substring(0,el.selectionStart) + tagstart + el.value.substring(el.selectionStart,el.selectionEnd) + tagend + el.value.substring(el.selectionEnd,el.value.length)
			}
		  };
		  
		  function showText()
			{
			document.getElementById("text").innerHTML = document.getElementById("inputTextToSave").value;
			return false;
			};