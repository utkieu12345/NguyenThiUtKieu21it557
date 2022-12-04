<?php

	for($i=0;$i<count($_SESSION['id_them_vao_giox']);$i++)
	{
		$name_id="id_".$i;
		$name_ch ="ch_".$i;
		if(isset($_POST[$name_id]) and isset($_POST[$name_ch]))
		{
		$_SESSION['sl_them_vao_giox'][$i]='0';
		}
	}
