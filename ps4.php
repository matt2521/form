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

                $sql = "SELECT `Lp`, `Imię i Nazwisko`, `Data od`, `Data do`, `Miejsce wyjazdu`, `Miejsce przyjazdu` FROM `delegacja_db`";
              
                $rs = mysqli_query($con, $sql);

                if(mysqli_num_rows($rs) > 0)
                {
                echo '<table> <tr> <th> Lp </th> <th> Imię i Nazwisko </th> <th> Data od </th> <th> Data do </th> <th> Miejsce wyjazdu </th> <th> Miejsce przyjazdu </th> </tr>';
                while($row = mysqli_fetch_assoc($rs)){
                   echo '<tr> <td>' . $row["Lp"] . '</td>
                   <td>' . $row["Imię i Nazwisko"] . '</td>
                   <td> ' . $row["Data od"] . '</td>
                   <td>' . $row["Data do"] . '</td>
                   <td> ' . $row["Miejsce wyjazdu"] . '</td>
                   <td>' . $row["Miejsce przyjazdu"] . '</td> </tr>';
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