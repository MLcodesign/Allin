<?php /*我們收到您的密碼重置申請，請點選以下連結進行密碼重置，謝謝！
[密碼重置連結] <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>{{ $link }}</a> */ ?>

<html>
<body>
<table>
<tr>
<td>帳號 : </td>
<td>{{ $email }}</td>
</tr>
<tr>
<td>密碼 : </td>
<td>{{ $password }}</td>
</tr> 
</body>
