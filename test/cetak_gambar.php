<?php 
	
	function cetak_gambar($pl=2){		

		$arrChar = [
			"=",
			"*"
		];

		$str="";
		for ($i=1; $i <= $pl; $i++) { 
			for ($j=1; $j <= $pl; $j++) {
				$h = $i+$j;
				$idx = ($h % 2 == 0) ? 0 : 1;
				$str .= $arrChar[$idx];
				$str .= " ";
			}
			$str .= "<br>";
		}
		return $str;
	}

	echo cetak_gambar(5,5);
	echo "<br>";
	echo cetak_gambar();
