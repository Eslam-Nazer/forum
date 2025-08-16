{{--@extends('layouts.app')--}}

<div>
    <div>
        <a href="#">{{$thread->creator->name}}</a> <span>posted:</span>
    </div>
    <div>
        {{$thread->title}}
    </div>
    <div>
        {{$thread->body}}
    </div>
    <div style="display: flex; margin-top: 15px; margin-bottom: 10px;">
        <div style=" padding: 10px; border: #0a0a0a 2px solid;">
            this thread created by {{ $thread->creator->name }} and
            have {{ $thread->replies_count }} {{Str::plural('comment', $thread->replies_count)}}
        </div>
    </div>
    <ul style="padding: 0">
        @foreach($thread->replies as $reply)
            <listbox-content>
                <div style="padding: 20px">
                    <a href="#">{{$reply->owner->name}}</a> {{$reply->created_at->diffForHumans()}}
                </div>
                <div style="padding-top: 5px; padding-left: 20px">
                    {{$reply->body}}
                </div>
            </listbox-content>
            <div>
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    @csrf
                    <button type="submit" {{$reply->isFavorite() ? 'disabled' : ''}}>
                        {{$reply->favorites_count}} {{Str::plural('Favorite', $reply->favorites_count)}}
                    </button>
                </form>
            </div>
        @endforeach
    </ul>
    @if(auth()->check())
        <div>
            <form
                action="{{route('threads.replies.store', ['threadId' => $thread->id, 'channel' => $thread->channel->slug])}}"
                method="POST">
                @csrf
                <div>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="text-red-600" style="color: red">{{$error}}</div>
                        @endforeach
                    @endif
                    <textarea name="body" id="body" cols="30" rows="10" placeholder="Have something to say?"></textarea>
                    <button type="submit">post</button>
                </div>
            </form>
        </div>
    @endif
</div>
