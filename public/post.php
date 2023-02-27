<?php 
$_POST = json_decode(file_get_contents('php://input'), true);

if( $_POST ):

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

		$data = [
			'hospital' => $_POST['hospital'],
			'age' => $_POST['age'],
			'sex' => $_POST['sex'],
			'inclusion' => json_encode($_POST['inclusion']),
			'exclusion' => json_encode($_POST['exclusion']),
			'diagnosis' => json_encode($_POST['diagnosis']),
			'comorbidities' => json_encode($_POST['comorbidities']),
			'anthropometric_data' => json_encode($_POST['anthropometric_data']),
			'ecog_performance_status' => $_POST['ecog_performance_status'],
			'glim_criteria' => json_encode($_POST['glim_criteria']),
			'oral_nutritional_supplementation' => json_encode($_POST['oral_nutritional_supplementation']),
			'referral_to_nutrition_service' => json_encode($_POST['referral_to_nutrition_service']),
			'questionnaire' => json_encode($_POST['questionnaire'])
		];

		$sql = "INSERT INTO pacientes (
			hospital, 
			age, 
			sex,
			inclusion,
			exclusion,
			diagnosis,
			comorbidities,
			anthropometric_data,
			ecog_performance_status,
			glim_criteria,
			oral_nutritional_supplementation,
			referral_to_nutrition_service,
			questionnaire
		) VALUES (
			:hospital, 
			:age, 
			:sex,
			:inclusion,
			:exclusion,
			:diagnosis,
			:comorbidities,
			:anthropometric_data,
			:ecog_performance_status,
			:glim_criteria,
			:oral_nutritional_supplementation,
			:referral_to_nutrition_service,
			:questionnaire
		)";

		$stmt = $pdo->prepare($sql);
		$stmt->execute($data);

		echo json_encode(['status' => 200]);

	} catch(PDOException $e) {
		// echo 'Connection error: ' . $e->getMessage();
		echo json_encode(['status' => 0]);
	}

	$pdo = null;

endif;