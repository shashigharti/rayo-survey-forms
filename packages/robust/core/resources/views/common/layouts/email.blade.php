<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" bgcolor="{{ config('rws.settings.email-template.header-background') }}">
            <table align="center" style="margin:auto; padding:0;" width="800" border="0" cellspacing="0"
                   cellpadding="0">
                <tr>
                    <td height="30" bgcolor="{{ config('rws.settings.email-template.header-logo') }}">&nbsp;</td>
                    <!--asset('assets/website/images/logo.png') -->
                </tr>
                <tr align="left">
                    <td colspan="2" bgcolor="{{ config('rws.settings.email-template.header-background') }}">
                        <img src=""
                             width="{{ config('rws.settings.email-template.header-width') }}"
                             height="{{ config('rws.settings.email-template.header-height') }}"/>
                    </td>
                </tr>
                <tr>
                    <td height="30" bgcolor="{{ config('rws.settings.email-template.header-background') }}">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table align="center" width="798" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="20"></td>
                </tr>
                <tr>
                    <td align="left">
                        @yield('content')
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
