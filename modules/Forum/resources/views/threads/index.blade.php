<div>
    <article>
        @foreach($threads as $thread)
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
