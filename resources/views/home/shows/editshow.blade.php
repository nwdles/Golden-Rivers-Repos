@extends('layout')

@section('content')
    <div class="container">
        @php
            $show = \App\Models\Show::find($id);
        @endphp
        <div class="alert alert-success" role="alert">

            Изменение данных выставки <b>"{{$show->show_name}}"</b>
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
                <input type="text" name = "show_name" class="form-control" value="{{$show->show_name}}">
            </div>
            <div class="form-group">
                <label>Стоимость билета</label>
                <input type="text" name = "show_cost_ticket" class="form-control" value="{{$show->show_cost_ticket}}">
            </div>
            <div class="form-group">
                <label >Дата начала выставки</label>
                <input type="date" name="show_date_from" max="3000-12-31" min="1000-01-01" class="form-control" value="{{$show->show_date_from}}">
            </div>
            <div class="form-group">
                <label >Дата окончания выставки</label>
                <input type="date" name="show_date_to" min="1000-01-01" max="3000-12-31" class="form-control" value="{{$show->show_date_to}}">
            </div>
            <div class="form-group">
                <label >Картинка для оформления</label>
                <input type="file" name="show_full_img" class="form-control-file">
            </div>
            <div class="form-group">
                <label >Картинка для отображения на странице выставок</label>
                <input type="file" name="show_short_img" class="form-control-file" >
            </div>

            <input type="submit" class="btn btn-outline-success" value="Сохранить">
        </form>
        <div class="text-right">
            <br>
            <form action="{{route('delete.show', $id)}}" method="post">
                {{ csrf_field() }}
                <input type="submit"
                       onclick="return confirm('Вы уверены, что хотите удалить выставку? Все предметы выставки также будут удалены.')"
                       class="btn btn-danger"
                       value="Удалить выставку">
            </form>
            <br>
            <br>
        </div>
    </div>
@endsection