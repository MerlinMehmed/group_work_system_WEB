function validate() {
	var form = document.getElementById("register");
    var x = document.getElementById("username").value;
	var y = document.getElementById("email").value;
	var p1 = document.getElementById("password").value;
	var p2 = document.getElementById("repeatedpass").value;
	
	var isUsernameValid = false;
	var isEmailValid = false;
	var isPasswordValid = false;
	var isSecondPasswordValid = false;

         
		if( x.length < 2 || x.length > 10 || !x.match(/^[a-zA-Z0-9\_]+$/) ){
			document.getElementById("user").innerHTML = "Потребителското име не е валидно. Трябва да е между 2 и 10 символа, като разрешените символи са A-Z, a-z, 0-9 и '_'";
        } else {
			isUsernameValid = true; 
		}
		
	var atposition=y.indexOf("@");  
	var dotposition=y.lastIndexOf(".");  
	
		if (atposition<1 || dotposition<atposition+2 || dotposition+2>=y.length){  
			document.getElementById("mail").innerHTML = "Въведеният e-mail не е валиден.";
		}  else {
			isEmailValid = true;
		}
		 
		if( p1.length < 6){
            document.getElementById("pass").innerHTML = "Паролата не е валидна. Дължината ѝ трябва да е поне 6 символа.";
        } else {
			isPasswordValid = true; 
		}
		 
		if( p1 !== p2 ) {
            document.getElementById("second").innerHTML = "Двете пароли не съвпадат.";
        } else {
			isSecondPasswordValid = true; 
		}
		 
		if (isUsernameValid && isPasswordValid && isSecondPasswordValid && isEmailValid) {
			form.submit(); return true;
		}
		else {
			document.getElementById("username").value = "";
			document.getElementById("email").value = "";
			document.getElementById("password").value = "";
			document.getElementById("repeatedpass").value = "";
			return false; 
		}
}