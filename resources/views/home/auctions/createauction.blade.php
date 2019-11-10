@extends('layout')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">

            Создание аукциона
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Название выставки</label>
                <input type="text" name = "auction_name" class="form-control" placeholder="Введите название аукциона">
            </div>
            <div class="form-group">
                <label>Стоимость билета</label>
                <input type="text" name = "auction_cost_ticket" class="form-control" placeholder="Введите стоимость билета">
            </div>
            <div class="form-group">
                <label >Дата начала выставки</label>
                <input type="date" name="auction_date" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
            <div class="form-group">
                <label >Картинка для оформления</label>
                <input type="file" name="auction_full_img" class="form-control-file">
            </div>
            <div class="form-group">
                <label >Картинка для отображения на странице аукционов</label>
                <input type="file" name="auction_short_img" class="form-control-file" >
            </div>

            <input type="submit" class="btn btn-outline-success">
        </form>
    </div>
@endsection