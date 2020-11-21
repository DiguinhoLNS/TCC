<!DOCTYPE html>
<html lang = "pt-br">

    <head>
    
        <meta charset = "UTF-8"/>
        <meta http-equiv = "Content-Language" content = "pt-br"/>
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>

        <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap"/>

        <style>

            * {
                box-sizing: border-box;
                float: left;

                font-family: 'Montserrat', Helvetica, sans-serif;
                font-style: normal;
                font-weight: 500;
            }

            html, body {
                width: 100%;
            }

            h1, h2, h3, h4 {
                width: 100%;
                padding: 0;
                margin: 0;
            }
        
            h1 {
                color: #6A50A7;
                font-size: 40px;
                text-align: center;
            }

            h2 {
                margin-bottom: 30px;
                color: #5F6368;
                font-size: 28px;
                text-align: center;
            }

            h3 {
                color: #202124;
                font-size: 22px;
                font-weight: bold;
                text-align: center;
            }

            .MailMessage {
                width: 800px;
                border: 2px solid #6A50A7;
                border-radius: 30px;
            }

            .MailContent {
                width: 100%;
                padding: 20px 40px;
            }

            #MailContentHeader {
                border-radius: 28px 28px 0 0;
            }
        
        </style>

    </head>

    <body class = "MailPage">

        <div class = "MailMessage">
        
            <div id = "MailContentHeader" class = "MailContent">
            
                <h1> APE </h1>

            </div>

            <div id = "MailContentMessage" class = "MailContent">

                <h2> Aqui está o código de verificação de segurança da sua conta APE </h2>
            
                <h3> <?=$cod?> </h3>

            </div>

        </div>

    </body>

</html>