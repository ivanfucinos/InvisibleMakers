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
		<div class="jumbotron">
			<div class="container-fluid">
                <form method="POST" action="{{ route('login') }}" class="form-signin">
                    @csrf
                    {{$errors->first(NULL, '<div class="alert alert-danger" role="alert">:message</div>')}}
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                    <br />
                    <p>
                        If you don't have an account, you can <a href="/register">register</a>
                    </p>
				</form>
			</div>
		</div>
	</body>
</html>