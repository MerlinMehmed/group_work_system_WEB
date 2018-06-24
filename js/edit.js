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
	