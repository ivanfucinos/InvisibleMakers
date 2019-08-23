<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="width=device-width, initial-scale=1" name="viewport">

		<title>Performative mapping</title>

		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/mapping.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Performative Mapping</a>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div class="jumbotron" id="register">
			<div class="container">
				<br />
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Register!</h3>
					</div>
					<div class="panel-body">
                        <form method="POST" action="{{ route('register') }}" class="form-signin">
                        @csrf
						<div class="form-group">
                            <label for="verification">{{ __('Verification code') }}</label>
                            <input id="verification" type="text" class="form-control{{ $errors->has('verification') ? ' is-invalid' : '' }}" name="verification" value="{{ old('verification') }}" required autofocus>

                            @if ($errors->has('verification'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('verification') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                            @if ($errors->has('name'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>

                        <button type="submit" class="btn btn-lg btn-primary">
                            Create user
                        </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>