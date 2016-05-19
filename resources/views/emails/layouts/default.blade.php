<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#f3f3f3">
    <tr>
        <td>

            <table cellpadding="0" cellspacing="0" width="600" align="center">
            </table>

            <table cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="600" align="center">

                @include('emails.partials.logo')

                <tr>
                    <td>
                        <table bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody>
                            <tr>
                                <td width="450">
                                    @yield('main_content')
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td height="70"></td>
                </tr>
            </table>

            @include('emails.partials.signature')

        <td>
    </tr>
    <tr bgcolor="#f3f3f3">
        <td height="150"></td>
    </tr>
</table>
</body>
</html>