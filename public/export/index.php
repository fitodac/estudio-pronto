<?php 

$servername = '127.0.0.1';

// development
// $database = 'pronto'; 
// $username = 'root';
// $password = 'mysql123';

// production
$database = 'admin_estudio_pronto'; 
$username = 'admin_estudio_pronto';
$password = '_856Cati';

$port = '3306';
$sql = "mysql:host=$servername;dbname=$database;port=$port";



try {
	$pdo = new PDO($sql, $username, $password);

	$sql = "SELECT * FROM pacientes";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$pdo = null;

	// file creation
	$filename = 'estudio_pronto-'.date('d.m.Y').'.csv';
	header('Content-Type: application/csv');
	header("Content-Disposition: attachment; filename=\"$filename\"");

  $file = fopen('php://output', 'w');
	fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );


	$header = [
		"Id",
		"Hospital",
		"Edad",
		"Sexo",
		// Inclusión
		"El/la paciente ha sido diagnosticado/a de enfermedad oncológica relacionada con un tumor sólido (independientemente del tipo de cáncer).",
		"Es la primera visita a consulta externa de oncología del/la paciente tras el diagnóstico oncológico.",
		"El/la paciente tiene ≥ 18 años.",
		"El/la paciente accede a formar parte del estudio y firma el consentimiento informado.",
		// Exclusión
		"El/la paciente ya ha sido diagnosticado/a y está en tratamiento contra el cáncer.",
		"El/la paciente ha sido diagnosticado/a con una enfermedad neoplásica líquida.",
		"El/la paciente ha recibido alguna intervención nutricional con suplementos nutricionales orales en los 3 meses anteriores.",
		"El/la paciente tiene demencia avanzada conocida o cualquier otra condición psicológica grave que puede interferir con su capacidad para asistir y completar el estudio.",
		"El/la paciente tiene algún trastorno alimentario conocido.",
		"El/la paciente no tiene la capacidad de entender el propósito del estudio.",
		// Diagnóstico
		"Diagnóstico: Tipo de cáncer",
		"Diagnóstico: Estadío",
		// Comorbilidades
		"Comorbilidades",
		"Comorbilidades: descripción",
		// Ecog
		"Estado de rendimiento ECOG",
		// Datos antropométricos
		"Peso actual kg",
		"Talla (metros)",
		"IMC actual kg/m",
		"Peso habitual kg",
		"Peso perdido Kg",
		"Peso perdido %",
		// Cuestionario Pronto
		"¿Ha perdido peso involuntariamente (5% a 10% o más) en los últimos 3-6 meses desde nuestra última consulta?",
		"¿Ha estado comiendo menos de lo habitual en la última semana/desde nuestra última consulta?",
		"¿Ha perdido fuerza o se siente más débil que lo usual desde nuestra última consulta?",
		// Criterios GLIM
		"Pérdida de peso %",
		"Bajo IMC",
		"Masa muscular reducida",
		"Reducción de la ingesta o asimilación de alimentos",
		"Inflamación",
		"Paciente desnutrido mediante los criterios GLIM",
		"Gravedad de la desnutrición",
		// Suplementación nutricional oral
		"Suplementación nutricional oral",
		"Suplementación nutricional oral (motivo)",
		// Remisión al servicio de nutrición del hospital
		"Remisión al servicio de nutrición del hospital",
		"Remisión al servicio de nutrición del hospital (motivo)",
		"Fecha"
	];
	
	fputcsv($file, $header);


	while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){

		// echo '<pre>';
		// var_dump($row);
		// echo '</pre>';

		$inclusion = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['inclusion']), true );
		$exclusion = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['exclusion']), true );
		$diagnosis = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['diagnosis']), true );
		$comorbidities = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['comorbidities']), true );
		$anthropometric = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['anthropometric_data']), true );
		$questionnaire = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['questionnaire']), true );
		$glim = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['glim_criteria']), true );
		$ons = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['oral_nutritional_supplementation']), true );
		$rns = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['referral_to_nutrition_service']), true );

	

		fputcsv($file, [
			'id' => $row['id'],
			'hospital' => $row['hospital'],
			'edad' => $row['age'],
			'sex' => $row['sex'],
			'inclusion_1' => 'S' === $inclusion['option_1'] ? 'Si' : $inclusion['option_1'],
			'inclusion_2' => 'S' === $inclusion['option_2'] ? 'Si' : $inclusion['option_2'],
			'inclusion_3' => 'S' === $inclusion['option_3'] ? 'Si' : $inclusion['option_3'],
			'inclusion_4' => 'S' === $inclusion['option_4'] ? 'Si' : $inclusion['option_4'],
			'exclusion_1' => 'S' === $inclusion['option_1'] ? 'Si' : $inclusion['option_1'],
			'exclusion_2' => 'S' === $inclusion['option_2'] ? 'Si' : $inclusion['option_2'],
			'exclusion_3' => 'S' === $inclusion['option_3'] ? 'Si' : $inclusion['option_3'],
			'exclusion_4' => 'S' === $inclusion['option_4'] ? 'Si' : $inclusion['option_4'],
			'exclusion_5' => 'S' === $inclusion['option_5'] ? 'Si' : $inclusion['option_5'],
			'exclusion_6' => 'S' === $inclusion['option_6'] ? 'Si' : $inclusion['option_6'],
			'dignosis_type' => implode(',', $diagnosis['type']),
			'dignosis_condition' => $diagnosis['condition'],
			'comorbidities_status' => $comorbidities['status'],
			'comorbidities_description' => $comorbidities['description'],
			'ecog' => $row['ecog_performance_status'],
			'anthropometric_weight' => $anthropometric['weight'],
			'anthropometric_tall' => $anthropometric['tall'],
			'anthropometric_img' => number_format((float)$anthropometric['imc'], 2, '.', ''),
			'anthropometric_weight_normal' => $anthropometric['weight_normal'],
			'anthropometric_weight_loss' => $anthropometric['weight_loss'],
			'anthropometric_weight_loss_percent' => $anthropometric['weight_loss_percent'],
			'questionnaire_op1' => $questionnaire['option_1'],
			'questionnaire_op2' => $questionnaire['option_2'],
			'questionnaire_op3' => $questionnaire['option_3'],
			'glim_weight_loss_percent' => $glim['phenotypic_criteria']['weight_loss_percent'] ?? '',
			'glim_low_imc' => $glim['phenotypic_criteria']['low_imc'] ?? '',
			'glim_muscle_mass' => $glim['phenotypic_criteria']['muscle_mass'] ?? '',
			'glim_reduced_dietary_intake' => $glim['etiological_criteria']['reduced_dietary_intake'] ?? '',
			'glim_inflammation' => $glim['etiological_criteria']['inflammation'] ?? '',
			'glim_malnourished_patient' => $glim['malnourished_patient'] ?? '',
			'glim_severity_of_malnutrition' => $glim['severity_of_malnutrition'] ?? '',
			'ons_status' => 'S' === $ons['status'] ? 'Si' : $ons['status'],
			'ons_description' => $ons['description'],
			'rns_status' => 'S' === $rns['status'] ? 'Si' : $rns['status'],
			'rns_description' => $rns['description'],
			'date' => date('d/m/Y', strtotime($row['date']))
			// 'date' => $row['date']
		]);

	}


	fclose($file);
	exit;

} catch(PDOException $e) {
	// echo 'Connection error: ' . $e->getMessage();
	echo json_encode(['status' => 0]);
}