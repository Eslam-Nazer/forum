{{--@extends('layouts.app')--}}

<div>
         <a href="#">{{$thread->creator->name}}</a> posted:
     {{$thread->title}}
     <div>
         {{$thread->body}}
     </div>
     <ul>
         @foreach($thread->replies as $reply)

             <listbox-content>
                 <div style="padding: 20px">
                     <a href="#">{{$reply->owner->name}}</a> {{$reply->created_at->diffForHumans()}}
                 </div>
                 <div style="padding-top: 5px; padding-left: 20px">
                     {{$reply->body}}
                 </div>
             </listbox-content>
         @endforeach
     </ul>
    @if(auth()->check())
    <div>
        <form action="{{route('threads.replies.store', $thread->id)}}" method="POST">
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
