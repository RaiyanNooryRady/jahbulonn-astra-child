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
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>