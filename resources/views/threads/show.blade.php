@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">
                        <a href="#">{{$thread->creator->name}}</a> Posted: {{$thread->title}}
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{$replies->links()}}

                @if(auth()->check())
                    <form action="{{$thread->path() . '/replies'}}" method="post">
                        @csrf

                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Have Something To Say?" name="body"
                                      id="body">

                            </textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Post</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to participate in this
                        discussion</p>
                @endif

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        This thread was published {{$thread->created_at->diffForHumans()}} by <a
                                href="#">{{$thread->creator->name}}</a> and currently
                        has {{$thread->replies_count}} {{str_plural('comment', $thread->replies_count)}}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection