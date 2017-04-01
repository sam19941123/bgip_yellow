@extends('main')



@section('content')

<style>
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}
</style>

<a href="/" class="btn btn-danger btn-sm">BACK</a>
@if(count($games) == 0)
<h4>Result of "{{ $keyword }}"：Not found</h4>
@else

<h4>Result of "{{ $keyword }}"：</h4>
@foreach($games as $game)
<div class="col-md-4">
    <div name="panel" class="panel panel-default" id="{{$game->bggid}}">
        <div class="panel-body">
            <table class="table table-borderless">
                <tr>
                    <td>
                        <img src="https://cf.geekdo-images.com/images/{{$game->imgsrc}}" style="height:100px" class="img-rounded center-block"></img>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="text-center">{{ $game->name_english }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="text-center">
                            <a href="/game/{{$game->bggid}}" class="btn btn-default">Detail</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection