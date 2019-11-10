@extends('layout')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            @php
                    $auction = \App\Models\Auction::find($id);
            @endphp
            Добавление нового предмета для аукциона <b>"{{$auction['auction_name']}}"</b>
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <form action="{{route('auction.create.item', $id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Название предмета</label>
                <input type="text" name = "auction_item_name" class="form-control" placeholder="Введите название предмета">
            </div>
            <div class="form-group">
                <label>Информация о предмете</label>
                <input type="text" name = "auction_item_info" class="form-control" placeholder="Введите информацию">
            </div>
            <div class="form-group">
                <label >Цена предмета</label>
                <input type="text" name = "auction_item_cost" class="form-control" placeholder="Введите цену предмета">
            </div>
            <div class="form-group">
                <label >Фотография предмета</label>
                <input type="file" name="auction_item_img" class="form-control-file">
            </div>

            <input type="submit" class="btn btn-outline-success">
        </form>
    </div>
@endsection