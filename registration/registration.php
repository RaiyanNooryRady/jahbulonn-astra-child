<?php
$errors = [];
$success = "";
$submittedData = [];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $vorname  = trim($_POST["vorname"] ?? "");
    $nachname  = trim($_POST["nachname"] ?? "");
    $username  = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password  = trim($_POST["password"] ?? "");
    $telefon  = trim($_POST["telefon"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $plz  = trim($_POST["plz"] ?? "");
    $stadt = trim($_POST["stadt"] ?? "");
    $land = trim($_POST["land"] ?? "");

    // Validate
    if (empty($vorname)) $errors[] = "Vorname is required.";
    if (empty($nachname)) $errors[] = "Nachname is required.";
    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($plz)) $errors[] = "PLZ is required.";
    if (empty($stadt)) $errors[] = "Stadt is required.";
    if (empty($land)) $errors[] = "Land is required.";

    // Handle PDF upload
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0) {
        $file = $_FILES['pdf_file'];
    
        // Only allow PDFs
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($file_ext !== 'pdf') {
            $errors[] = "Only PDF files are allowed.";
        } else {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
    
            // Let WordPress handle the upload
            $upload_overrides = ['test_form' => false];
            $uploaded_file = wp_handle_upload($file, $upload_overrides);
    
            if (isset($uploaded_file['url'])) {
                $file_url = $uploaded_file['url']; // you can save this in DB
                // success message or process
            } else {
                $errors[] = "File upload failed.";
            }
        }
    } else {
        $errors[] = "PDF file is required.";
    }
    

    if (empty($errors)) {
        $success = "Registration successful! Here’s your submitted data:";
        $submittedData = [
            "Vorname"   => $vorname,
            "Nachname"  => $nachname,
            "Username"  => $username,
            "E-Mail"    => $email,
            "Telefon"   => $telefon ?: "Not provided",
            "Adresse"   => $address,
            "PLZ"       => $plz,
            "Stadt"     => $stadt,
            "Land"      => ucfirst($land),
            "Newsletter Zustimmung" => "Yes"
        ];
    }
}
?>
