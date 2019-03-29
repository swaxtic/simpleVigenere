<?php

// initialize variables
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";
// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('vigenere.php');

	// set the variables
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];

	// check if password is provided
	if (empty($_POST['pswd']))
	{
		$error = "Masukkan Key!";
		$valid = false;
	}

	// check if text is provided
	else if (empty($_POST['code']))
	{
		$error = "Masukkan Text!";
		$valid = false;
	}

	// check if password is alphanumeric
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Key Harus Huruf!";
			$valid = false;
		}
	}

	// inputs valid
	if ($valid)
	{
		// if encrypt button was clicked
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Sukses Mengenkripsi Text!";
			$color = "#526F35";
		}

		// if decrypt button was clicked
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Sukses Dekripsi Cipher!";
			$color = "#526F35";
		}
	}
}
?>

<html>
	<head>
		<title>Vigenere Cipher</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<br><br><br>
<div class="main">
   <div class="container">
	<div class="row form-row">
		<form action="decrypt.php" method="post">
				<caption><hr><b>SWAXTIC Vigenere Cipher Tools</b><hr></caption>
          <hr><b><a href='index.php'>Encrypt</a> | <a href='decrypt.php'>Decrypt</a></b><hr>
        
				<tr>
					<td align="center">Key: <input type="text" name="pswd" id="pass" value="<?php echo htmlspecialchars($pswd); ?>" /></td>
				</tr>
				<tr>
					<textarea class="form-control" id="text-input" name="code" placeholder="Text Plain"><?php echo htmlspecialchars($code); ?></textarea>
				</tr>
				<tr>
					<td><input type="submit" name="decrypt" class="button" value="Decode" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td>
				</tr>
		</form>
		</div>
			</div>
		</div>
	</body>
</html>
