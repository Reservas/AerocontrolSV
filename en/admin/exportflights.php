<?php
session_start();
include "../docs/phppdf/fpdf.php";
include "../user/files/conexion.php";
	
	if(isset($_SESSION['airline'])){
		$stmt = $mysqli->prepare("SELECT f.id, f.airline, a.name AS airlinename, f.departure_time, f.departure_city, c1.city AS depcity, f.arrival_time, f.arrival_city, c2.city AS arrcity, f.aircraft, ac.name AS aircname, f.departure_runway, f.arrival_runway, f.cost, f.seats, f.description FROM flights f INNER JOIN airlines a ON f.airline = a.id INNER JOIN cities c1 ON f.departure_city = c1.id INNER JOIN cities c2 ON f.arrival_city = c2.id INNER JOIN aircraft ac ON f.aircraft = ac.id WHERE f.airline = ?");
		$stmt->bind_param('i',$_SESSION['airline']);
	}else{
		$stmt = $mysqli->prepare("SELECT f.id, f.airline, a.name AS airlinename, f.departure_time, f.departure_city, c1.city AS depcity, f.arrival_time, f.arrival_city, c2.city AS arrcity, f.aircraft, ac.name AS aircname, f.departure_runway, f.arrival_runway, f.cost, f.seats, f.description FROM flights f INNER JOIN airlines a ON f.airline = a.id INNER JOIN cities c1 ON f.departure_city = c1.id INNER JOIN cities c2 ON f.arrival_city = c2.id INNER JOIN aircraft ac ON f.aircraft = ac.id ");
	}
	$stmt->execute(); 
	$result = $stmt->get_result();
	$row_cnt = $result->num_rows;
	if($row_cnt>0)
	{
		$pdf = new FPDF();
		$pdf->AddPage('L', 'Legal');
		$pdf->SetFont('Arial','B',12);
		$pdf->Image('../docs/img/logoac.png',10,0,53);
		$pdf->Ln(10);
		$pdf->Cell(200,10,'List of the glights',0,0,'C');
		$pdf->Ln(20);
		$w = array(10, 30, 37, 37, 37, 27, 27, 23, 43, 43, 20);
		$header = array('Id', 'Airline', 'Name of the aircraft', 'Departure city', 'Destination city
', 'Departure runway', 'Destination runway', 'Cost', 'Departure time', 'time landing', 'Seats');
		for($i=0;$i<count($header);$i++){
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		while($row = mysqli_fetch_assoc($result))
		{
			$pdf->Cell($w[0],6,$row['id'],'LR');
			$pdf->Cell($w[1],6,$row['airlinename'],'LR');
			$pdf->Cell($w[2],6,$row['aircname'],'LR');
			$pdf->Cell($w[3],6,$row['depcity'],'LR');
			$pdf->Cell($w[4],6,$row['arrcity'],'LR');
			$pdf->Cell($w[5],6,$row['departure_runway'],'LR');
			$pdf->Cell($w[6],6,$row['arrival_runway'],'LR');
			$pdf->Cell($w[7],6,"$ ".number_format($row['cost'], 2),'LR', 0, 'R');
			$pdf->Cell($w[8],6,$row['departure_time'],'LR');
			$pdf->Cell($w[9],6,$row['arrival_time'],'LR');
			$pdf->Cell($w[10],6,$row['seats'],'LR');
			$pdf->Ln();
		}
		$pdf->Cell(array_sum($w),0,'','T');
		$pdf->Output();
	}

?>