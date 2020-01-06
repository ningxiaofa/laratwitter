@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5>{{ $user->name }}</h5>
                @if(auth()->user())
                    @if(auth()->user()->isNot($user))
                        @if(auth()->user()->isFollowing($user))
                            <a href="{{ route('user.unfollow', $user) }}" class="btn btn-danger">取消关注</a>
                        @else
                            <a href="{{ route('user.follow', $user) }}" class="btn btn-success">关注</a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('user.follow', $user) }}" class="btn btn-success">关注</a>
                @endif
            </div>
        </div>
    </div>
@endsection