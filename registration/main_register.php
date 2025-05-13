<?php 

ob_start();
// include 'registration.php';

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
    <div id="kon">
        <div class="container">
            <div class="header">
                <h1>Registration Portal</h1>
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number active">1</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">2</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">3</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">4</div>
                    </div>
                </div>
            </div>
            
            <div class="tab-container">
                <div class="tab-buttons">
                    <div class="tab-button active" id="registration-btn">Registration</div>
                    <div class="tab-button" id="login-btn">Login</div>
                </div>


                
                <div class="tab-content active" id="registration-tab">
                    <form id="registration-form" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="two-columns">
                                <div class="form-group">
                                    <label for="vorname">Vorname *:</label>
                                    <input name="vorname" type="text" id="vorname" required>
                                </div>
                                <div class="form-group">
                                    <label for="nachname">Nachname *:</label>
                                    <input name="nachname" type="text" id="nachname" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username *:</label>
                            <input name="username" type="text" id="username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-Mail Adresse *:</label>
                            <input name="email" type="email" id="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password *:</label>
                            <input name="password" type="password" id="password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefon">TelefonNummer (Optional):</label>
                            <input name="telefon" type="text" id="telefon">
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Addresse *:</label>
                            <input name="address" type="text" id="address" required>
                        </div>

                        <div class="form-group">
                            <label>Select your birth date:</label>
                            <input type="date" name="birth_date" accept=".pdf" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="two-columns">
                                <div class="form-group">
                                    <label for="plz">PLZ *:</label>
                                    <input name="plz" type="text" id="plz" required>
                                </div>
                                <div class="form-group">
                                    <label for="stadt">Stadt *:</label>
                                    <input name="stadt" type="text" id="stadt" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="land">Land (EU + Schweiz) *:</label>
                            <select id="land" name="land" required>
                                <option value="">Select a city</option>
                                <option value="germany">Germany</option>
                                <option value="austria">Austria</option>
                                <option value="switzerland">Switzerland</option>
                                <option value="france">France</option>
                                <option value="italy">Italy</option>
                            </select>
                        </div>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="newsletter1" name="newsletter1" required>
                            <label for="newsletter1">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten, Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
                        </div>
                        
                        <div class="checkbox-container">
                            <input type="checkbox" id="newsletter2" name="newsletter2" required>
                            <label for="newsletter2">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten, Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
                        </div>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="submit-button">Submit</button>
                        <div id="register-message"></div>
                    </form>
                </div>
                
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
                            <a href="#" class="forgot-link">Forgot Password?</a>
                            <button type="submit" name="submit" class="submit-button-login">Submit</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/main.js"></script>

   
   
</body>
</html>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const registrationBtn = document.getElementById('registration-btn');
    const loginBtn = document.getElementById('login-btn');
    const registrationTab = document.getElementById('registration-tab');
    const loginTab = document.getElementById('login-tab');
    
    registrationBtn.addEventListener('click', function() {
        // Switch to registration tab
        registrationBtn.classList.add('active');
        loginBtn.classList.remove('active');
        registrationTab.classList.add('active');
        loginTab.classList.remove('active');
    });
    
    loginBtn.addEventListener('click', function() {
        // Switch to login tab
        loginBtn.classList.add('active');
        registrationBtn.classList.remove('active');
        loginTab.classList.add('active');
        registrationTab.classList.remove('active');
    });
    
});


</script>

<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}
 
#kon {
    max-width: 1000px;
    margin: 10px auto;
    width: 100%;
}
 
#kon .container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-top: 10px;
    width: 100%;
}
 
#kon .header {
    text-align: center;
    margin-bottom: 20px;
}
 
#kon .header h1 {
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}
 
#kon .progress-steps {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
 
#kon .step {
    display: flex;
    justify-content: center;
    align-items: center;
}
 
#kon .step-number {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #f1f1f1;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    color: #333;
}
 
#kon .step-number.active {
    background-color: #0a6e83;
    color: white;
}
 
#kon .step-line {
    width: 40px;
    height: 2px;
    background-color: #ccc;
}
 
#kon .tab-container {
    width: 100%;
}
 
#kon .tab-buttons {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
}
 
#kon .tab-button {
    padding: 10px;
    cursor: pointer;
    background-color: #f1f1f1;
    border: none;
    outline: none;
    font-weight: bold;
    transition: 0.3s;
    width: 50%;
    text-align: center;
}
 
#kon .tab-button.active {
    background-color: #0a6e83;
    color: white;
}
 
#kon .tab-content {
    display: none;
    padding: 10px 0;
}
 
#kon .tab-content.active {
    display: block;
}
 
#kon .form-group {
    margin-bottom: 15px;
}
 
#kon .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 14px;
}
 
#kon .form-group input, .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}
 
#kon .two-columns {
    display: flex;
    gap: 10px;
    flex-direction: row;
}
 
#kon .two-columns .form-group {
    flex: 1;
}
 
#kon .checkbox-container {
    display: flex;
    align-items: flex-start;
    margin-bottom: 0px;
    gap: 10px;
}
 
#kon .checkbox-container input {
    margin-top: 3px;
    min-width: 16px;
    height: 16px;
}
 
#kon .checkbox-container label {
    font-size: 14px;
    line-height: 1.4;
}
 
#kon .submit-button {
    background-color: #0a6e83;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    float: right;
    margin-top: -20px !important;
}
#kon .submit-button-login {
    background-color: #0a6e83;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    float: right;
    margin-top: 10px ;
}
 
#kon .forgot-link {
    color: #0a6e83;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
    margin-top: 20px;
    margin-right: 10px;
}
 
#kon .forgot-link:hover {
    text-decoration: underline;
}
 
 
@media screen and (max-width: 768px) {
   
    #kon .container {
        padding: 15px;
    }
   
    #kon  .header h1 {
        font-size: 22px;
    }
   
    #kon .step-number {
        width: 30px;
        height: 30px;
        font-size: 14px;
    }
   
    #kon  .step-line {
        width: 30px;
    }
}
 
@media screen and (max-width: 576px) {
    #kon  .two-columns {
        flex-direction: column;
        gap: 0;
    }
   
    #kon   .checkbox-container {
        align-items: flex-start;
        margin-bottom: 20px;
    }
   
    #kon   .checkbox-container input {
        margin-top: 3px;
    }
   
    #kon  .tab-button {
        padding: 8px 5px;
        font-size: 14px;
    }
   
    #kon  .form-group label {
        font-size: 13px;
    }
   
    #kon  .submit-button {
        padding: 8px 16px;
        font-size: 14px;
        width: 100%;
        margin-top: 10px;
    }
 
    #kon   .submit-button-login{
        padding: 8px 16px;
        font-size: 14px;
        width: 100%;
        margin-top: -10px;
    }
   
    #kon   .forgot-link {
        float: none;
        display: block;
        text-align: center;
        margin-bottom: 15px;
    }
   
    #kon  .form-group[style="text-align: right;"] {
        text-align: center !important;
    }
}
 
</style>
