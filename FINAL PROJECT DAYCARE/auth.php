<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // For local testing; remove in production
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$usersFile = 'users.json';
$enrollmentsFile = 'enrollments.json';

// Load users
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

// Load enrollments
$enrollments = file_exists($enrollmentsFile) ? json_decode(file_get_contents($enrollmentsFile), true) : [];

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

switch ($action) {
    case 'register':
        $username = $data['username'];
        $password = $data['password'];
        if (isset($users[$username])) {
            echo json_encode(['success' => false, 'message' => 'Username already exists!']);
        } else {
            $users[$username] = password_hash($password, PASSWORD_DEFAULT);
            file_put_contents($usersFile, json_encode($users));
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);
        }
        break;

    case 'login':
        $username = $data['username'];
        $password = $data['password'];
        if (isset($users[$username]) && password_verify($password, $users[$username])) {
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password!']);
        }
        break;

    case 'enroll':
        $enrollment = [
            'parentName' => $data['parentName'],
            'parentEmail' => $data['parentEmail'],
            'childName' => $data['childName'],
            'childAge' => $data['childAge'],
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $enrollments[] = $enrollment;
        file_put_contents($enrollmentsFile, json_encode($enrollments));
        echo json_encode(['success' => true, 'message' => 'Thank you for your interest! We\'ll contact you soon.']);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
?>