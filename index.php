<?php
    require_once("bibliotecas/xajax/xajax_core/xajax.inc.php");
    $xajax=new xajax();
    $xajax->configure('responseType','XML');
    $xajax->register(XAJAX_FUNCTION,'abrirModalNav','modalNav.php');
  	$xajax->register(XAJAX_FUNCTION,'crearCookie','modalNav.php');
  	$xajax->register(XAJAX_FUNCTION,'valNav');
  	$xajax->configure('javascript URI','bibliotecas/xajax/');
  	$xajax->processRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sistema de Gesti&oacute;n de Postgrados UDENAR</title>
    <?php $xajax->printJavascript('bibliotecas/xajax/'); ?>
    <script>
function acomodar(){
	document.getElementById('td_menu').height=getViewportHeight()-138;
	//document.getElementById('td_menu').width=190;
	document.getElementById('central').height=getViewportHeight()-130;
	document.getElementById('central').width=550;
}
window.onload=function()
{
	acomodar();
	xajax_valNav();

}
function valNav()
{
	var nav = navigator.appName; 
	var navComp=navigator.appName+" / "+navigator.appVersion;
	var version=navigator.appVersion;
	if(nav=="Netscape")
	{
		if(/Chrome/.test(navComp) || /Safari/.test(navComp))
		{
			//alert(navComp);
			xajax_abrirModalNav(navComp);
		}
	}
	else
	{
		if(nav=="Microsoft Internet Explorer")
		{
			
			if(/MSIE 9.0/.test(version)==false)
			{
				//alert(version);
				xajax_abrirModalNav(navComp);
			}
		}
		else
		{
			//alert(navComp);
			xajax_abrirModalNav(navComp);
		}
	}
}
</script>
</head>
<body onresize="acomodar();" oncontextmenu="return false" style="cursor: auto;margin-block: auto;">
<div class="container">
  <div class="row">
    <div class="col-sm" align="center">
        <div class="col-ins">
            <table>
                <tr><td align="center"><h1 class="txt-wel">BIENVENIDO</h1></td></tr>
                <tr><td align="center"><strong>Sistema de Gesti&oacute;n de Postgrados</strong></td></tr>
            </table>
        </div> 
    </div>
    <div class="col-sm">
        <div class="container-page1" id="Container"> 
            <div class="login-container" id="LoginContainer">
                <h2 class="txt-ins" align="center">INGRESO DE USUARIOS</h2>
                <form action="index3.php" method="post" name="form1" onSubmit="if(nom_usu.value==''){return false;alert('Debe ingresar obligatoriamente el: \nNombre de Usuario');nom_usu.focus();} else{if(pas_usu.value=='') {return false;alert('Debe ingresar obligatoriamente la: \nContraseña de Usuario');pas_usu.focus();} else {submit();}}" target="_parent">
                    <div class="input-line-container">
                        <span class="name-input"><STRONG>Usuario</STRONG></span>
                        <input type="text" name="nom_usu" class="input-line" id="nom_usu" size="25" maxlength="30" autocomplete="off">
                    </div>
                    <div class="input-line-container">
                        <span class="name-input"><STRONG>Contraseña</STRONG></span>
                        <input type="password" name="pas_usu" class="input-line" id="pas_usu" size="25" maxlength="30" onKeyPress="if(!isNS4) { if(event.keyCode==13) env.focus(); } else { if(event.which==13) env.focus(); }">
                    </div>
                    <input type="submit" id="env" value="Iniciar Sesión" class="button-login">
                    <div align="center">
                        <a href="https://www.facebook.com/" target="_blanck"><img width="40" height="40" src="F.png" alt=""></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="https://www.udenar.edu.co/" target="_blanck"><img width="40" height="40" src="L.png" alt=""></a>
                    </div>
                    <div class="txterror" align="center">
                        <?php
                            include ("aut_mensaje_error.inc.php");
                            if (isset($_GET['error_login'])){
                            $error=$_GET['error_login'];?>
                            <?php 
                            echo "¡¡¡Error: $error_login_ms[$error] !!!";
                            }
                        ?>
					</div>
                </form>
            </div>
        </div>
  </div>
</div> 
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="code.js"></script>
</body>
</html>
