@extends('layout')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            @php
                $show = \App\Models\Show::find($id);
            @endphp
            Добавление нового предмета для выставки <b>"{{$show['show_name']}}"</b>
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <form action="{{route('show.create.item', $id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Название предмета</label>
                <input type="text" name = "show_item_name" class="form-control" placeholder="Введите название предмета">
            </div>
            <div class="form-group">
                <label>Информация о предмете</label>
                <input type="text" name = "show_item_info" class="form-control" placeholder="Введите информацию">
            </div>
            <div class="form-group">
                <label >Дата создания</label>
                <input type="text" name = "show_item_date_creation" class="form-control" placeholder="Введите дату создания">
            </div>
            <div class="form-group">
                <label >Автор</label>
                <input type="text" name = "show_item_author_fullname" class="form-control" placeholder="Введите имя автора">
            </div>
            <div class="form-group">
                <label >Фотография предмета</label>
                <input type="file" name="show_item_img" class="form-control-file">
            </div>

            <input type="submit" class="btn btn-outline-success">
        </form>
    </div>
@endsection