<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<title>Zadanie zdalne</title>
</head>
<body>
		<div id="Lewy">
			<ul role="navigation">
				<li><a href="ps.html">Różne kontrolki HTML</a></li>
				<li><a href="ps2.html">Tabela Pracowników</a></li>
				<li><a href="ps3.html">Tabela Faktur VAT</a></li>
				<li><a href="ps4.php">Tabela Delegacji BD</a></li>
				<li><a href="ps5.php">Dane Kontrahentów</a></li>
			</ul>
		</div>
		<div id="Prawy">
			<form method="POST", name="frm" action="ps5.php">
				<fieldset>
					<legend>Dane kontrahenta</legend>
					NIP: <input type="text" name="nip" id="nip"></br>
					REGON: <input type="text" name="regon"></br>
					NAZWA: <input type="text" name="nazwa"></br>
					
					CZY PŁATNIK VAT?:</br>
					<input type="radio" name="vat" id="vat1" value="TAK" checked>
					<label for="vat1">TAK</label><br/>
					<input type="radio" name="vat" id="vat2" value="NIE">
					<label for="vat2">NIE</label><br/>

					ULICA: <input type="text" name="ulica"></br>
					NUMER DOMU: <input type="text" name="nd"></br>
					NUMER MIESZKANIA: <input type="text" name="nm"></br>
				</fieldset>

				<p>Wpisz dane i wciśnij przycisk Dodaj kontrahenta</p>
				<input type="submit" name="dodaj", value="Dodaj kontrahenta"></br></br>
	
				<p>Edytuj dane, dla kolumny NIP i wciśnij przycisk Edytuj kontrahenta</p>
				<input type="submit" name="edytuj", value="Edytuj kontrahenta"></br></br>
	
				<p>Wpisz numer NIP i wciśnij przycisk Usuń kontrahenta</p>
				<input type="submit" name="usun", value="Usuń kontrahenta"></br></br>
			</form>	

	        <?php
	            $host = "s35.zenbox.pl";
	            $username = "smartive_user10";
	            $password = "GyF9TEAF6r";
	            $dbname = "smartive_user10";

	            $con = mysqli_connect($host, $username, $password, $dbname);
                mysqli_set_charset($con, 'utf8');

	            if (!$con)
	            {
	                die("Połączenie nie powiodło się" . mysqli_connect_error());
	            }

		        if(isset($_POST["dodaj"])){
			        $nip = $_POST['nip'];
		            $regon = $_POST['regon'];
		            $nazwa = $_POST['nazwa'];
		            $vat = $_POST['vat'];
		            $ulica = $_POST['ulica'];
		            $nd = $_POST['nd'];
		            $nm = $_POST['nm'];

	       	        $sql = "SELECT `NIP`, `REGON`, `NAZWA`, `CZY PŁATNIK VAT?`, `ULICA`, `NUMER DOMU`, `NUMER MIESZKANIA` FROM `dane_kontrahent`";
		         
		            $rs = mysqli_query($con, $sql);
		            
	   	            while($row = mysqli_fetch_assoc($rs)){
		            	if($row["NIP"] == $nip){
		            		echo "Istnieje kontrahent o podanym numerze NIP";
		            		goto abc;
						}
	  				}

		            $sql = "INSERT INTO `dane_kontrahent` (`NIP`, `REGON`, `NAZWA`, `CZY PŁATNIK VAT?`, `ULICA`, `NUMER DOMU`, `NUMER MIESZKANIA`) VALUES ('$nip', '$regon', '$nazwa', '$vat', '$ulica', '$nd', '$nm')";
		            $rs = mysqli_query($con, $sql);
		           
		       }
	       

	            if(isset($_POST["edytuj"])){
			        $nip = $_POST['nip'];
		            $regon = $_POST['regon'];
		            $nazwa = $_POST['nazwa'];
		            $vat = $_POST['vat'];
		            $ulica = $_POST['ulica'];
		            $nd = $_POST['nd'];
		            $nm = $_POST['nm'];

	                $sql = "UPDATE `dane_kontrahent` SET `NIP`='$nip',`REGON`='$regon',`NAZWA`='$nazwa',`CZY PŁATNIK VAT?`='$vat',`ULICA`='$ulica',`NUMER DOMU`='$nd',`NUMER MIESZKANIA`='$nm' WHERE `NIP` = '$nip'";
	            	$rs = mysqli_query($con, $sql);
	           }

		        if(isset($_POST["usun"])){
			        $nip = $_POST['nip'];
	                $sql = "DELETE FROM `dane_kontrahent` WHERE `NIP` = '$nip'";
	            	$rs = mysqli_query($con, $sql);
	                }

	            abc:
	            $sql = "SELECT `NIP`, `REGON`, `NAZWA`, `CZY PŁATNIK VAT?`, `ULICA`, `NUMER DOMU`, `NUMER MIESZKANIA` FROM `dane_kontrahent`";
	          
	            $rs = mysqli_query($con, $sql);
	            
	            if(mysqli_num_rows($rs) > 0)
	            {
	            echo '<table id="tab"> <tr> <th> NIP </th> <th> REGON </th> <th> NAZWA </th> <th> CZY PŁATNIK VAT? </th> <th> ULICA </th> <th> NUMER DOMU </th> <th> NUMER MIESZKANIA </th> </tr>';
	            while($row = mysqli_fetch_assoc($rs)){
	               echo '<tr> <td>' . $row["NIP"] . '</td>
	               <td>' . $row["REGON"] . '</td>
	               <td> ' . $row["NAZWA"] . '</td>
	               <td>' . $row["CZY PŁATNIK VAT?"] . '</td>
	               <td> ' . $row["ULICA"] . '</td>
	               <td>' . $row["NUMER DOMU"] . '</td> 
	               <td>' . $row["NUMER MIESZKANIA"] . '</td> </tr>';
	                }
	               echo '</table>';
	           }
	           else{
                    echo 'Brak danych';
                }

	                mysqli_close($con);
	            ?>
	        </div>

</body>
</html>