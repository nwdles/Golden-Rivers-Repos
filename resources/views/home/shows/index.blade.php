@extends('layout')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">В данном разделе представлены выставки</h1>
            <p class="lead text-muted"></p>
            @if(Auth::check())
            <a class="btn btn-outline-secondary" href="{{ route('create.show.page') }}">Добавить выставку</a>
                @endif
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

            <div class="row">
                @foreach($shows['payload'] as $item)
                    @if($item->show_status === true)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        @php
                        if(!is_null($item->show_short_img))
                            $strPath=asset('/storage/'.$item->show_short_img);
                        else
                            $strPath=asset('/storage/images/1.jpeg');
                        @endphp
                        <img class="img-fluid img-thumbnail" src="{{$strPath}}" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><b>{{$item->show_name}}</b></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button  onclick="location.href='{{ route('show.items',$item->show_id) }}'" type="button" class="btn btn-sm btn-outline-secondary">Смотреть</button>
                                    @if(Auth::check() && Auth::user()->isAdmin() )
                                    <button  onclick="location.href='{{ route('edit.show.page',$item->show_id) }}'" type="button" class="btn btn-sm btn-outline-warning">Правка</button>
                                    @endif
                                    <button onclick="location.href='{{ route('ticket.page', ['show', $item->show_id]) }}'" type="button" class="btn btn-sm btn-outline-success">Купить билет</button>
                                </div>
                                <small class="text-muted">{{$item->show_cost_ticket}} руб.</small>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection