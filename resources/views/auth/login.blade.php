@extends('layout')

@section('content')
<div class="container" >
            <br>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_login') ? ' has-error' : '' }}">
                            <label for="user_login" class="col-md-4 control-label">Логин</label>

                            <div class="col-md-6">
                                <input id="user_login" type="text" class="form-control" name="user_login" value="{{ old('user_login') }}" required autofocus>

                                @if ($errors->has('user_login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    Вход
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
