<?php 
if(isset($_POST["enviar"])) {

		$x1 = $_POST["x1"];
		$y1 = $_POST["y1"];
		$z1 = $_POST["z1"];
		$r1 = $_POST["r1"];

		$x2 = $_POST["x2"];
		$y2 = $_POST["y2"];
		$z2 = $_POST["z2"];
		$r2 = $_POST["r2"];

		$x3 = $_POST["x3"];
		$y3 = $_POST["y3"];
		$z3 = $_POST["z3"];
		$r3 = $_POST["r3"];

		$erro_valor = $_POST["erro"];

		//criterio de linhas
		if((abs($x1) >= abs($y1) + abs($z1)) && (abs($y2) >= abs($x2) + abs($z2)) && (abs($z3) >= abs($x3) + abs($y3))){
			$x_zero[1] = $r1 / $x1; // x
			$x_zero[2] = $r2 / $y2; // y
			$x_zero[3] = $r3 / $z3; // z
			$x_ant[1] = $x_zero[1];
			$x_ant[2] = $x_zero[2];
			$x_ant[3] = $x_zero[3];
			$erro = NULL;
			$inter = 0;
			echo "
				<table border=\"1\">
					<tr>
						<td> Inter </td><td> X1 </td><td> X2 </td><td> X3 </td><td> ERRO </td>
					</tr>
					<tr>
						<td>" . $inter . "</td><td>" . $x_zero[1] . "</td><td>" . $x_zero[2] . "</td><td>" . $x_zero[3] . "</td><td>" . $erro . "</td>
					</tr>
			";
			echo $erro_valor;

			do{
				$inter++;
				$max_dif = 0;
				$max_x = 0;
				$x_zero[1] = ($r1 + ((-$y1) * $x_ant[2]) + ((-$z1) * $x_ant[3])) / $x1;
					if($max_dif < abs($x_zero[1] - $x_ant[1])){ $max_dif = abs($x_zero[1] - $x_ant[1]); }
					if($max_x < abs($x_zero[1])){ $max_x = abs($x_zero[1]); }

				$x_zero[2] = ($r2 + ((-$x2) * $x_ant[1]) + ((-$z2) * $x_ant[3])) / $y2;
					if($max_dif < abs($x_zero[2] - $x_ant[2])){ $max_dif = abs($x_zero[2] - $x_ant[2]); }
					if($max_x < abs($x_zero[2])){ $max_x = abs($x_zero[2]); }

				$x_zero[3] = ($r3 + ((-$x3) * $x_ant[1]) + ((-$y3) * $x_ant[2])) / $z3;
					if($max_dif < abs($x_zero[3] - $x_ant[3])){ $max_dif = abs($x_zero[3] - $x_ant[3]); }
					if($max_x < abs($x_zero[3])){ $max_x = abs($x_zero[3]); }

				$x_ant[1] = $x_zero[1];
				$x_ant[2] = $x_zero[2];
				$x_ant[3] = $x_zero[3];

					$erro = $max_dif / $max_x;

				echo "
						<tr>
							<td>" . $inter . "</td><td>" . $x_zero[1] . "</td><td>" . $x_zero[2] . "</td><td>" . $x_zero[3] . "</td><td>" . $erro . " , " . $max_dif . " , " . $max_x . "</td>
						</tr>
				";
			}while(($erro > $erro_valor) && ($inter < 7));
			echo "</table>";


		}else{
			echo "Erro no criterio de linhas!";
		}


	
}






echo "
	<div style=\"margin: 0 auto; border: 1 #000; padding: 15px;\">
		<form method=\"post\" action=\"\">
			<table>
				<tr>
					<td><input type=\"text\" name=\"x1\"></td>
					<td><input type=\"text\" name=\"y1\"></td>
					<td><input type=\"text\" name=\"z1\"> = </td>
					<td><input type=\"text\" name=\"r1\"></td>
				</tr>
				<tr>
					<td><input type=\"text\" name=\"x2\"></td>
					<td><input type=\"text\" name=\"y2\"></td>
					<td><input type=\"text\" name=\"z2\"> = </td>
					<td><input type=\"text\" name=\"r2\"></td>
				</tr>
				<tr>
					<td><input type=\"text\" name=\"x3\"></td>
					<td><input type=\"text\" name=\"y3\"></td>
					<td><input type=\"text\" name=\"z3\"> = </td>
					<td><input type=\"text\" name=\"r3\"></td>
				</tr>
				<tr>
					<td></td>
					<td>Erro < </td>
					<td><input type=\"text\" name=\"erro\"></td>
					<td><button type=\"submit\" name=\"enviar\" style=\"float: right;\">Enviar</button></td>
				</tr>
			</table>
		</form>
	</div>

";