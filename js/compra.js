function typeMoney(o,e,n){continuacion=""===e?"":"&data="+e,0===o&&(window.location.href="compras.php?seccion=metodosPago&http="+generarToken(64)+"&pagoPor=efectivo&estado="+n+continuacion),1===o&&(window.location.href="compras.php?seccion=metodosPago&http="+generarToken(64)+"&pagoPor=credito&estado="+n+continuacion),2===o&&(window.location.href="compras.php?seccion=metodosPago&http="+generarToken(64)+"&pagoPor=debito&estado="+n+continuacion)}function targeta(o,e){var n=o.target,t=n.value;t.length>7?(n.value=t.substring(0,8),document.getElementById(e).style.display="block"):document.getElementById(e).style.display="none"}