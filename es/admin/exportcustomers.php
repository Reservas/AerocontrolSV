<?php
include "../docs/phppdf/fpdf.php";
include "../user/files/conexion.php";
	
	$stmt = $mysqli->prepare("SELECT id, name, address, city, state, birthdate, phone, user, password, status FROM costumers ORDER BY id");
	$stmt->execute(); 
	$result = $stmt->get_result();
	$row_cnt = $result->num_rows;
	if($row_cnt>0)
	{
		$pdf = new FPDF();
		$pdf->AddPage('L', 'Letter');
		$pdf->SetFont('Arial','B',12);
		$pdf->Image('../docs/img/logoac.png',10,0,53);
		$pdf->Ln(10);
		$pdf->Cell(200,10,'Listado de clientes',0,0,'C');
		$pdf->Ln(10);
		$now = new DateTime();
		$pdf->Cell(40,10,'Fecha: '.$now->format('d-m-Y'),0,0,'C');
		$pdf->Ln(10);
		if(isset($_SESSION['usuario'])){
			$pdf->Cell(40,10,'Usuario: '.$_SESSION['usuario'],0,0,'C');
		}
		$pdf->Ln(20);
		$w = array(10, 60, 60, 30, 30, 35, 35);
		$header = array('Id', 'Nombre del cliente', 'Direccion', 'Nacimiento', 'Telefono', 'Usuario', 'Estado');
		for($i=0;$i<count($header);$i++){
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		while($row = mysqli_fetch_assoc($result))
		{
			$pdf->Cell($w[0],6,$row['id'],'LR');
			$pdf->Cell($w[1],6,$row['name'],'LR');
			$pdf->Cell($w[2],6,$row['address'],'LR');
			$pdf->Cell($w[3],6,$row['birthdate'],'LR');
			$pdf->Cell($w[4],6,$row['phone'],'LR');
			$pdf->Cell($w[5],6,$row['user'],'LR');
			switch($row["status"])
			{
				case 0;
					$pdf->Cell($w[6],6,'Inactivo','LR');
				break;
				case 1;
					$pdf->Cell($w[6],6,'Activo','LR');
				break;
			}
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

?>