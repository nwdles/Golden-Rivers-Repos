@extends('layout')

@section('content')
    <div class="container">

    <br>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <form method="post" >
            {{ csrf_field() }}
            <div class="form-group col-md-6">
                <label>Логин</label>
                <input type="text" name = "user_login" class="form-control" placeholder="Введите логин">
            </div>
            <div class="form-group col-md-6">
                <label>ФИО</label>
                <input type="text" name = "user_fullname" class="form-control" placeholder="Введите ФИО">
            </div>
            <div class="form-group col-md-6">
                <label>Пароль</label>
                <input type="password" name = "user_pass" class="form-control" placeholder="Введите пароль">
            </div>
            <div class="form-group col-md-6">
                <label >Повторите пароль</label>
                <input type="password" name = "user_pass_confirmation" class="form-control" placeholder="Введите пароль повторно">
            </div>
            <div class="form-group col-md-6">
                <label >Почта</label>
                <input type="email" name="user_email" class="form-control" placeholder="Введите почту">
            </div>
            <div class="form-group col-md-6">
                <label >Номер телефона</label>
                <input type="number" name="user_phone" class="form-control" placeholder="Введите номер телефона">
            </div>
            <div class="form-group col-md-6">
                <label >Пол</label>
                <br>
                <select name="user_sex" class="form-control form-control-sm">
                    <option selected value="true">Мужской</option>
                    <option value="false">Женский</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <input type="submit" class="btn btn-outline-success">
            </div>
        </form>
    </div>
@endsection
