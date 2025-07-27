<div>
    <form method="POST" action="/threads">
        @csrf
        <label>title</label><br />
        <input name="title" type="text" /><br />
        <label>Body</label><br />
        <textarea name="body"></textarea><br /><br />
        <button type="submit">Publish</button>
    </form>
</div>
