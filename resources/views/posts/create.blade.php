<x-app-layout>
<div class="display flex justify-center mt-10">
    <form method="post" enctype="multipart/form-data" accept-charset="UTF-8" class="w-2/5">
     {{ csrf_field()}}
        <!-- <label for="postItem">New Post</label><br>
        <input type="text"name="description">
        <input type="text" name="img_url">
        <button type="submit">Add</button> -->
        <div class="mb-6">
        <label for="desc" class="block mb-2 text-lg font-medium text-gray-900">Your description:</label>
        <input type="text"name="description" id="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="This cat is so cute !" required>
        </div>
        <div class="mb-6">
        <label for="url" class="block mb-2 text-lg font-medium text-gray-900">The URL Picture:</label>
        <input type="text" name="img_url" id="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  placeholder="https://cataas.com/cat" required>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">Post</button>
    </form>

    <!-- <div class="display flex justify-center mt-10">
        <div>
            {!! form($form) !!}
        </div> -->
</div>
</x-app-layout>