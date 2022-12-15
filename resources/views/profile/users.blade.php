<?php

use App\Models\Follow;


?>
<x-app-layout>
    <!-- This is an example component -->
    <div class="max-w-xl mx-auto">

        <div class="p-8 max-w-md bg-white rounded-lg border shadow-md sm:p-8 ">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900 ">Users</h3>

            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="{{$user->img}}" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <?php
                                if ($user->id === auth()->user()->id) {
                                    $route = "/profilePage";
                                } else {
                                    $route = "user/" . strval($user->id);
                                }


                                $userId = auth()->user()->id;

                                $userFollows = Follow::where('follower_id', $userId)->where('followed_id', $user->id)->first();
                                ?>
                                <p class="text-sm font-medium text-gray-900 truncate ">
                                    <a href={{$route}}>{{$user->name}}</a>
                                </p>
                                <p class="text-sm text-gray-500 truncate ">
                                    {{$user->email}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 ">
                                <button class="bg-blue-500 px-2 py-1 
                        text-white font-semibold text-sm rounded block text-center 
                        sm:inline-block block hover:bg-blue-800" type="submit" <?php if ($userFollows != null) {
                                                                                    echo 'style="display: none;"';
                                                                                } ?>>Follow</button>
                                <button class="bg-blue-500 px-2 py-1 
                        text-white font-semibold text-sm rounded block text-center 
                        sm:inline-block block hover:bg-blue-800" <?php if ($userFollows == null) {
                                                                        echo 'style="display: none;"';
                                                                    } ?>>Unfollow</button>
                            </div>
                            @endforeach
                        </div>
                    </li>

                </ul>
            </div>

</x-app-layout>