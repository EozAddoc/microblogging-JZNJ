<x-app-layout>
    <!-- <form method="post" action="#" enctype="multipart/form-data" accept-charset="UTF-8">
     {{ csrf_field()}}
    <label for="postItem">New Post</label><br>
    <input type="text"name="description">
    <input type="text" name="img_url">
    <button type="submit">Add</button>
    </form> -->
    <div class="display flex justify-center mt-10">
        <div>
            {!! form($form) !!}
        </div>
</div>
</x-app-layout>