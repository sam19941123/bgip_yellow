@extends('main')

@section('title',$data->name_eng)

@section('content')

<div class="col-md-8 col-md-offset-2">
    <img src="https://cf.geekdo-images.com/images/{{$data->imgsrc}}" style="width:30%" class="img-rounded center-block">
    <br>
    <table class="table text-center">
        <tr>
            <td><b>出版年份</b></td>
            <td>{{ $data->publish_year }}</td>
        </tr>
        <tr>
            <td><b>英文名稱</b></td>
            <td>{{ $data->name_eng }}</td>
        </tr>
        <tr>
            <td><b>中文名稱</b></td>
            <td>{{ $data->name_chinese }}</td>
        </tr>
        <tr>
            <td><b>玩家人數</b></td>
            <td>{{ $data->player_min }}～{{ $data->player_max }}人</td>
        </tr>
        <tr>
            <td><b>遊戲時間</b></td>
            <td>{{ $data->game_time }}分鐘</td>
        </tr>
        <tr>
            <td><b>相關連結</b></td>
            <td><a href="https://boardgamegeek.com/boardgame/{{$data->bggid}}">BGG</a>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="{{ url()->previous() }}" class="btn btn-primary">回到上一頁</a>
            </td>
        </tr>
    </table>
</div>
@endsection