@extends('main')

@section('title',$data->name_eng)

@section('content')

<script>

$(document).ready(function(){
    $("button[name='good']").click(function(){
        $(this).addClass('active');
        $(this).addClass('btn-success');
        $("button[name='bad']").removeClass('active');
        $("button[name='bad']").removeClass('btn-danger');
        $("input[name='goodorbad']").attr("value","1");
    });

    $("button[name='bad']").click(function(){
        $(this).addClass('active');
        $(this).addClass('btn-danger');
        $("button[name='good']").removeClass('active');
        $("button[name='good']").removeClass('btn-success');
        $("input[name='goodorbad']").attr("value","0");
    });

    $("button[name='submit']").click(function(){
        $(this).addClass('active');
    });
});

</script>

 
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
            <td>
                <a href="https://boardgamegeek.com/boardgame/{{$data->bggid}}"target="_blank">BGG</a><br>
                @foreach($links as $url)
                    <a href="{{ $url->link }}"target="_blank">{{ $url->title }}</a><br>
                @endforeach
            </td>
           
        </tr>
    </table>
    <table class="table table-bordered"
        <tr>
            
            <h4><b>評論</b></h4>
            
        </tr>
        @foreach($comments as $com)
        <tr>
            <td><b> {{ $com->username }}</b></td>
            @if($com->like == 0)
            <td class="text-center danger" ><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></td>
            @else
            <td class="text-center success"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></td>
            @endif
            <td> {{$com->description }} </td>
            
        
        </tr>
        @endforeach

    </table>    
    <table class="table text-center">    
        <tr>
            
            <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#commentModal">
                 評評理
                </button>
            </td>
             <td><!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#linkModal">
                新增連結
                </button>
            </td>
            <td>
                <a href="{{ url('game?bgname='.session('keyword')) }}" class="btn btn-primary">回到上一頁</a>
            </td>    
        </tr>
    </table>
</div>

<!--新增連結model-->

<div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <input type="text" class="form-control" name="title" placeholder="輸入標題">
            </div>
            <div class="form-group">
                 <label for="input_url">連結</label>
                 <input type="url" class="form-control" name="url"  placeholder="輸入連結">
            </div>
            <button type="submit" class="btn btn-default">送出</button>
        </form>

      </div>
    </div>
  </div>
</div>


<!--評分model-->

<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">說說你對他的看法</h4>
      </div>
      <div class="modal-body">
         <form method="GET" action="/comment/{{$data->bggid}}" role="form">
            <div class="form-group">
                <label for="input_title">你的名字</label>
                <input type="text" class="form-control" name="username" placeholder="你的大名">
            </div>
            <!-- 這個隱藏的input紀錄好壞 -->
            <input type="hidden" value="na" name="goodorbad"></input>

            <div class="btn-group" role="group" aria-label="prefer">
                <button name="good" type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-thumbs-up" ></span>
                </button>
                <button name="bad" type="button" class="btn btn-default">   
                    <span class="glyphicon glyphicon-thumbs-down" ></span>
                </button>
            </div>
            <div class="form-group">
                 <label for="input_url">評評理</label>
                 <input type="url" class="form-control" name="description"  placeholder="說說看">
            </div>
            <button name="submit" type="submit" class="btn btn-default">送出</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection