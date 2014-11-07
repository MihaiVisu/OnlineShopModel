
/*--------------------VARIABILE GLOBALE-----------------------*/

var onlyUserNames = /[a-zA-Z._0-9]/g; //Doar litere, cifre, '_' si '.' pot fi folosite;
var onlyNumbers = /[0-9./]/g;           //Doar cifre pot fi folosite;
var onlyEmails = /[a-zA-Z._@0-9]/g;   // Doar onlyUserNames + '@';
var onlyAddresses = /[a-zA-Z._0-9,/ ]/g; //Doar adrese;
var onlyNames= /[a-zA-Z]/g; // Doar litere mici si mari

/*--------------------FUNCTII-----------------------*/


/* Functia de filtrare directa */

function validate(restriction_type)
{
	var e;
	if (event.keyCode)
	{
		e = event.keyCode;
	}
	else if (event.which)
	{ 
		e = event.which;
	}
	var character = String.fromCharCode(e);
	if (e==27) 
	{
		alert("Ai tastat un caracter invalid!");
		return false; 
	}
	if ( e == 13 )
	{
		return true;
	}
	if (character.match(restriction_type)) 
	{
		return true;
	} 
	else 
	{
		alert("Ai tastat un caracter invalid!");
		return false;
	}	
}

/* Functia prin care apare popBox-ul cu Login-ul */

function ShowLogin()
{
	ClosePops();
	$("#popBox").css("display","inline");
	$("#loginBox").fadeIn("fast");
	$("#loginBox").corner();
	$("#Pw").corner();
	$("#User").corner();
}

/* Functia prin care apare popBox-ul de Inregistrare */

function ShowRegister()
{
	ClosePops();
	$("#popBox").css("display","inline");
	$("#registerBox").fadeIn("fast");
	$("#registerBox").corner();
	$("#USERNAME").corner();
	$("#PAROLA").corner();
	$("#VERIF_PAROLA").corner();
	$("#EMAIL").corner();
	$("#COD_POSTAL").corner();
	$("#NUMAR_TELEFON").corner();
	$("#ADRESA").corner();
	$("#NUME").corner();
	$("#PRENUME").corner();
}

/* Functii in Jquery pentru inchidere popBox-uri (click in afara lor) */

function ClosePops()
{
	$("#popBox").hide();
	$("#loginBox").hide();
	$("#registerBox").hide();
	$("#errors").empty();
	$("#errorsUSERNAME").empty();
	$("#errorsPAROLA").empty();
	$("#errorsVERIF_PAROLA").empty();
	$("#errorsADRESA").empty();
	$("#errorsEMAIL").empty();
	$("#errorsCOD_POSTAL").empty();
	$("#errorsNUMAR_TELEFON").empty();
	$("#errorsNUME").empty();
	$("#errorsPRENUME").empty();
	ClearInputs();
}

function ClearInputs() // Resetez input-urile
{
	$("input").val('');
}

/* Functia de conectare */

function Login(address)
{
	var user = $('input[name="username"]').val();
	var password = $('input[name="pw"]').val();
	if ( window.XMLHttpRequest )
	{
		xmlhttp = new XMLHttpRequest(); // IE 7+, Chrome, Mozilla...
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("errors").innerHTML=xmlhttp.responseText;
			if(document.getElementById("errors").innerHTML.length==943 || document.getElementById("errors").innerHTML.length==907)
			{
				alert("Te-ai autentificat cu succes!");
				ClosePops();
				location.reload();
			}
		}
	}
	xmlhttp.open("POST","login.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send('user='+user+'&password='+password+'&pagina='+address);
}

/* Functia de verificare a inputurilor la inregistrare */

function Register( identifier )
{
	var data=$('input[name='+identifier+']').val();
	if ( window.XMLHttpRequest )
	{
		xmlhttp = new XMLHttpRequest(); // IE 7+, Chrome, Mozilla...
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // IE5,6,...
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("errors"+identifier).innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","verif_register.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send('verification='+data+'&cell='+identifier);
}

/* Functia de inregistrare propriu-zisa */

function EndRegister()
{
	if ( $("#errorsNUME").html().length==943 &&
		$("#errorsPRENUME").html().length==943 &&
		$("#errorsUSERNAME").html().length==943 &&
		$("#errorsEMAIL").html().length==943 &&
		$("#errorsPAROLA").html().length==943 &&
		$("#errorsVERIF_PAROLA").html().length==943 &&
		$("#errorsADRESA").html().length==943 &&
		$("#errorsCOD_POSTAL").html().length==943 &&
		$("#errorsNUMAR_TELEFON").html().length==943 )
		{
			var nume=$('input[name="NUME"]').val();
			var prenume=$('input[name="PRENUME"]').val();
			var username=$('input[name="USERNAME"]').val();
			var email=$('input[name="EMAIL"]').val();
			var parola=$('input[name="PAROLA"]').val();
			var adresa=$('input[name="ADRESA"]').val();
			var cod_postal=$('input[name="COD_POSTAL"]').val();
			var numar_telefon=$('input[name="NUMAR_TELEFON"]').val();
			if ( window.XMLHttpRequest )
			{
				xmlhttp = new XMLHttpRequest(); // IE 7+, Chrome, Mozilla...
			}
			else
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // IE5,6,...
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("success").innerHTML=xmlhttp.responseText;
					if($("#success").html().length==943)
					{
						alert("Contul a fost creat cu succes!");
						ClosePops();
						location.reload();
					}
				}
			}
			xmlhttp.open("POST","end_register.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send('nume='+nume+'&prenume='+prenume+'&username='+username+'&email='+email
						 +'&parola='+parola+'&adresa='+adresa+'&cod_postal='+cod_postal+'&numar_telefon='+numar_telefon);
		}
		else
		{
			alert("Datele introduse sunt incorecte!");
		}
}
