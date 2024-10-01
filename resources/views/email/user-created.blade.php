<p>Hello {{ $user->name }},</p>
<p>Your account has been created. Here are your login details:</p>
<p><strong>Email:</strong> {{ $user->email }}</p>
<p><strong>Password:</strong> {{ $password }}</p>
<p>You can log in using the following URL: <a href="{{ url('login') }}">{{ url('login') }}</a></p>
<p>Thank you!</p>
