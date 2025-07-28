<div>
    <form method="POST" action="/threads">
        @csrf
        <label>title</label><br />
        <input value="{{old('title')}}" name="title" type="text" /><br />
        <label>Body</label><br />
        <textarea name="body">{{old('body')}}</textarea><br /><br />
        <select  name="channel_id">
            <option value="">select one...</option>
            @foreach(\Modules\Forum\Domain\Models\Channel::all() as $channel)
                    <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? "selected" : "" }}>{{$channel->name}}</option>
            @endforeach
        </select>
        <br/>
        <br/>
        <button type="submit">Publish</button>
    </form>
    <br/>
    <div>
        @if($errors)
            @foreach($errors->all() as $error)
            <div style="color: red;">{{$error}}</div>
            @endforeach
        @endif
    </div>
</div>
