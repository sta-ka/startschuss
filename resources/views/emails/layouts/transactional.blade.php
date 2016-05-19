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
                <tr>
                    <td>
                        <table cellpadding="10" cellspacing="0" align="center">

                            @include('emails.partials.logo')

                            <tr>
                                <td width="580" align="center" style="line-height:24px;text-decoration:underline;">
                                    <h1>@yield('heading')</h1>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" style="line-height: 21px;">
                                    <font color="#999999" face="Arial, Helvetica, sans-serif" size="3" style="font-size:16px;line-height:26px;color:rgb(153,153,153);font-weight:normal;text-decoration: none;">@yield('content')</font>
                                </td>
                            </tr>

                            <tr bgcolor="#fff">
                                <td height="20"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table bgcolor="#a0cd66" border="0" cellpadding="0" cellspacing="0" width="210" align="center">
                            <tbody>
                            <tr>
                                <td colspan="3" height="10">
                                    <img height="4" src="https://us-absolventa-production.s3.amazonaws.com/mailing-templates/trans.gif" style="display: block;" vspace="0" width="1">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle">
                                    <a href="@yield('link')" style="color:#f3f3f3;font-weight:normal;text-decoration:none;" target="_blank"><font face="Arial, Helvetica, sans-serif" size="3" style="font-size:18px;line-height:18px;color:#fff;font-weight:normal;text-decoration:none;"><b>@yield('button')</b></font></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" height="10">
                                    <img height="10" src="https://us-absolventa-production.s3.amazonaws.com/mailing-templates/trans.gif" style="display: block;" vspace="0" width="1">
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