<html !DOCTYPE>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>print</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,600" rel="stylesheet" type="text/css">
    <style>
        html, body {
            background-color: #666;
            color: #111;
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
        }

        page[size="A4"] {
            width: 21cm;
        }

        @media screen {
            footer {
                display: none;
            }
        }

        @media print {
            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.5cm;
            }

            page[size="A4"] {
                width: 21cm;
                height: 29.7cm;
            }

            #footer {
                display: block;
                position: fixed;
                bottom: 0;
            }

            tbody {
                display: table-row-group;
            }

            thead {
                display: table-header-group;
                padding-bottom: 20px;
            }

            tfoot {
                display: table-row-group;
            }

            tr {
                padding: 20px 0;
            }
        }

        .user-name {
            float: left;
        }

        .print-date {
            float: right;
        }

        .print-info {
            padding: 0px 10px;
        }

        .clearfix:after {
            display: table;
            content: '';
            clear: both;
        }

        .print-panel {
            padding: 0px 10px;
            position: relative;
            display: block;
            orphans: 4;
            widows: 4;
            page-break-inside: always;
        }

        textarea {
            display: block;
            width: 100%;
            border: 1px solid #111;
            margin-top: 5px;
        }

        input[type="text"] {
            display: block;
            width: 100%;
            border-top: none;
            border-bottom: 1px solid #111;
            border-left: none;
            border-right: none;
            margin-top: 5px;
        }

        .block-text {
            display: block;
            width: 100%;
            margin: 10px 0px;
        }

        .row {
            margin: 0px 0 30px;
            page-break-inside: avoid;
        }

        input[type=radio] {
            clear: none;
            margin: 2px 5px 0 2px;
        }

        .checkbox-inline, .radio-inline {
            position: relative;
            display: inline-block;
            padding-right: 20px;
            margin: 20px 0;
            font-weight: 400;
            vertical-align: middle;
            cursor: pointer;
        }

        .print-textarea {
            height: 250px;
            padding: 0 10px;
        }

        .datefield {
            display: block;
            margin: 10px 0;
            width: 30%;
            padding: 5px;
        }

        input[type="email"] {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid #111;
            display: block;
            width: 100%;
        }

        input[type="number"] {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid #111;
            display: block;
            width: 100%;
        }

        footer {
            border-top: 2px solid #ccc;
            padding: 10px;
            margin: 0 10px;
            bottom: 0;
            display: block;
        }

        .bottom-right {
            color: #333;
            float: left;
            font-size: 10px;
            text-align: left;
        }

        .bottom-left {
            color: #6b4994;
            float: right;
            font-weight: 600;
            text-align: right;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
            display: none;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 10px;
            border: 1px solid #000;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        div.indent {
            padding-left: 30.8em
        }
    </style>
</head>
<body onLoad="window.print();">
    <page size="A4">
        <table class="print-container">
            <table border="0" width="100%">
                <thead style="width:100%">
                <tr>
                    <th class="print-heading">
                        <h1>COMPANY NAME</h1>
                    </th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td width="100%">
                        <table width="100%" border="0">
                            <tr>
                                <td colspan="4"><br>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tfoot>
                <tbody>
                @if(isset($template))
                    @include($template)
                @endif
                </tbody>
            </table>
            <table id="footer" width="100%">
                <tr>
                    <td width="100%">
                        <div class="bottom-right">Copyright 2016 © Robust IT Concepts Pvt. Ltd</div>
                        <div class="bottom-left indent">Rayoforms</div>
                    </td>
                </tr>
            </table>
        </table>
    </page>
</body>
</html>