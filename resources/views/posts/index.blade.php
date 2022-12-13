<?php

use app\Models\User;



?>
<x-guest-layout>
    @foreach ($posts as $post)

    <div class="max-w-sm m-4">
        <!-- <div class="rounded-2xl shadow-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300"> -->
        <div class="rounded-2xl shadow-xl bg-white text-gray-700">
            <!-- inside card -->
            <div class="w-fit rounded overflow-hidden shadow-none">


                <header class="flex flex-start">
                    <div>

                        <?php
                        if ($post->user->id === auth()->user()->id) {
                            $route = "/profilePage";
                        } else {
                            $route = "/allposts/" . strval($post->user->id);
                        }
                        ?>
                        <a href={{$route}} class="cursor-pointer m-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <?php
                            $userId = $post->user->id;
                            $user = User::where('id', $userId);
                            $userImg = User::where('id', $userId)->withCount('posts')->first();

                            ?>
                            <img src="{{$userImg->img}}" class="h-9 w-9 rounded-full object-cover" alt="usuario" />
                            <div>
                                <p class="block ml-2 text-lg font-bold">{{$post->user->name}}</p>
                                <span class="block ml-2 text-xs text-gray-600">Published on {{$post->created_at->format('jS \of F Y')}} at {{$post->created_at->format('h:i A')}}</span>
                            </div>
                        </a>
                    </div>

                </header>

                <!-- clickable picture -->
                <a class="button" href="#{{ $post->id }}">
                    <img class="w-full max-w-full min-w-full" src="{{ $post->img_url }}" alt="post">
                </a>

                <!-- Modal when clicked -->
                <div id="{{ $post->id }}" class="overlay">
                    <div class="popup">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="text-md mt-1 font-black text-gray-700">{{$post->user->name}}</p>
                                </div>
                                <div class="modal-body">
                                    <img class="w-full max-w-full min-w-full" src="{{ $post->img_url }}" alt="post">
                                </div>
                                <div class="text-md ml-10 mb-10 mt-10 font-black text-gray-700">
                                    {{$post->description}}
                                </div>
                                <div class="modal-footer">
                                    <a class="close btn btn-default" href="#">x</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of Modal -->

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

<style>
    .modal-header {
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
    }

    .modal-dialog {
        width: 600px;
        margin: 30px auto;
    }

    .modal-content {
        position: relative;
        background-color: #fff;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        outline: 0;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    }

    .modal-title {
        margin: 0;
        line-height: 1.42857143;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
    }

    .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .popup .close:hover {
        color: #06D85F;
    }

    .popup .content {
        max-height: 30%;
        overflow: auto;
    }

    @media screen and (max-width: 700px) {
        .box {
            width: 70%;
        }

        .popup {
            width: 70%;
        }
    }
</style>