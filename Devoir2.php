
----------------------------------------SAIDI Souad----OUHMOUD Hayat--------------------------------------------

// EXERCICE 1 :
<?php

     function TransformerChaine($string , $car)
     { 
       $T=[]; $s="";
       $ch1= $string.$car;
       $l = strlen($ch1);// longeur de chaine
       for($i=0 ;$i<$l ; $i++)
        { 
                
            if($ch1[$i]!= $car)
                 $s.=$ch1[$i];

            else
            {
            array_push($T,$s);// Ajouter au tableau 
             $s="";
            }
            
        }
        return $T;
    }
         $Tab=TransformerChaine("Hello|world|Bonjour","|");
         print_r($Tab);
?>
// EXERCICE 2 :
  <?php 
    echo "<h3 align=center>Commande clients</h3>";
    echo "<table border=2>";
                 echo '<tr bgcolor="grey" >';
                 echo '<th style="padding: 10px;"> Numero de commande</th>';		
                 echo "<th>Numero de Client</th>";
                 echo "<th>Date de commande</th>";
                 echo "<th>Désignation article</th>";
                 echo "<th> Quantité (Pal)</th>";
                 echo "<th> Prix unitaire (Dh)</th>";
                 echo "<th> Date de livraison</th> ";
                 echo " <th> Adresse client </th></tr>";
    $f=fopen("Fichier.txt","r");
       while(!feof($f))
            {
                $ligne=fgets($f);
                     if(!empty($ligne))
                      {
                        $T=explode("|",$ligne);
                        //archiver les commandes du client CLI1001 dans un fichier de données pscde01_CLI1001.txt
                          if($T[1]=="CLI1001")
                             { 
                                 $f1=fopen("pscde01_CLI1001.txt","a");
                                  fwrite($f1,$ligne);
                             }
                        //archiver les commandes du client CLI1001 dans un fichier de données pscde01_CLI1004.txt
                          if($T[1]=="CLI1004")
                             {
                                $f2=fopen("pscde01_CLI1004.txt","a");
                                  fwrite($f2,$ligne);
                             }
                           echo "<tr>";
                            for($i=0;$i<count($T);$i++)// Afficher le contenu de fichier .txt  dans le tableau 
                                echo "<td style=\"padding: 5px;\">$T[$i]</td>";
                           echo "</tr>";
                        }
            }    
            fclose($f1);
            fclose($f2);
            fclose($f);
            echo "</table>";
?> 
// EXERCICE 3 :
<?php
              // la page principale : fichier Ex3.php
  echo "<h1> Chosir une date :</h1>";
  echo "<form method=\"post\" action=\"valider.php\">";
  echo "<table>";
  echo "<tr><td><label>Jour</label><br>";
  echo "<select name=\"jour\" >";
    for($i=1;$i<=31;$i++)
     {echo "<option>$i</option>";}
  echo "</select>";
  echo "</td>";
  echo "<td><label>Mois</label><br>";
  echo "<select name=\"mois\" >";
    for($i=1;$i<=12;$i++)
     {echo "<option>$i</option>";}
  echo "</select></td>";
  echo "<td><label>Année</label><br>";
  echo "<select name=\"annee\" >";
    for($i=1900;$i<=2020;$i++)
     {echo "<option>$i</option>";}
  echo "</select></td></tr></table>";
  echo'<input type="submit" value="Envoyer" name="envoi" style="background-color:grey;">';
  echo "</form>";
  ?>
  <?php
                //fichier php : valider.php 
 $j=$_POST['jour'];
 $m=$_POST['mois'];
 $a=$_POST['annee'];
     echo "<h1>Validation de a Date </h1>"; 
     echo "La date saisie est : $j/$m/$a <br>";
    if(checkdate($m,$j,$a))// checkdate() pour verifier la date : return true si la date existe false si non 
       echo "La Date : <span style=\" color:green; \"> valider </span>";
    else
       {
           if($m==2) echo "L'annee $a est non bessextile :";
           echo "La Date  <span style=\" color:red; \"> Invalider </span>";
       }    
?>
// EXERCICE 4 :
    
<?php
                   // fichier : aceuil.php 
            $p="";
     if (isset($_POST['login']))
     {
   $pass=$_POST["pass"];
   if(strlen($pass)<8)
   {
   	  $p="<br><span style=\"color:red;\">Mot de passe trop court !(au moins 8 caracteres) </span><br>";
   }
   if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $pass)){ $p.= "<span style=\"color:red;\">Mot de passe valide !</span>";}
   else{
   	      $p.="<span style=\"color:red;\">Mot de passe invalide !</span>";
        }
   }
?>
 <html>
 <head>
 </head>
 <body>
  <h3 align="center">Authentification</h3>
  <form  method="post" action="authentification.php">
  <table align="center">
  	<tr>
   <td><label for="email" ><b>Email :</b></label></td>
   <td><input type="text" name="email" placeholder="Entrez votre email..." required></td>
    </tr>
    <br>
   <tr>
    <td><label for="pass" ><b>Password :</b></label></td>
   <td><input type="password" name="pass" placeholder="Entrez votre mot de passe.." required></td>// required : pour les champs etre oblige a remplire
    </tr>
    <tr ><td colspan="2"><?php echo "$p"; ?></td></tr>
    <tr>
    	<td> </td>
    	<td><input type="submit" name="login" value="Login">
    	</td>
    	
    </tr>
   </table>
</form>
</body>
</html>

<?php    
                            // Fichier : authentification.php 
  $email=$_POST["email"];
  $pass=$_POST["pass"];
  function Email($e)
  { return (!preg_match("^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$^", $e)) ? FALSE : TRUE;       
   }
   function Password($pa)
    {
        if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $pa))
            return true;
        else
            return false;
    }
      $b=false; $a=false;
     if(Email($email)&&Password($pass))
         {        
                $f=fopen("login.txt","r");
                    while(!feof($f))
                       {       
                               $ligne=fgets($f);
                                  $ligne=trim($ligne);
                                  $T=explode("|",$ligne);
                                     if($email==$T[0] && $pass==$T[1])
                                               {$b=0;break;}
                                     if($email!=$T[0] && $pass==$T[1])
                                               {$b=1; break;}
                                     if($email==$T[0] && $pass!=$T[1])
                                               {$b=2;break;}                             
                       }
                fclose($f);
         }
    else 
         echo "Email invalider ou Mot de Passe non conforme ";
    
          if($b==0)
                 echo " Authentification réussie ";
          if($b==1)
                  echo " login inexistant";
          if($b==2)
                echo "Mot de passe non valider";
?>