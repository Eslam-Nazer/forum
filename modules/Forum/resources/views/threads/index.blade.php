<div>
    <article>
        @foreach($threads as $thread)

            <div style="margin-top: 10px; border-bottom: #0a0a0a 1px solid">
                this thread have {{ $thread->replies_count }} {{Str::plural('reply', $thread->replies_count)}}
            </div>
            <h4>
                <a href="{{$thread->path()}}">
                {{$thread->title}}
                </a>
            </h4>
            <div>
                {{$thread->body}}
            </div>
        @endforeach
        <h4>
        </h4>
    </article>
</div>
