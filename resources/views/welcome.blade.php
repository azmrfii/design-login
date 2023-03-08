<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('processlogin') }}" method="post">
        @csrf
        <label for="">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror  
        <br>
        <label for="">Password</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror 
        <br>
        <button type="submit">
            {{ __('Login') }}
        </button>
    </form>
</body>
</html>