<?php
/* template name: my template */

?>

<?php
$errors = [];
$success = "";
$submittedData = [];

// Handle Registration Form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $vorname = trim($_POST['vorname'] ?? '');
    $nachname = trim($_POST['nachname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $plz = trim($_POST['plz'] ?? '');
    $stadt = trim($_POST['stadt'] ?? '');
    $land = trim($_POST['land'] ?? '');
    $newsletter1 = isset($_POST['newsletter1']);
    $newsletter2 = isset($_POST['newsletter2']);

    // Validations
    if (empty($vorname)) $errors[] = "Vorname is required.";
    if (empty($nachname)) $errors[] = "Nachname is required.";
    if (empty($username)) $errors[] = "Username is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($plz)) $errors[] = "PLZ is required.";
    if (empty($stadt)) $errors[] = "Stadt is required.";
    if (empty($land)) $errors[] = "Land is required.";
    if (!$newsletter1 || !$newsletter2) $errors[] = "You must agree to both checkboxes.";

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Portal</title>
   <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php if (!empty($errors)): ?>
    <div style="color:red;">
        <ul>
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif ($success): ?>
    <div style="color:green;">
        <p><strong><?= htmlspecialchars($success) ?></strong></p>
        <ul>
            <?php foreach ($submittedData as $key => $value): ?>
                <li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" action="" id="registration-form">
            <input type="hidden" name="register" value="1" />

            <div class="form-row two-columns">
              <div class="form-group">
                <label for="vorname">Vorname *:</label>
                <input name="vorname" type="text" id="vorname" required />
              </div>
              <div class="form-group">
                <label for="nachname">Nachname *:</label>
                <input name="nachname" type="text" id="nachname" required />
              </div>
            </div>

            <div class="form-group">
              <label for="username">Username *:</label>
              <input name="username" type="text" id="username" required />
            </div>

            <div class="form-group">
              <label for="email">E-Mail Adresse *:</label>
              <input name="email" type="email" id="email" required />
            </div>

            <div class="form-group">
              <label for="password">Password *:</label>
              <input name="password" type="password" id="password" required />
            </div>

            <div class="form-group">
              <label for="telefon">TelefonNummer (Optional):</label>
              <input name="telefon" type="text" id="telefon" />
            </div>

            <div class="form-group">
              <label for="address">Addresse *:</label>
              <input name="address" type="text" id="address" required />
            </div>

            <div class="form-row two-columns">
              <div class="form-group">
                <label for="plz">PLZ *:</label>
                <input name="plz" type="text" id="plz" required />
              </div>
              <div class="form-group">
                <label for="stadt">Stadt *:</label>
                <input name="stadt" type="text" id="stadt" required />
              </div>
            </div>

            <div class="form-group">
              <label for="land">Land (EU + Schweiz) *:</label>
              <select id="land" name="land" required>
                <option value="">Select a country</option>
                <option value="germany">Germany</option>
                <option value="austria">Austria</option>
                <option value="switzerland">Switzerland</option>
                <option value="france">France</option>
                <option value="italy">Italy</option>
              </select>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="newsletter1" name="newsletter1" required />
              <label for="newsletter1">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten, Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="newsletter2" name="newsletter2" required />
              <label for="newsletter2">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten, Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
            </div>

            <button type="submit" class="submit-button">Submit</button>
          </form>

          <div class="tab-content" id="login-tab">
                    <form id="login-form" method="POST" action="login.php">
                        <div class="form-group">
                            <label for="login-username">Username / E-mail Adresse *:</label>
                            <input name="username" type="text" id="login-username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="login-password">Password *:</label>
                            <input name="password" type="password" id="login-password" required>
                        </div>
                        
                        <div class="form-group" style="text-align: right;">
                            <a href="#" class="forgot-link" style="float: left; margin-top: 10px;">Forgot Password?</a>
                            <button type="submit" class="submit-button">Submit</button>
                        </div>
                    </form>
                </div>
   <script src="assets/main.js"></script>
</body>
</html>