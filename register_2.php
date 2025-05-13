<?php
// Template Name: Complete Register
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Portal</title>
    <style>
        /*Global & Step 1*/
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

        #kon p {
            font-size: 14px;
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

        #kon .form-group input,
        .form-group select {
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

        #kon .checkbox-container input,
        #kon .checkbox-container label {
            cursor: pointer;
        }

        #kon .checkbox-container input {
            margin-top: 3px;
            min-width: 16px;
            height: 16px;
        }

        #kon .checkbox-container label {
            font-size: 14px;
            line-height: 1.8;
        }

        #kon .submit-button,
        #kon .next-button {
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

        #kon .prev-button {
            background-color: #0a6e83;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            float: left;
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
            margin-top: 10px;
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

        /*Step 2*/

        #kon .text {
            font-size: 14px;
            line-height: 1.4;
            text-align: center;
        }

        #kon .upload-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            padding: 20px;
            border: 1px solid #f2f2f2;
            max-width: 700px;
            margin: 30px auto;
            background-color: white;
            flex-wrap: wrap;
        }

        #kon .upload-icon-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #kon .upload-icon-section img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        #kon .upload-label {
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
            font-size: 14px;
        }

        #kon .upload-text-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #kon .upload-text-section p {
            margin: 0;
            font-size: 14px;
            text-align: center;
        }

        #kon .upload-input {
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 4px;
            font-size: 14px;
        }

        #kon .image-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            padding: 20px;
            border: 1px solid #f2f2f2;
            max-width: 300px;
            margin: 20px auto;
            background-color: white;
            flex-wrap: wrap;
        }

        #kon .image-box img {
            width: 150px;
            height: 150px;
            object-fit: contain;
        }

        #kon .tab-content .logout-div {
            text-align: center;
        }

        #kon .tab-content .logout-div .logout {
            font-size: 14px;
            color: #0A6E83;
        }

        /*Step 3*/
        #kon .container-heading {
            text-align: center;
        }

        #kon #upload-documents-form {
            padding-bottom: 10px;
        }

        /*Step 4*/
        #kon #choose-school-form {
            padding-bottom: 10px;
        }

        #kon .radio-container {
            margin: 10px 0;
        }

        #kon .radio-container input,
        #kon .radio-container label {
            cursor: pointer;
        }

        #kon #choose-school-form h4 {
            margin: 15px 0;
        }

        #kon #humanmedizin_selected,
        #kon #zahnmedizin_selected,
        #kon #beides_selected {
            display: none;
        }

        #kon #humanmedizin_selected.active,
        #kon #zahnmedizin_selected.active,
        #kon #beides_selected.active {
            display: block;
        }

        #kon .thank-you {
            text-align: center;
        }

        #kon #rp-step1,
        #kon #rp-step2,
        #kon #rp-step3,
        #kon #rp-step4,
        #kon #rp-step5,
        #kon #rp-step6 {
            display: none;
        }

        #kon #rp-step1.active,
        #kon #rp-step2.active,
        #kon #rp-step3.active,
        #kon #rp-step4.active,
        #kon #rp-step5.active,
        #kon #rp-step6.active {
            display: block;
        }

        /*Mobile Devices*/

        @media screen and (max-width: 768px) {

            #kon .container {
                padding: 15px;
            }

            #kon .header h1 {
                font-size: 22px;
            }

            #kon .step-number {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }

            #kon .step-line {
                width: 30px;
            }
        }

        @media screen and (max-width: 576px) {
            #kon .two-columns {
                flex-direction: column;
                gap: 0;
            }

            #kon .checkbox-container {
                align-items: flex-start;
                /* margin-bottom: 20px; */
            }

            #kon .checkbox-container input {
                margin-top: 3px;
            }

            #kon .tab-button {
                padding: 8px 5px;
                font-size: 14px;
            }

            #kon .form-group label {
                font-size: 13px;
            }

            #kon .submit-button {
                padding: 8px 16px;
                font-size: 14px;
                width: 100%;
                margin-top: 10px;
            }

            #kon .submit-button-login {
                padding: 8px 16px;
                font-size: 14px;
                width: 100%;
                margin-top: -10px;
            }

            #kon .forgot-link {
                float: none;
                display: block;
                text-align: center;
                margin-bottom: 15px;
            }

            #kon .form-group[style="text-align: right;"] {
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    <div id="kon">
        <!-- Step 1 -->
        <div class="container active" id="rp-step1">
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
                            <label>Select PDF file:</label>
                            <input type="file" name="pdf_file" accept=".pdf" required>
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
                            <label for="newsletter1">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten,
                                Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="newsletter2" name="newsletter2" required>
                            <label for="newsletter2">Ich bin damit Einverstanden, von MedCompass über Neuigkeiten,
                                Veranstaltungen und Änderungen rund um das Medizinstudium informiert zu werden.</label>
                        </div>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="submit-button" id="reg_submit">Submit</button>
                        <div id="register-message"></div>
                    </form>
                </div>

                <div class="tab-content" id="login-tab">
                    <form id="login-form" method="POST" action="">
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
                            <button type="submit" name="submit" class="submit-button-login"
                                id="login_submit">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Step 2 -->
        <div class="container" id="rp-step2">
            <div class="header">
                <h1>Registration Portal</h1>
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number">1</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number active">2</div>
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
                    <div class="tab-button active" id="dokumente-btn">Dokumente</div>
                    <div class="tab-button" id="profile-btn">Profile</div>
                </div>
                <div class="tab-content active" id="dokumente-tab">
                    <form id="dokumente-form" method="POST" enctype="multipart/form-data">

                        <p class="text">Bitte überprüfe deine E-Mail und lade die unterschriebene Vollmacht hoch, um mit
                            der Bewerbung fortzufahren.</p>
                        <div class="upload-container">
                            <div class="upload-icon-section">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/file-upload.png' ?>"
                                    alt="Upload Icon">
                                <p class="upload-label">Vollmacht</p>
                            </div>
                            <div class="upload-text-section">
                                <p><strong>Lade jetzt dein Dokument hoch (PDF-Format)</strong></p>
                                <input type="file" accept=".pdf" class="upload-input">
                            </div>
                        </div>
                        <br><br>
                        <button type="button" name="next" class="prev-button">Zuruck</button>
                        <button type="button" name="next" class="next-button">Weiter</button>
                    </form>
                </div>

                <div class="tab-content" id="profile-tab">
                    <form id="profile-form" method="POST" action="">
                        <div class="image-box">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/user.png' ?>" alt="User">
                        </div>
                        <div class="logout-div">
                            <a href="logout" class="logout">Logout</a>
                        </div>

                        <div class="form-group">
                            <label for="profile_name">Name</label>
                            <input name="profile_name" type="text" placeholder="Jahbulonn" id="profile_name" required>
                        </div>
                        <div class="form-group">
                            <label for="user_email">E-mail:</label>
                            <input name="user_email" placeholder="example@gmail.com" type="email" id="user-email"
                                required>
                        </div>
                        <br><br>
                        <button type="button" name="next" class="prev-button">Zuruck</button>
                        <button type="button" name="next" class="next-button">Weiter</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Step 3 -->
        <div class="container" id="rp-step3">
            <div class="header">
                <h1>Registration Portal</h1>
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number">1</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">2</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number active">3</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">4</div>
                    </div>
                </div>
            </div>

            <div class="tab-container">
                <h2 class="container-heading">Persönliche Dokumente</h2> <br>
                <form id="upload-documents-form" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Reisepass hochladen•: IPDF, JPEG Oder PNG</label>
                        <input type="file" name="pdf_file1" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <label>Geburtsurkunde hochladen*: PDF-Format</label>
                        <input type="file" name="pdf_file2" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <label> Hochschulzeugnis hochladen (Matura, Abitur/Fachabitur, Schweizer Matura)*: PDF-Format
                        </label>
                        <input type="file" name="pdf_file3" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <label>Lebenslauf (optional): PDF-Format</label>
                        <input type="file" name="pdf_file4" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <label>Sonstiges (optional): Every kind of document</label>
                        <input type="file" name="pdf_file5" accept=".pdf" required>
                    </div>


                    <br><br>
                    <button type="button" name="next" class="prev-button">Zuruck</button>
                    <button type="button" name="next" class="next-button">Weiter</button>

                </form>

            </div>
        </div>
        <!-- Step 4 -->
        <div class="container" id="rp-step4">
            <div class="header">
                <h1>Registration Portal</h1>
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number">1</div>
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
                        <div class="step-number active">4</div>
                    </div>
                </div>
            </div>

            <div class="tab-container">

                <form id="choose-school-form" method="POST" enctype="multipart/form-data">
                    <h4> Was möchtest du studieren?</h4>
                    <div class="choose-department">
                        <div class="radio-container">
                            <input type="radio" id="humanmedizin" name="chosen_school" value="Humanmedizin" checked>
                            <label for="humanmedizin" class="radio-label">Humanmedizin</label>
                        </div>

                        <div class="radio-container">
                            <input type="radio" id="zahnmedizin" name="chosen_school" value="Zahnmedizin">
                            <label for="zahnmedizin" class="radio-label">Zahnmedizin</label>
                        </div>

                        <div class="radio-container">
                            <input type="radio" id="beides" name="chosen_school" value="Beides">
                            <label for="beides" class="radio-label">Beides</label>
                        </div>

                    </div>
                    <h4 class="mocktest-question"> Wo möchtest du studieren?</h4>
                    <div class="choose-school active" id="humanmedizin_selected">
                        <div class="checkbox-container">
                            <input type="checkbox" id="comenius_university" name="comenius_university" required>
                            <label for="comenius_university">Comenius Universität – Bratislava, Slowakei(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="jessenius_university" name="jessenius_university">
                            <label for="jessenius_university">Jessenius Universität – Martin, Slowakei(H)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="karlsuniversitat_prag" name="karlsuniversitat_prag">
                            <label for="karlsuniversitat_prag">Karlsuniversität Prag – Prag, Tschechien(H)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="semmelweis_university" name="semmelweis_university">
                            <label for="semmelweis_university">Semmelweis Universität – Budapest, Ungarn(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pecs_university" name="pecs_university">
                            <label for="pecs_university">University of Pécs – Pécs, Ungarn(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="humanitas_university" name="humanitas_university">
                            <label for="humanitas_university">Humanitas Universität – Mailand, Italien(H)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="split_university" name="split_university">
                            <label for="split_university">University of Split – Split, Kroatien(H)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pomeranian_university" name="pomeranian_university">
                            <label for="pomeranian_university">Pomeranian University – Szczecin, Polen(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="frycz_university" name="frycz_university">
                            <label for="frycz_university">Andrzej Frycz Modrzewski Universität – Krakau,
                                Polen(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="victor_babes_university" name="victor_babes_university">
                            <label for="victor_babes_university">Victor Babes Universität – Timișoara,
                                Rumänien(H)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="cluj_napoca_university" name="cluj_napoca_university">
                            <label for="cluj_napoca_university">Cluj Napoca Universität – Cluj-Napoca,
                                Rumänien(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="carol_davila_university" name="carol_davila_university">
                            <label for="carol_davila_university">Carol Davila Universität – Bukarest,
                                Rumänien(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="varna_university" name="varna_university">
                            <label for="varna_university">University of Varna – Varna, Bulgarien(H,Z)</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="stradins_university" name="stradins_university">
                            <label for="stradins_university">Stradins Universität – Riga, Lettland(H,Z)</label>
                        </div>

                    </div>
                    <div class="choose-school" id="zahnmedizin_selected">
                        <div class="checkbox-container">
                            <input type="checkbox" id="comenius_university" name="comenius_university" required>
                            <label for="comenius_university">Comenius Universität – Bratislava, Slowakei</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="semmelweis_university" name="semmelweis_university">
                            <label for="semmelweis_university">Semmelweis Universität – Budapest, Ungarn</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pecs_university" name="pecs_university">
                            <label for="pecs_university">University of Pécs – Pécs, Ungarn</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pomeranian_university" name="pomeranian_university">
                            <label for="pomeranian_university">Pomeranian University – Szczecin, Polen</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="frycz_university" name="frycz_university">
                            <label for="frycz_university">Andrzej Frycz Modrzewski Universität – Krakau, Polen</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="cluj_napoca_university" name="cluj_napoca_university">
                            <label for="cluj_napoca_university">Cluj Napoca Universität – Cluj-Napoca, Rumänien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="carol_davila_university" name="carol_davila_university">
                            <label for="carol_davila_university">Carol Davila Universität – Bukarest, Rumänien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="varna_university" name="varna_university">
                            <label for="varna_university">University of Varna – Varna, Bulgarien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="stradins_university" name="stradins_university">
                            <label for="stradins_university">Stradins Universität – Riga, Lettland</label>
                        </div>

                    </div>
                    <div class="choose-school" id="beides_selected">
                        <div class="checkbox-container">
                            <input type="checkbox" id="comenius_university" name="comenius_university" required>
                            <label for="comenius_university">Comenius Universität – Bratislava, Slowakei</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="semmelweis_university" name="semmelweis_university">
                            <label for="semmelweis_university">Semmelweis Universität – Budapest, Ungarn</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pecs_university" name="pecs_university">
                            <label for="pecs_university">University of Pécs – Pécs, Ungarn</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="pomeranian_university" name="pomeranian_university">
                            <label for="pomeranian_university">Pomeranian University – Szczecin, Polen</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="frycz_university" name="frycz_university">
                            <label for="frycz_university">Andrzej Frycz Modrzewski Universität – Krakau, Polen</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="cluj_napoca_university" name="cluj_napoca_university">
                            <label for="cluj_napoca_university">Cluj Napoca Universität – Cluj-Napoca, Rumänien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="carol_davila_university" name="carol_davila_university">
                            <label for="carol_davila_university">Carol Davila Universität – Bukarest, Rumänien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="varna_university" name="varna_university">
                            <label for="varna_university">University of Varna – Varna, Bulgarien</label>
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" id="stradins_university" name="stradins_university">
                            <label for="stradins_university">Stradins Universität – Riga, Lettland</label>
                        </div>

                    </div>
                    <h4 class="mocktest-question"> Du möchtest dich an mehr als 3 Unis bewerben?</h4>
                    <div class="checkbox-container">
                        <input type="checkbox" id="ja_mehr" name="ja_mehr" required>
                        <label for="ja_mehr"> Ja, mehr Infos bei dieser Auswahl findest du in den AGB*. Falls Sie eine
                            Universität gewählt haben, die beide Studiengänge anbietet, geben Sie bitte im Kommentarfeld
                            an, welchen Studiengang Sie an welcher Universität genau studieren möchten.
                        </label>

                    </div>
                    <div>
                        <textarea style="border-color: #0a6e82;" rows="5" col="5">

                    </textarea>
                    </div>
                    <br><br>
                    <button type="button" name="next" class="prev-button">Zuruck</button>
                    <button type="button" name="next" class="next-button">Weiter</button>

                </form>

            </div>
        </div>
        <!--  Confirmation -->
        <div class="container" id="rp-step5">
            <div class="header">
                <h1>Registration Portal</h1>
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number">1</div>
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
                        <div class="step-number active">4</div>
                    </div>
                </div>
            </div>

            <div class="tab-container">

                <form id="choose-school-form" method="POST" enctype="multipart/form-data">
                    <h2>Bewerbung abschließen</h2>
                    <h4> Fertig? Klicke unten, um deine Bewerbung abzuschließen. </h4> <br>

                    <button type="button" name="next" class="prev-button">Zuruck</button>
                    <button type="button" name="next" class="next-button">Jetzt abschicken</button>

                </form>

            </div>
        </div>
        <!-- Thank you -->
        <div class="container" id="rp-step6">
            <div class="thank-you">
                <h2>Vielen Dank!</h2>
                <div class="image-box">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/complete.png' ?>" alt="User">
                </div>
                <p> Wir haben deine Unterlagen erfolgreich erhalten
                    und melden uns in Kürze bei dir!
                    Dein Traumstudium zum zukünftigen <b>"Doctor to be"</b>
                    ist jetzt zum Greifen nah - gemeinsam bringen wir dich ans Ziel!
                </p><br>
                <p> - Dein MedCompass Team</p>
            </div>

        </div>
    </div>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all steps
        const steps = document.querySelectorAll('.container');

        // Hide all steps except the first one initially
        steps.forEach((step, index) => {
            if (index !== 0) {
                step.classList.remove('active');
            }
        });

        //step 1:
        const registrationBtn = document.getElementById('registration-btn');
        const loginBtn = document.getElementById('login-btn');
        const registrationTab = document.getElementById('registration-tab');
        const loginTab = document.getElementById('login-tab');

        registrationBtn.addEventListener('click', function () {
            // Switch to registration tab
            registrationBtn.classList.add('active');
            loginBtn.classList.remove('active');
            registrationTab.classList.add('active');
            loginTab.classList.remove('active');
        });

        loginBtn.addEventListener('click', function () {
            // Switch to login tab
            loginBtn.classList.add('active');
            registrationBtn.classList.remove('active');
            loginTab.classList.add('active');
            registrationTab.classList.remove('active');
        });

        //Step 2
        const profileBtn = document.getElementById('profile-btn');
        const dokumenteBtn = document.getElementById('dokumente-btn');
        const profileTab = document.getElementById('profile-tab');
        const dokumenteTab = document.getElementById('dokumente-tab');

        dokumenteBtn.addEventListener('click', function () {
            //switch to dokumente tab
            dokumenteBtn.classList.add('active');
            profileBtn.classList.remove('active');
            dokumenteTab.classList.add('active');
            profileTab.classList.remove('active');
        });

        profileBtn.addEventListener('click', function () {
            //switch to profile tab
            profileBtn.classList.add('active');
            dokumenteBtn.classList.remove('active');
            profileTab.classList.add('active');
            dokumenteTab.classList.remove('active');
        });

        //step 4
        const optionHuman = document.getElementById('humanmedizin');
        const optionZahn = document.getElementById('zahnmedizin');
        const optionBeides = document.getElementById('beides');
        const schoolHuman = document.getElementById('humanmedizin_selected');
        const schoolZahn = document.getElementById('zahnmedizin_selected');
        const schoolBeides = document.getElementById('beides_selected');

        // Hide all school sections initially except humanmedizin
        schoolZahn.classList.remove('active');
        schoolBeides.classList.remove('active');
        schoolHuman.classList.add('active');

        // Add event listeners for all radio buttons
        document.querySelectorAll('input[name="chosen_school"]').forEach(radio => {
            radio.addEventListener('change', function () {
                // Hide all school sections
                schoolHuman.classList.remove('active');
                schoolZahn.classList.remove('active');
                schoolBeides.classList.remove('active');

                // Show the selected section
                if (this.value === 'Humanmedizin') {
                    schoolHuman.classList.add('active');
                } else if (this.value === 'Zahnmedizin') {
                    schoolZahn.classList.add('active');
                } else if (this.value === 'Beides') {
                    schoolBeides.classList.add('active');
                }
            });
        });

        // Handle form submissions
        const registrationForm = document.getElementById('registration-form');
        const loginForm = document.getElementById('login-form');

        if (registrationForm) {
            registrationForm.addEventListener('submit', function (e) {
                e.preventDefault();
                // Hide step 1 and show step 2
                document.getElementById('rp-step1').classList.remove('active');
                document.getElementById('rp-step2').classList.add('active');
            });
        }

        if (loginForm) {
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault();
                // Hide step 1 and show step 2
                document.getElementById('rp-step1').classList.remove('active');
                document.getElementById('rp-step2').classList.add('active');
            });
        }

        // Handle next buttons
        const nextButtons = document.querySelectorAll('.next-button');
        nextButtons.forEach(button => {
            button.addEventListener('click', function () {
                const currentStep = this.closest('.container');
                const currentStepNumber = parseInt(currentStep.id.replace('rp-step', ''));
                const nextStepNumber = currentStepNumber + 1;

                // Hide current step
                currentStep.classList.remove('active');
                // Show next step
                document.getElementById(`rp-step${nextStepNumber}`).classList.add('active');
            });
        });

        // Handle previous buttons
        const prevButtons = document.querySelectorAll('.prev-button');
        prevButtons.forEach(button => {
            button.addEventListener('click', function () {
                const currentStep = this.closest('.container');
                const currentStepNumber = parseInt(currentStep.id.replace('rp-step', ''));
                const prevStepNumber = currentStepNumber - 1;

                // Hide current step
                currentStep.classList.remove('active');
                // Show previous step
                document.getElementById(`rp-step${prevStepNumber}`).classList.add('active');
            });
        });
    });

</script>