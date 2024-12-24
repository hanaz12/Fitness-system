<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="{{url('css/signup.css')}}">

</head>
<body>
    <div class="body-signup">
    <form method="POST" action="{{ route('trainee.store') }}">
        @csrf
        <fieldset >
            <legend>sign up</legend>
        <div class="personal-info">
            <div>
                <input type="text" class="f-name" placeholder="     First-Name" name="first_name" value="{{ old('first_name') }}" required>
                @if ($errors->has('first_name'))
                    <div class="error">{{ $errors->first('first_name') }}</div>
                @endif
            </div><br>
            <div>
                <input type="text" class="l-name" placeholder="     Last-Name" name="last_name"  value="{{ old('last_name') }}" required>
                @if ($errors->has('last_name'))
                    <div class="error">{{ $errors->first('last_name') }}</div>
                @endif
            </div><br>
            <div>
                <input type="text" class="address-2" name="address" placeholder="      Address" value="{{ old('address') }}" required>
                @if ($errors->has('address'))
                    <div class="error">{{ $errors->first('address') }}</div>
                @endif
            </div><br>

            <div>
                <input type="text" class="user_name-2" name="user_name" placeholder="      Username" value="{{ old('user_name') }}" required>
                @if ($errors->has('user_name'))
                    <div class="error">{{ $errors->first('user_name') }}</div>
                @endif
            </div><br>
            <div>
                <input type="email" class="email" name="email" placeholder="      E-mail" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div><br>
            <div>
                <input type="password" class="pass-2" name="password" placeholder="       Password" required>
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div><br>
            <div>
                <input type="text" class="phone" name="phone" placeholder="       Phone" value="{{ old('phone') }}" required>
                @if ($errors->has('phone'))
                    <div class="error">{{ $errors->first('phone') }}</div>
                @endif
            </div><br>
            <div class="gender">
                <input type="radio" value="male" id="male" name="gender" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                <label class="male" for="male">Male</label><br>
                <input type="radio" value="female" id="female" name="gender" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                <label  class="female" for="female">Female</label><br>
                @if ($errors->has('gender'))
                    <div class="error">{{ $errors->first('gender') }}</div>
                @endif
            </div>
        </div>

        <div class="health-info">
            <div class="div-age">
                <input type="number" class="age" name="age" placeholder="       Age" value="{{ old('age') }}" required>
                @if ($errors->has('age'))
                    <div class="error">{{ $errors->first('age') }}</div>
                @endif

            </div><br>
            <div class="div-weight">
                <input type="number" class="weight" name="weight" placeholder="       Weight" value="{{ old('weight') }}" required>
                @if ($errors->has('weight'))
                    <div class="error">{{ $errors->first('weight') }}</div>
                @endif
            </div><br>
            <div class="div-height">
                <input type="number" class="height" name="height" placeholder="       Height" value="{{ old('height') }}" required>
                @if ($errors->has('height'))
                    <div class="error">{{ $errors->first('height') }}</div>
                @endif
            </div><br>
            <div class="health">
                <textarea class="textarea" name="medical-info" placeholder="   Medical history" rows="10" cols="20">{{ old('medical-info') }}</textarea>
                @if ($errors->has('medical-info'))
                    <div class="error">{{ $errors->first('medical-info') }}</div>
                @endif

            </div>
            <div class="div-goal">
                <textarea name="Goal" id="goal"placeholder="   Goal" rows="10" cols="20"></textarea>
            </div>
            <div class="btn2">
                <button type="submit"> SIGN UP</button>
            </div>
        </div>


    </fieldset>
    </form>
</body>
</html>
