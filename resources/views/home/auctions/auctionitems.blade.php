@extends('layout')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">

            @php
            $auction = \App\Models\Auction::find($id);

            if(!is_null($auction->auction_full_img))
              $strPath='http://golden-rivers.loc/storage/'.$auction->auction_full_img;
             else
              $strPath='http://golden-rivers.loc/storage/images/1.jpeg';

            @endphp
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
                <h5 class="my-0 mr-md-auto font-weight-normal">Аукцион: "{{$auction['auction_name']}}"</h5>
                <nav class="my-2 my-md-0 mr-md-3">
                     @if((Auth::check() && Auth::user()->user_id == $auction['user_id']) || Auth::user()->isAdmin())
                    <button class="btn btn-outline-secondary" onclick="location.href='{{ route('auction.create.item.page', $id) }}'">Добавить предмет</button>
                    @endif
                    <button class="btn btn-outline-success" onclick="location.href='{{ route('ticket.page', ['auction', $id]) }}'">Купить билет</button>
                </nav>

            </div>
            <div class="thumbnail text-center">
                <a href="{{$strPath}}">
                    <img class="img-fluid img-thumbnail" src="{{$strPath}}" alt="Nature" style="width:50%">
                </a>
            </div>
            <hr>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="row">
                @foreach($auctionItems['payload'] as $item)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            @php
                                if(!is_null($item->auction_item_img))
                                    $strPath='http://golden-rivers.loc/storage/'.$item->auction_item_img;
                                else
                                    $strPath='http://golden-rivers.loc/storage/images/1.jpeg';
                            @endphp
                            <img class="img-fluid img-thumbnail" src="{{$strPath}}" alt="Card image cap">
                            @if(Auth::check() && Auth::user()->isAdmin() )
                            <form action="{{route('delete.auction.item',[ $id,$item->auction_item_id])}}" method="post">
                                {{ csrf_field() }}
                                <input type="submit"
                                       onclick="return confirm('Вы уверены, что хотите удалить предмет?')"
                                       class="btn btn-outline-danger btn-sm"
                                       value="Удалить">
                            </form>
                            @endif
                            <div class="card-body">
                                <p class="card-text"><b>{{$item->auction_item_name}}</b></p>
                                <p class="card-text">{{$item->auction_item_info}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Цена: {{$item->auction_item_cost}} руб.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection