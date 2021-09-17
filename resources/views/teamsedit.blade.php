@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('teams/update') }}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <div class="my-3 mx-auto col-sm-6">
                <label for="item_name">Voice</label>
                <input type="text" name="team_name" class="form-control" value="{{$team->team_name}}">
                </div>
            </div>
            <div class="form-group">
                <div class="my-3 mx-auto col-sm-6">
                <label for="item_name">Detail</label>
                <textarea type="text" name="team_detail" class="form-control" rows="3">{{$team->team_detail}}</textarea>
                </div>
            </div>
            <!--/ item_name -->
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <div class="my-3 mx-auto col-sm-6">
                <button type="submit" class="btn btn-primary w-100">Raise</button>
                </div>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$team->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection