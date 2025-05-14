<?php
// Template Name: Complete Register
get_header('registration');
?>


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
                            <label>Select your birth date *:</label>
                            <input type="date" name="birth_date" required>
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
                        <button type="submit" name="reg_submit" class="submit-button" id="reg_submit">Submit</button>
                        <div id="register-message"></div>
                    </form>
                    <div id="register-message"></div>
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
                            <button type="submit" name="login_submit" class="submit-button-login"
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
</div>
<?php
get_footer('registration');
?>