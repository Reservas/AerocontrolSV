<?php
include "../docs/phppdf/fpdf.php";
include "../user/files/conexion.php";
	
	$stmt = $mysqli->prepare("SELECT id, city, state, zip FROM cities ORDER BY id");
	$stmt->execute(); 
	$result = $stmt->get_result();
	$row_cnt = $result->num_rows;
	if($row_cnt>0)
	{
		$pdf = new FPDF();
		$pdf->AddPage('P', 'Letter');
		$pdf->SetFont('Arial','B',12);
		$pdf->Image('../docs/img/logoac.png',10,0,53);
		$pdf->Ln(10);
		$pdf->Cell(200,10,'Listado de ciudades y destinos',0,0,'C');
		$pdf->Ln(10);
		$now = new DateTime();
		$pdf->Cell(40,10,'Fecha: '.$now->format('d-m-Y'),0,0,'C');
		$pdf->Ln(10);
		if(isset($_SESSION['usuario'])){
			$pdf->Cell(40,10,'Usuario: '.$_SESSION['usuario'],0,0,'C');
		}
		$pdf->Ln(20);
		$w = array(20, 70, 70, 30);
		$header = array('Id', 'Nombre de la ciudad', 'Estado', 'Codigo ZIP');
		for($i=0;$i<count($header);$i++){
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		while($row = mysqli_fetch_assoc($result))
		{
			$pdf->Cell($w[0],6,$row['id'],'LR');
			$pdf->Cell($w[1],6,$row['city'],'LR');
			$pdf->Cell($w[2],6,$row['state'],'LR');
			$pdf->Cell($w[3],6,$row['zip'],'LR');
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

?>