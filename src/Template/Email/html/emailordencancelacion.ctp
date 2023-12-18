<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <style>

    /*FUENTES*/

    @font-face {
        font-family: 'Myriad Pro Regular';
        font-style: normal;
        font-weight: normal;
        src: url('https://drgb.inia.gob.pe/modulos/es/css/fonts/myriad/MYRIADPRO-REGULAR.woff') format('woff');
    }
    @font-face {
        font-family: 'Myriad Pro Bold';
        font-style: normal;
        font-weight: normal;
        src: url('https://drgb.inia.gob.pe/modulos/es/css/fonts/myriad/MYRIADPRO-BOLD.woff') format('woff');
    }

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Myriad Pro Regular' !important;
            font-size: 15px !important
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        *[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* What it does: A work-around for Gmail meddling in triggered links. */
        .x-gmail-data-detectors,
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /*CUSTOM CSS*/

        .fuente {
            font-family: 'Myriad Pro Bold';
            letter-spacing: 3px;
            line-height: 30px;
        }
        .table-product {
            font-family: 'Myriad Pro Regular';
            text-align: center;
            border: 1px solid #ddd;
        }
        .table-product thead tr th {
            padding: 13px 15px;
            font-size: 14px;
            border-right: 1px solid #ddd;
        }
        .table-product tbody tr td {
            padding: 17px 15px;
            font-size: 14px;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        .undertable {
            font-size:12px
        }

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <style>

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        @media screen and (max-width: 768px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }


            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }

            .stack-column-center {
                text-align: center !important;
            }

            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
            .boxproduct {
                width: 768px;
            }
            .td-product {
                overflow-x: scroll;
            }
            .table-wrapper {
                width: 90%;
            }
            .td-footer {
                border: none !important;
                padding: 0 !important
            }
        }

    </style>

</head>
<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #fff; text-align: left;">

        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div>

        <table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="margin: auto;" class="email-container">
            <tr style="background: rgb(42, 121, 79)">
                <td style="padding: 0; text-align: center; background: #2A794F​">
                    <img src="https://drgb.inia.gob.pe/modulos/es/img/logofooter.png" aria-hidden="true" width="200" height="50" alt="alt_text" border="0" style="height: auto; font-size: 15px; line-height: 20px; color: #555555;">
                </td>
            </tr>
        </table>

        <table class="table-wrapper" role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="768" style="margin: auto;" class="email-container">

            <tr>
                <td bgcolor="#ffffff" style="padding: 87px 40px 40px 40px; text-align: center; font-size: 15px; line-height: 20px; color: #555555;">
                    <p style="    margin-bottom: 50px;font-size: 1.2em;color: #ffffff;background: #2a794f;padding: 20px 17px;border-radius: 10px;line-height: 22px;letter-spacing: 0px;">"Gracias por usar el sistema de Información de Recursos Genéticos (SIRGE-INIA) para realizar su pedido. Un representante del INIA se estará comunicando con usted en breve para coordinar mayores detalles respecto a su pedido."</p>
                    <h1 class="fuente" style="font-size:30px">RESUMEN DE PEDIDO</h1>
                    <h3 class="fuente" style="font-size:21px;letter-spacing:2px;margin-bottom:5px;margin-top:30px">SR. <?php echo mb_strtoupper($name, 'UTF-8') ?></h3>
                </td>
            </tr>

            <tr>
                <td class="td-product" valign="middle" style="text-align: center">
                    <p>Su pedido fue cancelado</p>
                    <p><?php echo $detalle ?></p>
                    <p class="undertable">Los datos personales recogidos, se utilizarán exclusivamente para efectos de cotización</p>
                </td>
            </tr>
            <tr height="50px"></tr>

        </table>

        <table role="presentation" aria-hidden="true" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="margin: auto;" class="email-container">
            <tr style="background:rgb(63, 63, 63)">
                <td style="padding: 15px 0;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="stack-column-center td-footer" style="padding: 5px 20px;border-right: 1px solid #5f5f5f;">
                                        <img src="https://drgb.inia.gob.pe/modulos/es/img/logofooter.png" aria-hidden="true" width="200" height="50" alt="alt_text" border="0" style="height: auto; font-size: 15px; line-height: 20px; color: #555555;">
                                    </td>
                                    <td class="stack-column-center td-footer" style="color:#fff;padding: 5px 20px;text-align:left;font-size: 16px;font-style: italic;margin-bottom: 13px;">
                                        240-2100 / 240-2350 / 349-2600<br>informes@inia.gob.pe
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </td>
            </tr>
        </table>

    </center>
</body>
</html>