
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
	<head>
		<meta charset="utf-8"> <!-- utf-8 works for most cases -->
		<meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
	    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
		<title><?= $this->fetch('title') ?></title>

		<!-- CSS Reset -->
	    <style>

		    @font-face {
		        font-family: 'Myriad Pro Regular';
		        font-style: normal;
		        font-weight: normal;
		        src: url('css/fonts/myriad/MYRIADPRO-REGULAR.woff') format('woff');
		    }
		    @font-face {
		        font-family: 'Myriad Pro Bold';
		        font-style: normal;
		        font-weight: normal;
		        src: url('css/fonts/myriad/MYRIADPRO-BOLD.woff') format('woff');
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


	        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
	        /* Create one of these media queries for each additional viewport size you'd like to fix */
	        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
	        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
	            .email-container {
	                min-width: 375px !important;
	            }
	        }

	    </style>
	    <style>

	        /* What it does: Hover styles for buttons */
	        .button-td,
	        .button-a {
	            transition: all 100ms ease-in;
	        }
	        .button-td:hover,
	        .button-a:hover {
	            background: #555555 !important;
	            border-color: #555555 !important;
	        }


	        /* Media Queries */
	        @media screen and (max-width: 768px) {

	            .email-container {
	                width: 100% !important;
	                margin: auto !important;
	            }

	            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
	            .fluid {
	                max-width: 100% !important;
	                height: auto !important;
	                margin-left: auto !important;
	                margin-right: auto !important;
	            }

	            /* What it does: Forces table cells into full-width rows. */
	            .stack-column,
	            .stack-column-center {
	                display: block !important;
	                width: 100% !important;
	                max-width: 100% !important;
	                direction: ltr !important;
	            }
	            /* And center justify these ones. */
	            .stack-column-center {
	                text-align: center !important;
	            }

	            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
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
	    <?= $this->fetch('content') ?>
	</body>
</html>