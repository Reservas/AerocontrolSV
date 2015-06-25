<?php
include "../docs/phppdf/fpdf.php";
include "../user/files/conexion.php";
	
	$stmt = $mysqli->prepare("SELECT airports.id, airports.name, airports.location, cities.city, cities.state FROM airports INNER JOIN cities ON airports.location = cities.id ORDER BY id");
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
		$pdf->Cell(200,10,'List of airports',0,0,'C');
		$pdf->Ln(20);
		$w = array(20, 90, 90);
		$header = array('Id', 'Name of the airport', 'Location (City - Estate)');
		for($i=0;$i<count($header);$i++){
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		while($row = mysqli_fetch_assoc($result))
		{
			$pdf->Cell($w[0],6,$row['id'],'LR');
			$pdf->Cell($w[1],6,$row['name'],'LR');
			$pdf->Cell($w[2],6,$row['city']." - ".$row['state'],'LR');
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

?>