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
                 <div>
                     {{$reply->owner->name}} {{$reply->created_at->diffForHumans()}}
                 </div>
                 {{$reply->body}}
             </listbox-content>
         @endforeach
     </ul>
 </div>
