@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <nav class="my-2 my-md-0 mr-md-3">

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" onclick="location.href='#'" class="btn btn-secondary">Персональные данные</button>
                    <button type="button" onclick="location.href='#'" class="btn btn-secondary">Мои выставки</button>
                    <button type="button" onclick="location.href='#'" class="btn btn-secondary">Мои аукционы</button>
                    <button type="button" onclick="location.href='#'"class="btn btn-secondary">Мои билеты</button>
                </div>
            </nav>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        {{$data['payload']['user_login']}}
        <br>
        {{$data['payload']['user_email']}}
        <br>
        {{$data['payload']['user_phone']}}
        <br>
        {{$data['payload']['user_fullname']}}
        <br>
        {{$data['payload']['user_sex']}}
        <br>
        {{$data['payload']['user_status']}}

    </div>
@endsection