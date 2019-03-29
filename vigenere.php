<?php

// function to encrypt the text given
function encrypt($pswd, $text)
{
  //array untuk mengubah abjad menjadi angka
  $AbjToNumTable=array('a' => '0','b' => '1','c' => '2','d'=>'3','e'=>'4','f'=>'5','g'=>'6','h'=>'7','i'=>'8','j'=>'9','k'=>'10',
      'l'=>'11','m'=>'12','n'=>'13','o'=>'14','p'=>'15','q'=>'16','r'=>'17','s'=>'18','t'=>'19','u'=>'20',
      'v'=>'21','w'=>'22','x'=>'23','y'=>'24','z'=>'25'
  );

  //tabel untuk mengubah angka menjadi huruf
  $table ="abcdefghijklmnopqrstuvwxyz";

	//mengubah key kedalam bentuk huruf kecil
	$pswd1 = strtolower($pswd);
  //menghilangkan spasi pada key
  $pswd = str_replace(' ', '', $pswd1);

  //mengubah plaintext menjadi huruf kecil
  $text1 = strtolower($text);
  //menghilangkan spasi pada plaintext
  $text = str_replace(' ', '', $text);

	//inisialisasi variable
	$ki = 0;
  //mencari panjang key
	$kl = strlen($pswd);
  //mencaari panjang plaintext
	$length = strlen($text);

	//looping untuk mencari nilai enkripsi sepajang nilai plaintext
	for ($i = 0; $i < $length; $i++)
	{
		// if the letter is alphabetical, encrypt it
		if (ctype_alpha($text[$i]))
		{
        //variabel mengambil kata ke-n
        $fghij = $text[$i];
        $numText = $AbjToNumTable[$fghij]; //0

        //variabel mengambil password ke-n
        $abcde = $pswd[$ki];
        $numPass = $AbjToNumTable[$abcde];  //1

        $angkaCipher = ($numText + $numPass)%26; //0+1%26 = 1
        $kataHasil = substr($table,$angkaCipher,1); //1,1 = b
        $text[$i] = $kataHasil;
			}
			// update the index of key
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}
	// return the encrypted code
	return $text;
}


// function to decrypt the text given
function decrypt($pswd, $text)
{
  $AbjToNumTable=array('a' => '0','b' => '1','c' => '2','d'=>'3','e'=>'4','f'=>'5','g'=>'6','h'=>'7','i'=>'8','j'=>'9','k'=>'10',
      'l'=>'11','m'=>'12','n'=>'13','o'=>'14','p'=>'15','q'=>'16','r'=>'17','s'=>'18','t'=>'19','u'=>'20',
      'v'=>'21','w'=>'22','x'=>'23','y'=>'24','z'=>'25'
  );
  $table ="abcdefghijklmnopqrstuvwxyz";
	// change key to lowercase for simplicity
  $pswd1 = strtolower($pswd);
  $pswd = str_replace(' ', '', $pswd1);

  $text1 = strtolower($text);
  $text = str_replace(' ', '', $text);

	// intialize variables
	$code = "";
	$ki = 0;
	$kl = strlen($pswd);
	$length = strlen($text);

	// iterate over each line in text
	for ($i = 0; $i < $length; $i++)
	{
		// if the letter is alpha, decrypt it
		if (ctype_alpha($text[$i]))
		{

        $fghij = $text[$i];
        $numText = $AbjToNumTable[$fghij];

        //variabel mengambil password ke-n
        $abcde = $pswd[$ki];
        $numPass = $AbjToNumTable[$abcde];

        $angkaCipher = ($numText - $numPass)%26;
        $kataHasil = substr($table,$angkaCipher,1);
        $text[$i] = $kataHasil;
			}

			// update the index of key
			$ki++;
			if ($ki >= $kl)
			{
				$ki = 0;
			}
		}

	// return the decrypted text
	return $text;
}

?>
