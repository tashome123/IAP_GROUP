<?php
$lang["ver_reg_subj"] = "Account Activation on {{site_name}}";


$lang["ver_reg_body"] = "
Hello {{fullname}},
You have requested an account on <strong>{{site_name}}</strong>.
Your activation code is:
<h1>{{activation_code}}</h1>
Regards,
{{site_name}} Admin
{{site_name}}
";

$lang["pass_reset_subj"] = "Password Reset Request for {{site_name}}";
$lang["pass_reset_body"] = "
Hello {{fullname}},
<br><br>
We received a request to reset your password. If you did not make this request, you can safely ignore this email.
<br><br>
To reset your password, please click the link below:
<br>
<a href='{{reset_link}}'>Reset Your Password</a>
<br><br>
This link will expire in 1 hour.
<br><br>
Regards,
<br>
The {{site_name}} Team
";
