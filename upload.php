<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Proceso del Certificado</title>
        <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/5581/5581976.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="./Css/Style.css">
        <link rel="stylesheet" href="./fonts/Montserrat-Bold.ttf">
        <link rel="stylesheet" href="./fonts/Montserrat-Regular.ttf">
        
      </head>
   <!-- <body onload="imprimir();"> --->
     <body class="body"> 
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                    </div>
                    <div class="col"></div>
                </div>       
    <?php
    $directorio = '/';
    $subir_archivo = $directorio.basename($_FILES['subir_archivo']['name']);
   // echo "$subir_archivo";
    echo "<div>";
    //validar que el usuario seleccione un archivo.-.-
   // $fp1 = fopen(“fichero1, r);
    
    if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo !='application/xml')) {
     // echo"entro"; verifico que se cargo correctamente y voy a acceder a sus datos
        } else {
        echo "La subida ha fallado";
        }
    echo "</div>";
    include('../certificadosCGEMS/phpqrcode/qrlib.php');//libreria QR
    //echo "$subir_archivo";
    //print_r($subir_archivo);
    if(!$Dec = new SimpleXMLElement($subir_archivo, 0, true)){
  //  if(!$Dec =  new SimpleXMLElement($subir_archivo)){
      echo "No se ha podido cargar el archivo";
    }else{
      //ALUMNO datos
      $title = $Dec->Alumno[0]['nombre'];
      $apellidoP = $Dec->Alumno[0]['primerApellido'];
      $apellidoM = $Dec->Alumno[0]['segundoApellido'];
      $curp = $Dec->Alumno[0]['curp'];
      $numeroControl = $Dec->Alumno[0]['numeroControl'];          
      //Periodo
      $periodoIn = $Dec->Acreditacion[0]['periodoInicio'];
      $periodoTe = $Dec->Acreditacion[0]['periodoTermino'];
      //formato del periodo
      $cadena_fecha = $periodoIn;
      $newFecha = date("m-d-Y",strtotime($cadena_fecha));
      $cadena_fechaF = $periodoTe;
      $newFechaF = date("m-d-Y",strtotime($cadena_fechaF));
      //descomponer fecha 
      //mes
      $mesI = explode("-",$newFecha);
      $mesF = explode("-",$newFechaF);
      //dia
      $newDiaI = date("d-m-Y",strtotime($cadena_fecha));
      $newDiaF = date("d-m-Y",strtotime($cadena_fechaF));
      $diaI = explode("-",$newDiaI);
      $diaF = explode("-",$newDiaF);
      //año
      $newAnnioI = date("Y-d-m",strtotime($cadena_fecha));
      $cadena_fechaF = $periodoTe;
      $newAnnioF = date("Y-d-m",strtotime($cadena_fechaF));
      $annioI = explode("-",$newAnnioI);
      $annioF = explode("-",$newAnnioF);
      //fecha del timbrado
      $fechaSep = $Dec->Sep[0]['fechaSep'];
     // echo $fechaSep;
      $newfechaSep = date("d/m/Y",strtotime($fechaSep));//6
      $HoraSep = explode("-",$fechaSep);
      $new = (substr($fechaSep, 11));//hora
      $fecha = explode("/",$newfechaSep);
      $annioexpide = date("Y/m/d",strtotime($newfechaSep));
      $annioOf = explode("/",$annioexpide);
      $finalannio = $annioOf[0];
     /* echo "[0]:".$finalannio[0]."<br>";
      echo "[1]:".$finalannio[1]."<br>";
      echo "[2]:".$finalannio[2]."<br>";
      echo "[3]:".$finalannio[3]."<br>";*/
      //echo "F:".$annioOf."";
      $HoraSep = explode("-",$fechaSep);
      //descompongo la fecha del timbrado
      $dia = $fecha[0];
      $mes = $fecha[1];
      $year = $fecha[2];
      //Funcion para obtener el nombre con letra del año
      //Millar
      $millar=$finalannio[0];
      $centena=$finalannio[1];
      $decena=$finalannio[2];
      $unidad=$finalannio[3];
      if($millar==1){
        $mil="mil";
        $millar=$mil;
      }
      if($millar==2){
        $dmil="dos mil";
        $millar=$dmil;
      }
      if($millar==3){
        $tremil="tres mil";
        $millar=$tremil;
      }
      if($millar==4){
        $catmil="cuatro mil";
        $millar=$catmil;
      }
      if($millar==5){
        $quinmil="cinco mil";
        $millar=$quinmil;
      }
      if($millar==6){
        $seismil="seis mil";
        $millar=$seismil;
      }
      if($millar==7){
        $millar="siete mil";
        $millar=$sietemil;
      }
      if($millar==8){
        $ochomil="ocho mil";
        $millar=$ochomil;
      }
      if($millar==9){
        $nuevemil="nueve mil";
        $millar=$nuevemil;
      }
      //Centena
      if($centena==0){
        $cero=" ";
        $centena=$cero;
      }
      if($centena==1){
        $cien="cien";
        $centena=$cien;
        echo "<br>:".$centena."<br>";
      }
      if($centena==2){
        $dosc="doscientos";
        $centena=$dosc;
        echo "<br>:".$centena."<br>";
      }
      if($centena==3){
        $trec="trecientos";
        $centena=$trec;
        echo "<br>:".$centena."<br>";
      }
      if($centena==4){
        $cc="cuatrocientos";
        $centena=$cc;
      }
      if($centena==5){
        $quin="quinientos";
        $centena=$quin;
      }
      if($centena==6){
        $sec="seiscientos";
        $centena=$sec;
      }
      if($centena==7){
        $setc="setecientos";
        $centena=$setc;
      }
      if($centena==8){
        $ochc="ochocientos";
        $centena=$ochc;
      }
      if($centena==9){
        $novc="novecientos";
        $centena=$novc;
      }
      //Decena
      if($decena==0){
        $isC=" ";
        $decena=$isC;
      }
      //EN CASO DE DIEZ Y VEINTE
      if($decena==1 && $unidad==0){
        $diezz="diez";
        $decena=$diezz;
      }
      if($decena==2 && $unidad==0){
        $veintee="veinte";
        $decena=$veintee;
      }
      //CASO DE NUMEROS CON TILDE
      if($decena==1 && $unidad > 1){
         if($unidad==6){
          $unTilde="séis";
          $unidad=$unTilde;
         }
      }
      if($decena==1 && $unidad > 1){
        if($unidad==6){
         $unTilde="séis";
         $unidad=$unTilde;
        }
     }
     if($decena==2 && $unidad > 1){
      if($unidad==2){
       $dosTilde="dós";
       $unidad=$dosTilde;
      }
      if($unidad==3){
        $treTilde="trés";
        $unidad=$treTilde;
       }
       if($unidad==6){
        $unTilde="séis";
        $unidad=$unTilde;
       }

   }
      //CASO 2 Veinti y Dieci
      if($decena==1){
        $dieci="dieci";
        $decena=$dieci;
      }
      if($decena==2){
        $veinti="veinti";
        $decena=$veinti;
      }
      //CASO 3 DECENAS NORMALES
      if($decena==3 && $unidad==0){
        $treinta="treinta";
        $finalannio[2]=$treinta;
        echo "".$treinta."";
      }if($decena==3){
        $treinta="treinta y";
        $decena=$treinta;
        echo "".$treinta."";
      }
      if($decena==4 && $unidad==0){
        $cuarenta="cuarenta";
        $decena=$cuarenta;
      }if($decena==4){
        $cuarenta="cuarenta y";
        $decena=$cuarenta;
      }
      if($decena==5 && $unidad==0){
        $cincuenta="cincuenta";
        $decena=$cincuenta;
      }if($decena==5){
        $cincuenta="cincuenta y";
        $decena=$cincuenta;
      }
      if($decena==6 && $unidad==0){
        $sesenta="sesenta";
        $decena=$sesenta;
      }if($decena==6){
        $sesenta="sesenta y";
        $decena=$sesenta;
      }
      if($decena==7 && $unidad==0){
        $setenta="setenta";
        $decena=$setenta;
      }if($decena==7){
        $sesenta="setenta y";
        $decena=$setenta;
        echo "".$sesenta."";
      }
      if($decena==8 && $unidad==0){
        $ochenta="ochenta";
        $decena=$ochenta;
      }if($decena==8){
        $ochenta="ochenta y";
        $decena=$ochenta;
      }
      if($decena==9 && $unidad==0){
        $noventa="noventa";
        $decena=$noventa;
      }if($decena==9){
        $noventa="noventa y";
        $decena=$noventa;
      }
      //UNIDAD
      if($unidad==1){
        $uno="uno";
        $unidad=$uno;
      }
      if($unidad==2){
        $uD="dos";
        $unidad=$uD;
      }
      if($unidad==3){
        $uT="tres";
        $unidad=$uT;
      }
      if($unidad==4){
        $uC="cuatro";
        $unidad=$uC;
      }
      if($unidad==5){
        $uCi="cinco";
        $unidad=$uCi;
      }
      if($unidad==6){
        $uS="seis";
        $funidad=$uS;

      }
      if($unidad==7){
        $uSi="siete";
        $unidad=$uSi;
      }
      if($unidad==8){
        $uO="ocho";
        $unidad=$uO;
      }
      if($unidad==9){
        $uN="nueve";
        $unidad=$uN;
      }
      // Ciclo con los meses inicio
      if($mesI[0] == 01 ){
        $enero="enero";
        $mesI[0]=$enero;
      } else if ($mesI[0] == 02){
        $febrero="febrero";
        $mesI[0]=$febrero;
      } else if ($mesI[0] == 03){
        $marzo="marzo";
        $mesI[0]=$marzo;
      }else if ($mesI[0] == 04){
        $abril="abril";
        $mesI[0]=$abril;
      }else if ($mesI[0] == 05){
        $mayo="mayo";
        $mesI[0]=$mayo;
      }else if ($mesI[0] == 06){
        $junio="junio";
        $mesI[0]=$junio;
      }else if ($mesI[0] == 07){
        $julio="julio";
        $mesI[0]=$julio;
      } else if ($mesI[0] == 8){
        $agosto="agosto";
        $mesI[0]=$agosto;          
      }else if ($mesI[0] == 9){
        $septiembre="septiembre";
        $mesI[0]=$septiembre;  
      }else if ($mesI[0] == 10){
        $octubre="octubre";
        $mesI[0]=$octubre;
      }else if ($mesI[0] == 11){
        $noviembre="noviembre";
        $mesI[0]=$noviembre;
      }else if ($mesI[0] == 12){
        $diciembre="diciembre";
        $mesI[0]=$diciembre;
      }
      // Ciclo con los meses fin
      if($mesF[0] == 01 ){
        $enero="enero";
        $mesF[0]=$enero;
      } else if ($mesF[0] == 02){
        $febrero="febrero";
        $mesF[0]=$febrero;
      } else if ($mesF[0] == 03){
        $marzo="marzo";
        $mesF[0]=$marzo;
      } else if ($mesF[0] == 04){
        $abril="abril";
        $mesF[0]=$abril;
      } else if ($mesF[0] == 05){
        $mayo="mayo";
        $mesF[0]=$mayo;
      } else if ($mesF[0] == 06){
        $junio="junio";
        $mesF[0]=$junio;
      } else if ($mesF[0] == 07){
        $julio="julio";
        $mesF[0]=$julio;
      } else if ($mesF[0] == 8){
        $agosto="agosto";
        $mesF[0]=$agosto;
      } else if ($mesF[0] == 9){
        $septiembre="septiembre";
        $mesF[0]=$septiembre;
      } else if ($mesF[0] == 10){
        $octubre="octubre";
        $mesF[0]=$octubre;
      } else if ($mesF[0] == 11){
        $noviembre="noviembre";
        $mesF[0]=$noviembre;
      } else if ($mesF[0] == 12){
        $diciembre="diciembre";
        $mesF[0]=$diciembre;
      }
      //// Ciclo con los nombres de los días
      if($dia == 1 ){
        $Uno="un";
        $dia=$Uno;//va hacer algo especifico
      } else if ($dia == 2){
        $Dos="dos";
        $dia=$Dos;
      }else if ($dia == 3){
        $tres="tres";
        $dia=$tres;
      }else if ($dia == 4){
        $cuatro="cuatro";
        $dia=$cuatro;
      }else if ($dia == 5){
        $cinco="cinco";
        $dia=$cinco;
      }else if ($dia == 6){
        $seis="seis";
        $dia=$seis;
      }else if ($dia == 7){
        $siete="siete";
        $dia=$siete;
      }else if ($dia == 8){
        $ocho="ocho";
        $dia=$ocho;
      }else if ($dia == 9){
        $nueve="nueve";
        $dia=$nueve;
      }else if ($dia == 10){
        $diez="diez";
        $dia=$diez;
      }else if ($dia == 11){
        $Once="once";
        $dia=$Once;
        //echo"<b>".$Once."</b><br>";
      }else if ($dia == 12){
        $Doce="doce";
        $dia=$Doce;
      }else if ($dia == 13){
        $Trece="trece";
        $dia=$Trece;
      }else if ($dia == 14){
        $Catorce="catorce";
        $dia=$Catorce;
      }else if ($dia == 15){
        $Quince="quince";
        $dia=$Quince;
      }else if ($dia == 16){
        $Dieciseis="dieciséis";
        $dia=$Dieciséis;
      }else if ($dia == 17){
        $Diecisiete="diecisiete";
        $dia=$Diecisiete;
      }else if ($dia == 18){
        $Dieciocho="dieciocho";
        $dia=$Dieciocho;
      }else if ($dia == 19){
        $Diecinueve="diecinueve";
        $dia=$Diecinueve;
      }else if ($dia == 20){
        $Veinte="veinte";
        $dia=$Veinte;
      }else if ($dia == 21){
        $Veintiuno="veintiuno";
        $dia=$Veintiuno;
      }else if ($dia == 22){
        $Veintidos="veintidós";
        $dia=$Veintidos;
      }else if ($dia == 23){
        $Veintitres="veintitrés";
        $dia=$Veintitres;
      }else if ($dia == 24){
        $Veinticuatro="veinticuatro";
        $dia=$Veinticuatro;
      }else if ($dia == 25){
        $Veinticinco="veinticinco";
        $dia=$Veinticinco;
      }else if ($dia == 26){
        $Veintiseis="veintiséis";
        $dia=$Veintiseis;
      }else if ($dia == 27){
        $Veintisiete="veintisiete";
        $dia=$Veintisiete;
      }else if ($dia == 28){
        $Veintiocho="veintiocho";
        $dia=$Veintiocho;
      }else if ($dia == 29){
        $Veintinueve="veintinueve";
        $dia=$Veintinueve;
      }else if ($dia == 30){
        $Treinta="treinta";
        $dia=$Treinta;
      }else if ($dia == 31){
        $Treintauno="treinta y uno";
        $dia=$Treintauno;
      }
      //mes de la fecha final
      if($mes == 01 ){
        $enero="enero";
        $mes=$enero;
      } else if ($mes == 02){
        $febrero="febrero";
        $mes=$febrero;
      } else if ($mes == 03){
        $marzo="marzo";
        $mes=$marzo;
      } else if ($mes == 04){
        $abril="abril";
        $mes=$abril;
      } else if ($mes == 05){
        $mayo="mayo";
        $mes=$mayo;
      } else if ($mes == 06){
        $junio="junio";
        $mes=$junio;
      } else if ($mes == 07){
        $julio="julio";
        $mes=$julio;
      } else if ($mes == 8){
        $agosto="agosto";
        $mes=$agosto;
      } else if ($mes == 9){
        $septiembre="septiembre";
        $mes=$septiembre;
      } else if ($mes == 10){
        $octubre="octubre";
        $mes=$octubre;
      } else if ($mes == 11){
        $noviembre="noviembre";
        $mes=$noviembre;
      } else if ($mes == 12){
        $diciembre="diciembre";
        $mes=$diciembre;
      }
      //Obteniendo datos finales
      $creditosObtenidos = $Dec->Acreditacion[0]['creditosObtenidos'];
      $totalCreditos = $Dec->Acreditacion[0]['totalCreditos'];
      $promedioAprovechamientoTexto = $Dec->Acreditacion[0]['promedioAprovechamientoTexto'];
      $promedioAprovechamiento = $Dec->Acreditacion[0]['promedioAprovechamiento'];
      //formato de promedio y creditos
      $folio = $Dec->Sep[0]['folioDigital'];//8
      $selloDec = $Dec->Sep[0]['selloDec'];
      //dividir la oración del sello Dec
      $rest = substr($selloDec, 0,144); //145 //7 
      $rest2 = substr($selloDec, 144,140);//144
      $rest3 = substr($selloDec, 284,300);//113
     /* echo "<b> ".$selloDec."</b><br>";
      echo "<b> "."///////////////////////////"."</b><br>";
      echo "<b> ".$rest."</b><br>";
      echo "<b> ".$rest2."</b><br>";
      echo "<b> ".$rest3."</b><br>";*/
      $selloSep = $Dec->Sep[0]['selloSep'];
 //     echo "<b> selloSep: "."</b><br>";
      //dividir la oración del sello Dec
      $sep = substr($selloSep, 0,145);
      $sep1 = substr($selloSep, 145,150);
      $sep2 = substr($selloSep, 295,300);
     /* echo "<b> ".$selloSep."</b><br>";
      echo "<b> "."///////////////////////////"."</b><br>";
      echo "<b> ".$sep."</b><br>";
      echo "<b> ".$sep1."</b><br>";
      echo "<b> ".$sep2."</b><br>";*/
      //generar QR
      $contenido = "https://www.siged.sep.gob.mx/certificados/iems/".$folio;
      
            //  unlink($subir_archivo);
      QRcode::png($contenido, "folioo.png", QR_ECLEVEL_L,3,3);
              }
              $img='./img/MachotePrueba.png';//selecciono la imagen a modificar
              echo "<div class='contenedor'>
                <img class='imagen' src='./img/machote2.png' />
                <div class='centrado'>".$title." ".$apellidoP." ".$apellidoM."</div>
                <div class='curp'>".$curp."</div>
                <div class='control'>".$numeroControl."</div>
                <div class='periodo'>"."Del ".$diaI[0]." de ".$mesI[0]." de ".$annioI[0]." al ".$diaF[0]." de ".$mesF[0]." de ".$annioF[0].""."</div>
                <div class='creditos'>".$creditosObtenidos."</div>
                <div class='Tcreditos'>".$totalCreditos."</div>
                <div class='promedio'>".$promedioAprovechamiento."</div>
                <div class='promedioT'>".$promedioAprovechamientoTexto."</div>
                <div class='selloDec'>".$rest."</div>
                <div class='selloDec2'>".$rest2."</div>
                <div class='selloDec3'>".$rest3."</div>
                <div class='fecha'>".$newfechaSep."</div>
                <div class='hora'>".$new."</div>
                <div class='dia'>".$dia."</div>
                <div class='mes'>".$mes."</div>
                <div class='folio'>".$folio."</div>
                <div class='QR'><img src='folioo'/></div>
                <div class='selloSep'>".$sep."</div>
                <div class='selloSep1'>".$sep1."</div>
                <div class='selloSep2'>".$sep2."</div>
                <div class='generarFecha'>"."a los ".$dia." días del mes de ".$mes." del ".$millar.$centena.$decena.$unidad."</div>
                <!--CSS--->
                <style>
                @font-face {
                  font-family: 'Montserrat';
                  src: url('./fonts/Montserrat-Regular.ttf') format('truetype');
                  font-weight: normal;
                  font-style: normal;
               }
               .generarFecha{
                position: absolute;
                  top: 98%;
                  left: -1.5%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
               }

                .folio{
                  position: absolute;
                  top: 94.9%;
                  left: -1.5%;
                  transform: translate(65%, 65%);
                  font-size: 8px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .mes{
                  position: absolute;
                  top: 90.2%;
                  left: 69%;
                  transform: translate(65%, 65%);
                  font-size: 6px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .dia{
                  position: absolute;
                  top: 90.2%;
                  left: 56%;
                  transform: translate(65%, 65%);
                  font-size: 6px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                 font-family: 'Montserrat';
                 font-weight: regular;
                }
                .QR{
                  position: absolute;
                  top: 73.5%;
                  left: -5%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .hora{
                  position: absolute;
                  top: 72.7%;
                  left: 25%;
                  transform: translate(65%, 65%);
                  font-size: 6px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .fecha{
                  position: absolute;
                  top: 72.7%;
                  left: 20%;
                  transform: translate(65%, 65%);
                  font-size: 6px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .selloSep2{
                  position: absolute;
                  top: 76.4%;
                  left: -10.9%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-left:-25px;
                }
                .selloSep1{
                  position: absolute;
                  top: 75.5%;
                  left: -46.3%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-left:-25px;
                }
                .selloSep{
                  position: absolute;
                  top: 74.5%;
                  left: -46%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-left:-25px;
                }
                .selloDec3{
                  position: absolute;
                  top: 69.5%;
                  left: -20.5%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-right: 10px;
                  margin-left:28px;
                }
                .selloDec2{
                  position: absolute;
                  top: 68.7%;
                  left: -44.7%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-left:-22px;
                }
                .selloDec{
                  position: absolute;
                  top: 67.8%;
                  left: -43.9%;
                  transform: translate(65%, 65%);
                  font-size: 9px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                  margin-left:-25px;
                }
                .promedioT{
                  position: absolute;
                  top: 42.5%;
                  left: 68%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .promedio{
                  position: absolute;
                  top: 42.5%;
                  left: 70%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .Tcreditos{
                  position: absolute;
                  top: 42.5%;
                  left: 46%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .creditos{
                  position: absolute;
                  top: 42.5%;
                  left: 15%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .control{
                  position: absolute;
                  top: 23.5%;
                  left: 64%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .periodo{
                  position: absolute;
                  top: 39.5%;
                  left: 35%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
                }
                .contenedor{
                  position: relative;
                  display: inline-block;
                  text-align: center;
                  float: left;
              }
              .curp{
                position: absolute;
                  top: 23.5%;
                  left: 10%;
                  transform: translate(65%, 65%);
                  font-size: 11px;
                  text-align: left;
                  display:left;
                  justify-content:left;
                  font-family: 'Montserrat';
                  font-weight: regular;
              }
              .centrado{
                  position: absolute;
                  top: 19%;
                  left: 20%;
                  transform: translate(65%, 65%);
                  font-size: 9x;
                  display:flex;
                  justify-content: center;
                  font-weight: bold;
                  font-family: 'Montserrat';
              }
              
                </style>
              </div>";
              
              ?>
              <script>
                  function imprimir(){
                    window.print();
                  }
              </script>
        </div>
        
</html>