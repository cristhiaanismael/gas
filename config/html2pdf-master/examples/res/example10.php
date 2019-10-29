<style type="text/css">
<!--
div.minifiche
{
    position:    relative;
    overflow:    hidden;
    width:       454px;
    height:      138px;
    padding:     0;
    font-size:   11px;
    text-align:  left;
    font-weight: normal;
}
div.minifiche img.icone    { position: absolute; border: none; left: 5px;   top: 5px;  width: 240px; height: 128px;overflow: hidden; }
div.minifiche div.zone1    { position: absolute; border: none; left: 257px; top: 8px;  width: 188px; height: 14px; padding-top: 1px; overflow: hidden; text-align: center; font-weight: bold; }
div.minifiche div.zone2    { position: absolute; border: none; left: 315px; top: 28px; width: 131px; height: 14px; padding-top: 1px; overflow: hidden; text-align: left; font-weight: normal; }
div.minifiche div.zone3    { position: absolute; border: none; left: 315px; top: 48px; width: 131px; height: 14px; padding-top: 1px; overflow: hidden; text-align: left; font-weight: normal; }
div.minifiche div.zone4    { position: absolute; border: none; left: 315px; top: 68px; width: 131px; height: 14px; padding-top: 1px; overflow: hidden; text-align: left; font-weight: normal; }
div.minifiche div.zone5    { position: absolute; border: none; left: 315px; top: 88px; width: 131px; height: 14px; padding-top: 1px; overflow: hidden; text-align: left; font-weight: normal; }
div.minifiche div.download { position: absolute; border: none; left: 257px; top: 108px;width: 188px; height: 22px; overflow: hidden; text-align: center; font-weight: normal; }
-->
</style>

<page>


       <table style="width: 100%" border="0 ">
        <tr>
            <td style="border: solid 0px #007700; width: 20%;  ">
            <img src="<?=img.'logo.jpg' ?>" height="90" width="170" >
            </td>
            <td style="  width: 50%; ">
                <p style="margin-top: -31">Calle: <?=$fila_empresa['calle']?> , Colonia:<?=$fila_empresa['colonia']?>, Codigo Postal: <?=$fila_empresa['codigo_postal']?>, Delegacion: <?=$fila_empresa['delegacion']?>
                </p>  
                <div style="width: 78%">
                        <hr>
                </div>
                <?=$fila_empresa['giro']?>                    
            </td>
            <td style=" width: 30%">
                <p style="margin-top: ">
                    Tel:<?=$fila_empresa['telefono']?>
                </p>
                <p style="margin-top: -8">                  
                    Email: <?=$fila_empresa['email']?>
                </p>
                <p style="margin-top: -8">
                    Web: <?=$fila_empresa['web']?>
                </p>
                <h3>
                    Folio:                         <?=$data['folio']?>

                </h3>

            </td>
        </tr>
    </table>


    <table style="width: 100%" border="0">
        <tr>
            <td style=" width: 60%" bgcolor="#D5D9FA">
                <p>
                    <strong>Cliente:</strong><?=$data['cliente']['nombre'].' '. $data['cliente']['ape_pat'].' '. $data['cliente']['ape_mat'] ?>
                </p>
                <p  style="margin-top: -8">
                    <strong>Domicilio:</strong> <?=$data['cliente']['calle']?> 
                </p>
                <p  style="margin-top: -8">
                 Colonia: <?=$data['cliente']['colonia']?> Edif: <?=$data['cliente']['num_edificio']?> Depto:<?=$data['cliente']['num_departamento']?>
                    </p>
                <p style="margin-top: -8;">
                    <strong>Convenio:</strong><?=$data['cliente']['convenio']?> &nbsp; &nbsp;&nbsp;
                    <strong>Referencia:</strong><?=$data['cliente']['referencia']?> <br><br>
                </p>
            </td>
            <td colspan="2" style=" width: 40%"  bgcolor="#7464FA">
                <strong >Total a pagar:</strong>  &nbsp; &nbsp;&nbsp;    <?=round($data['lectura']['total_a_pagar'],2)?><br>
                <strong >Periodo :</strong> &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;    
                <?php
                        $mes1=substr($data['lectura']['periodo'], 3, 2);
                        $mes2=substr($data['lectura']['periodo'], -7, 2);
                        $mes_l1=letra_mes2($mes1);  
                        $mes_l2=letra_mes2($mes2);    
                        echo substr ($data['lectura']['periodo'], 0, 3) . substr($mes_l1, 0,3) . substr($data['lectura']['periodo'], 5, 9). substr( $mes_l2, 0,3) .substr( $data['lectura']['periodo'], 16, 13);
                ?><br>
                <strong >Pagar antes del: </strong> &nbsp;  <?=$data['lectura']['fecha_limite']?>

            </td>
           
        </tr>
    </table>




     <table style="width: 100%; " border="0">
        <tr bgcolor="#5D41BD">
            <td>
                <strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;Comprobante de consumo</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                </td>
            <td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <strong>Detalles de consumo</strong></td>

        </tr>
        <tr>
            <td style=" width: 60%;"  >
                <!--inicio-->
                    <table border="0" width="110%"  >
                        <tr>
                            <td style="width: 100%; " >
                                   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <img src="<?=user_foto.''.$data['ruta_img']?>" height="150" width="250" >
                            </td>
                           <!-- <td style="text-indent: 30mm;  width: 100%; align-items: center; text-align: center;">
                                <?php
                                  //
                                    while ($fila=mysqli_fetch_array($historial)) {
                                ?>
                                <h5 style="margin-top: -70; font-size:12.5;  "><?=$fila['periodo']?> $<?=$fila['total_a_pagar'] ?></h5>
                                <?php
                                 }
                                ?>
                            </td>-->
                        </tr>
                    </table>
                <!--fin-->
            </td>
            <td  style=" align-items: left; text-align: left;   width: 20%; text-indent: 15mm; ">
                 Lectura inicial:<br >
                
                Lectura final:<br >
                
                Consumo m3: <br >
                
                Consumos litros: <br >                
                
                 Saldo favor: <br >
                
                 Adeudos:<br >
                
                 Cargos adicionales :<br >
                
                Cuota admon: <br >
                
                Precio del gas: <br >
            </td>
            <td style="text-indent: 15mm; width: 20%">
                    
                        <?=round($data['lectura']['lectura_ini'], 2)?>
                        
                    <br >
                    
                        <?=round($data['lectura']['lectura_fin'], 2)?>
                        
                    <br >
                    
                        <?=round($data['lectura']['consumo_m3'],2)?>
                        
                    <br >
                    
                        <?=round($data['lectura']['consumos_litros'], 2)?>
                        
                    <br >
                    
                        
                    
                        <?=round($data['lectura']['saldo_favor'], 2)?>
                        
                    <br >
                    
                        <?=round($data['lectura']['adeudos'], 2)?>
                        
                    <br >

                    
                        <?=round($data['lectura']['cargos_add'], 2)?>
                        
                    <br >
                    
                        <?=round($data['lectura']['cuota_admin'], 2)?>
                        
                    <br >
                    
                        <?=round($data['precio_gas'], 2)?>
                        
                    <br >



            </td>
        </tr>
    </table>


    <table style="width: 100%" border="0">
        <tr bgcolor="#7464FA">
            <td  style="width: 25%">
                HISTORIAL
            </td>
            <td  style="width: 25%">CONSUMOS</td>
            <td style="width: 40%">
                TOTAL
            </td>

        </tr>
        <tr>
            <td style="text-indent: 10mm;  width: 25%">
            <strong style="margin-top: -1; background-color:#ACF5E8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Grafica &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  </strong><br>

            <br><br><br>
                        <p style="margin-top: -40; margin-left: -40"><img src="<?=img.$id.'.png' ?>" height="180" width="265" >  </p>   
            </td>
            <td style="  width: 25%; ">
            <strong style="margin-top: -105px; background-color:#ACF5E8">Mes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Litros &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong><br>
                <br><?=$data['historial']?>   
            </td>

            <td style=" width: 40%">
                 
                <h1>$<?=round($data['lectura']['total_a_pagar'], 2)?></h1>
                <hr>
                <h5><?=convertir($data['lectura']['total_a_pagar'])?></h5>
            </td>
        </tr>
    </table>

                   <br><br><br>


    <table style="width: 100%" border="0">
        <tr bgcolor="#7464FA">
            <td colspan="2" style="width: 100%">
                OPCIONES DE PAGO
            </td>

        </tr>
        <tr>
            <td style="text-indent: 10mm;  width: 50%">
                <?php
                    if($data['cliente']['id_cuenta']==2){
                ?>
                    <p style="margin-top: ; margin-left: -10">
                    <img src="<?=img.'cuenta3.gif' ?>" height="40" width="170" > 
                     </p> 
                    <p style="margin-top: ; margin-left: -10">
                    <img src="<?=img.'cuenta4.gif' ?>" height="40" width="170" >  
                    </p>                          
                        
                <?php    
                   }else{
                    ?>
                    <p style="margin-top: ; margin-left: -10">
                    <img src="<?=img.'cuenta1.png' ?>" height="40" width="170" > 
                     </p> 
                    <p style="margin-top: ; margin-left: -10">
                    <img src="<?=img.'cuenta2.png' ?>" height="40" width="170" >  
                    </p>   

                    <?php
                   }    
                ?>  
            </td>
            <td style="text-indent: 10mm;  width: 32%">
            <?php
                   if($data['cliente']['id_cuenta']==2){

             ?>          
                    <h6 style=" margin-top:; margin-left: 40;"> CUENTAS: BANORTE 1032019545<br></h6>
                    <h6 style="margin-top: -8; margin-left: 50;">INTERBANCARIA 072180010320195452<br></h6>
                    <h6 style="margin-top: -8; margin-left: 50;">TARJETA (OXXO) 4915663038417599<br></h6>
                    <h6 style="margin-top: -8; margin-left: 50;">BANAMEX 246-4309619<br></h6>
                    <h6 style="margin-top: -8; margin-left: 50;">INTERBANCARIA 002180024643096197<br></h6>
                    <h6 style="margin-top: -8; margin-left: 50;">TARJETA (OXXO) 5204167180525693<br></h6>
                              
                <?php    
                   }else{
                ?>
                <h6 style=" margin-top:; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CUENTAS: BANAMEX 7012-3820248 <br></h6>
                        <h6 style="margin-top: -8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INTERBANCARIA 002180701238202486<br></h6>
                        <h6 style="margin-top: -8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TARJETA (OXXO) 5204165231173695</h6>
                        <h6 style="margin-top: -8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CUENTAS: BANCOMER 1515561019 <br></h6>
                        <h6 style="margin-top: -8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  INTERBANCARIA 012180015155610196<br></h6>
                        <h6 style="margin-top: -8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TARJETA (OXXO) 4152313283739972</h6>   
                        <h6 style=" margin-top:-8; margin-left: 50;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CUENTAS SCOTIABANK 00103712845<br></h6>
                        <h6 style="margin-top: -8; margin-left: 50;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INTERBANCARIA 044180001037128458<br></h6>

                <?php    
                   } 
                ?>           
            </td>
        </tr>
    </table>
    <hr>
    <strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Favor de realizar el pago con centavos</strong>
    <hr>
  
</page>
