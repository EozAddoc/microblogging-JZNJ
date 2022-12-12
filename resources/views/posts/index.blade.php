<x-app-layout>
<x-guest-layout>
@foreach ($posts as $post)
    <div class="max-w-sm m-4">
    <!-- <div class="rounded-2xl shadow-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300"> -->
    <div class="rounded-2xl shadow-xl bg-white text-gray-700">
        <!-- inside card -->
        <div class="w-fit rounded overflow-hidden shadow-none">
            <header class="flex flex-start">
                <div>
                    <a href="allposts/{{$post->user->id}}" class="cursor-pointer m-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>
                            <p class="block ml-2 text-lg font-bold">{{$post->user->name}}</p>
                            <span class="block ml-2 text-xs text-gray-600">Published on {{$post->created_at->format('jS \of F Y')}} at {{$post->created_at->format('h:i A')}}</span>
                        </div>
                    </a>
                </div>
            </header>
            <button type="button" data-toggle="modal" data-target="#Modalpopup"><img class="w-full max-w-full min-w-full"
            src="{{ $post->img_url }}"
                alt="post"></button>

            <div class="px-6 pt-4">
                <div>
                    <div class="flex items-center">
                        <span class="mb-2 mr-2 inline-flex items-center cursor-pointer">
                            <svg class="text-gray-700 mr-1 inline-block h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span class="text-md mt-1 font-black text-gray-700">
                            I like it!
                            </span>
                        </span>

                    </div>
                    </div>
                <div class="mb-6">
                    <div class="text-sm flex flex-start items-center">

                        <p class="font-bold ml-2">
                            <a class="cursor-pointer">{{$post->user->name}}:</a>
                            <span class="text-gray-500 font-medium ml-1">
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
</x-app-layout>
