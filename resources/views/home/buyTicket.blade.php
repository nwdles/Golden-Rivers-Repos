@extends('layout')

@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert">
            @php
            if($nameEvent === 'show')
                $name = \App\Models\Show::find($id)['show_name'];
            else
                $name = \App\Models\Auction::find($id)['auction_name'];
            @endphp
            Запрос на покупку билета. Мероприятие <b>"{{$name}}"</b>
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <form action="{{route('buy.ticket', [$nameEvent, $id])}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Сообщение</label>
                <input type="text" name = "ticket_comment" class="form-control" placeholder="Введите ваше сообщение">
                <small id="emailHelp" class="form-text text-muted">После подтверждения запроса с вами свяжется наш менеджер.</small>
            </div>

            <input type="submit" class="btn btn-outline-success">
        </form>
    </div>
    @endsection