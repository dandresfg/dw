<?php

// Patient
function getPatientById($connection, $id) {
    $sql = 'SELECT * FROM patient WHERE id =:id';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return is_countable($result) ? $result : null;
}

function getActivePatient($connection) {
    $sql = 'SELECT * FROM patient WHERE active=1';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createPatient($connection, $patientData) {
    $sql = 'INSERT INTO patient (name, lastName, cedula, email, birth_date, direction, weight, height, study, medical_history, evaluated, active) VALUES(:name, :lastName, :cedula, :email, :birth_date, :direction, :weight, :height, :study, :medical_history, :evaluated, :active)';
    $active = 1;
    $evaluated = 0;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $patientData['name']);
    $stmt->bindParam(':lastName', $patientData['lastName']);
    $stmt->bindParam(':email', $patientData['email']);
    $stmt->bindParam(':cedula', $patientData['id']);
    $stmt->bindParam(':birth_date',  $patientData['date']);
    $stmt->bindParam(':direction',  $patientData['direction']);
    $stmt->bindParam(':weight', $patientData['weight']);
    $stmt->bindParam(':height', $patientData['height']);
    $stmt->bindParam(':active', $active);
    $stmt->bindParam(':evaluated', $evaluated);
    $stmt->bindParam(':study',  $patientData['type-exam']);
    $stmt->bindParam(':medical_history',  $patientData['description']);
    return $stmt->execute();
}

function updatePatientById($connection, $patient) {
    $sql = 'UPDATE patient SET name=:name, lastName=:lastName, cedula=:cedula, email=:email, birth_date=:birth_date,
    direction=:direction, weight=:weight, height=:height, study=:study, medical_history=:medical_history WHERE id=:id';

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':lastName', $_POST['lastName']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':cedula', $_POST['cedula']);
    $stmt->bindParam(':birth_date',  $_POST['date']);
    $stmt->bindParam(':direction',  $_POST['direction']);
    $stmt->bindParam(':weight', $_POST['weight']);
    $stmt->bindParam(':height', $_POST['height']);
    $stmt->bindParam(':study',  $_POST['type-exam']);
    $stmt->bindParam(':medical_history',  $_POST['description']);
    $stmt->bindParam(':id',  $_POST['id']);

    return $stmt->execute();
}

function updatePatientEvaluationById($connection, $id) {
    $sql = 'UPDATE patient SET evaluated=:evaluated WHERE id=:id';
    $evaluated = true;
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id',  $id);
    $stmt->bindParam(':evaluated', $evaluated);
    return $stmt->execute();
}

function deletePatientById($connection, $id) {
    $sql = 'UPDATE patient SET active=0 WHERE id =:id';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id',$_GET['id']);
    return $stmt->execute();
}

// User
function getUserById($connection, $id) {
    $sql = 'SELECT * FROM users WHERE id =:id';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUserByEmail($connection, $email) {
    $sql = 'SELECT * FROM users WHERE email =:email';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createUser($connection, $user) {
    
    $sql = 'INSERT INTO users (name, email, password, analyst) VALUES(:name, :email, :password, :analyst)';
    $stmt = $connection->prepare($sql);

    $isAnalyst = $user['rol'] === 'analyst' ? 1 : 0;
    $password = password_hash($user['password'], PASSWORD_BCRYPT);

    $stmt->bindParam(':name', $user['name']);
    $stmt->bindParam(':email', $user['email']);
    $stmt->bindParam(':password',  $password);
    $stmt->bindParam(':analyst',  $isAnalyst);

    return $stmt->execute();
}

// Analysis
function getAnalysisByPatientId($connection, $id) {
    $sql = 'SELECT * FROM analysis WHERE patient_id =:id';
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getAllAnalysis($connection) {
    $sql = 'SELECT  analysis.id, analysis.user_id, analysis.patient_id, users.id, users.name as userName, patient.id, patient.name as patientName, patient.lastName as patientLastName, patient.cedula FROM analysis  LEFT JOIN users ON (analysis.user_id = users.id) LEFT JOIN patient ON (analysis.patient_id = patient.id)';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertAnalysis($connection, $analysis) {
    $sql = 'INSERT INTO analysis (user_id, patient_id, red_cell, electrolytes, plateles, glucose, hemoglobine, leukocytes, proteinuria, observation) VALUES(:user_id, :patient_id, :red_cell, :electrolytes, :plateles, :glucose, :hemoglobine, :leukocytes, :proteinuria, :observation)';

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $analysis['user_id']);
    $stmt->bindParam(':patient_id', $analysis['id']);
    $stmt->bindParam(':red_cell', $analysis['red_cell']);
    $stmt->bindParam(':electrolytes', $analysis['electrolytes']);
    $stmt->bindParam(':plateles', $analysis['plateles']);
    $stmt->bindParam(':glucose',  $analysis['glucose']);
    $stmt->bindParam(':hemoglobine',  $analysis['hemoglobine']);
    $stmt->bindParam(':leukocytes',  $analysis['leukocytes']);
    $stmt->bindParam(':proteinuria',  $analysis['proteinuria']);
    $stmt->bindParam(':observation',  $analysis['observation']);

    return $stmt->execute();
}



?>