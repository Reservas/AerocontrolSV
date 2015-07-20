<?php
session_start();
include "../docs/phppdf/fpdf.php";
include "../user/files/conexion.php";
	
	if(isset($_SESSION['airline'])){
		$stmt = $mysqli->prepare("SELECT `bookings`.`id`, `costumers`. `name`,`bookings`.`flight`, `bookings`.`seats`, `is_cancelled`, `justification` FROM `bookings` INNER JOIN `costumers` ON `bookings`.`costumer` = `costumers`. `id` INNER JOIN `flights` ON `bookings`.`flight` = `flights`. `id` INNER JOIN `airlines` ON `flights`. `airline` = `airlines`. `id` WHERE `airlines`. `id` = ? ");
		$stmt->bind_param('i',$_SESSION['airline']);
	}else{
		$stmt = $mysqli->prepare("SELECT `bookings`.`id`, `costumers`. `name`,`bookings`.`flight`, `bookings`.`seats`, `is_cancelled`, `justification` FROM `bookings` INNER JOIN `costumers` ON `bookings`.`costumer` = `costumers`. `id` INNER JOIN `flights` ON `bookings`.`flight` = `flights`. `id` INNER JOIN `airlines` ON `flights`. `airline` = `airlines`. `id` ");
	}
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
		$pdf->Cell(200,10,'Buy list',0,0,'C');
		$pdf->Ln(20);
		$w = array(10, 70, 20, 20, 40, 70);
		$header = array('Id', 'Client', 'Fligh', 'Seats', 'Estate', 'Justification');
		for($i=0;$i<count($header);$i++){
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		while($row = mysqli_fetch_assoc($result))
		{
			$pdf->Cell($w[0],6,$row['id'],'LR');
			$pdf->Cell($w[1],6,$row['name'],'LR');
			$pdf->Cell($w[2],6,$row['flight'],'LR');
			$pdf->Cell($w[3],6,$row['seats'],'LR');
			if($row['is_cancelled'] == 0){
				$pdf->Cell($w[4],6,'Open','LR');
			}else{
				$pdf->Cell($w[4],6,'Cancel','LR');
			}
			$pdf->Cell($w[5],6,$row['justification'],'LR');
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

?>