<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description">
    <title>RealEstate</title>
    <style>
        html {
            font-family: 'Roboto', sans-serif !important;
            font-weight: normal;
            line-height: 1.5;
            color: #6b6f82;
        }
    </style>
</head>

<body>
<table cellpadding="0" cellspacing="0" width="600" style="border:1px solid #111; margin:10px auto;">
    <tbody>
    <tr>
        <td style="text-align: center; background-color: #315C85; padding: 10px 15px;">
            <p>
            <p><a href="#">Welcome To *|COMPANY_NAME|*</a></p>
            </p>
        </td>
    </tr>
    <tr>
        <td style="border: none; border-bottom: 1px solid lightgrey;background-color: #F9F9F9;">
            @include('core::admin.email-templates.partials.' . $template)
        </td>
    </tr>

    <tr>
        <td style="padding:5px 20px;background-color:white;border-bottom:0px;">
            <p>*|LOGO|*</p>
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
