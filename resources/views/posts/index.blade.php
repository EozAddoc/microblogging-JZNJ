<x-guest-layout>
@foreach ($posts as $post)
    <div class="max-w-sm m-4">
    <div class="rounded-2xl shadow-xl">
        <!-- inside card -->
        <div class="w-fit rounded overflow-hidden shadow-none">
            <header class="flex flex-start">
                <div>
                    <a href="#" class="cursor-pointer m-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>
                            <p class="block ml-2 text-lg font-bold">{{$post->user->name}}</p>
                        </div>
                    </a>
                </div>
            </header>
            <img class="w-full max-w-full min-w-full"
            src="{{ $post->img_url }}"
                alt="post">

            <div class="px-6 pt-4">
                <div>
                    <div class="flex items-center">

                    </div>
                    </div>
                <div class="mb-4">
                    <div class="text-sm flex flex-start items-center">

                        <p class="font-bold ml-2">
                            <a class="cursor-pointer">{{$post->user->name}}:</a>
                            <span class="text-gray-700 font-medium ml-1">
                            {{$post->description}}
                            </span>
                        </p>
                    </div>
                    </div>

            </div>
        </div>
    </div>
    </div>

@endforeach
</x-guest-layout>