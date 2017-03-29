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
            <td><a href="https://boardgamegeek.com/boardgame/{{$data->bggid}}"target="_blank">BGG</a></td>
            <td><!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                新增連結
                </button>
            </td>    
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="{{ url('game?bgname='.session('keyword')) }}" class="btn btn-primary">回到上一頁</a>
            </td>
        </tr>
    </table>
</div>

<!--新增連結model-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">將你的連結放入</h4>
      </div>
      <div class="modal-body">
         <form method="GET" action="/link/{{$data->bggid}}" role="form">
            <div class="form-group">
                <label for="input_title">連結標題</label>
                <input type="text" class="form-control" name="title"  placeholder="輸入標題">
            </div>
            <div class="form-group">
                 <label for="input_url">連結</label>
                 <input type="text" class="form-control" name="url"  placeholder="輸入連結">
            </div>
            <button type="submit" class="btn btn-default">送出</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection