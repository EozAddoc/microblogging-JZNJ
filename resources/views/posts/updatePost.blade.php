<x-app-layout>
    <form method="post" action="{{route('updatePost.update',$posts->id )}}" enctype="multipart/form-data" accept-charset="UTF-8">
        {{ csrf_field()}}
        <label for="postItem">Update Post</label><br>
        <input type="text" name="description" placeholder="{{old('description', $posts->description)}}">
        <input type="text" name="img_url" placeholder="{{old('img_url', $posts->img_url)}}">
        <button type="submit">Update</button>
    </form>
</x-app-layout>