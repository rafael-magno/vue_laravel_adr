<p>Dear {{ $user->name }},</p>
<p>Click on the button bellow to recover your password:</p>
<a href="{{ env('CLIENT_APP_URL') . '/auth/reset-password/' . $recoverHash }}">
  Recover password
</a>
