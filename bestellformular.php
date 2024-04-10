<?php
$error=[];
$done=false;
//Testen ob alles ausgefühlt und ggf. aus Buchstaben besteht, wenn ja done.
if(isset($_POST["send"])&&isset($_POST["vname"])&&ctype_alpha($_POST["vname"])&&isset($_POST["nname"])&&ctype_alpha($_POST["nname"])&&isset($_POST["agb"]))$done=true;
//Fehlerbehandlung, Sinnhaftigkeit der Eingabe spielt leider keine Rolle, also auch a b kann bestellen.
else {  //Fehler1: Vorname nicht eingegeben oder besteht nicht nur aus Buchstaben
        if(isset($_POST["send"])&&(!isset($_POST["vname"])||!ctype_alpha($_POST["vname"])))
        //Tritt F1 auf wird der Fehler gesetzt sonst der eingegebene Name behalten
        {$error["vname"]=1;} else if(isset($_POST["vname"])&&ctype_alpha($_POST["vname"])) {$vname=$_POST["vname"];}
        //Fehler2: Nachname nicht eingegeben oder besteht nicht nur aus Buchstaben
        if(isset($_POST["send"])&&(!isset($_POST["nname"])||!ctype_alpha($_POST["nname"])))
        //Tritt F2 auf wird der Fehler gesetzt sonst der eingegebene Name behalten
        {$error["nname"]=1;} else if(isset($_POST["nname"])&&ctype_alpha($_POST["nname"])) {$nname=$_POST["nname"];}
        //Fehler3: AGBs nicht gescheckt
        if(isset($_POST["send"])&&!isset($_POST["agb"]))
        //Tritt F3 auf wird der Fehler gesetzt sonst agb flag gesetzt
        {$error["agb"]=1;}  else if(isset($_POST["agb"])) {$agb=1;}
        //Fehler4: unbekannt; mögliche Manipulation, wird auch nochmal als letzte Möglichkeit im HTML genutzt
        else if(isset($_POST["send"])) $error["unbe"]=1;
     }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!$done) {?>
    <p>Bitte geben Sie Ihre Daten ein. Alle Felder müssen ausgefüllt werden!</p>
    <?php if(isset($error["unbe"])){?><font color="red"><br>Es ist ein unbekannter Fehler aufgetreten, bitte versuchen Sie es noch einmal.</font><?php } ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <label for="vname">Vorname</label>
    <input type="text" name="vname" value="<?php if(isset($vname)) echo $vname; ?>"><?php if(isset($error["vname"])){?><font color="red">  Vorname muß angegeben werden.</font><?php } ?><br><br>
    <label for="nname">Nachname</label>
    <input type="text" name="nname" value="<?php if(isset($nname)) echo $nname; ?>"><?php if(isset($error["nname"])){?><font color="red">  Nachname muß angegeben werden.</font><?php } ?><br><br>
    <?php if(isset($error["agb"])){?><font color="red">Die AGBs müssen akzeptiert werden.<br></font><?php } ?>
    <input type="checkbox" name="agb"<?php if(isset($agb)) {?>checked="checked"<?php } ?>>
    <label for="agb">Ich habe die AGBs gelesen und bin mit ihnen einverstanden.</label><br><br>
    <input type="submit" name="send" value="Bestellung verbindlich abschicken">
    <?php } else if($done) echo "<h2>".$_POST["vname"]." ".$_POST["nname"].", danke für Ihre Bestellung.</h2>"; else $error["unbe"]=1;?>
    </form>
    
</body>
</html>