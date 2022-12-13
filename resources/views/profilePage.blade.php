<?php

use app\Models\User;

$userId = auth()->user()->id;
$user = User::where('id', $userId);
$userPostCount = User::where('id', $userId)->withCount('posts')->first()
?>
<x-guest-layout>

  <main class="bg-gray-100 bg-opacity-25">

    <div class="lg:w-8/12 lg:mx-auto mb-8">

      <header class="flex flex-wrap items-center p-4 md:py-8">
        <style>
          .pb-full {
            padding-bottom: 100%;
          }

          .bioclass {
            color: #8E8E8E;
          }

          /* hide search icon on search focus */
          .search-bar:focus+.fa-search {
            display: none;
          }

          @media screen and (min-width: 768px) {
            .post:hover .overlay {
              display: block;
            }
          }
        </style>

        <div class="md:w-3/12 md:ml-16">
          <!-- profile image -->
          <img class="w-20 h-20 md:w-40 md:h-40 object-cover rounded-full
                     border-2 border-pink-600 p-1" src="{{$userPostCount->img}}" alt="profile">
        </div>

        <!-- profile meta -->
        <div class="w-8/12 md:w-7/12 ml-4">
          <div class="md:flex md:flex-wrap md:items-center mb-4">
            <h2 class="text-3xl inline-block font-light md:mr-2 mb-2 sm:mb-0">
              {{ Auth::user()->name }}
            </h2>

            <!-- badge -->
            <span class="inline-block fas fa-certificate fa-lg text-blue-500 
                               relative mr-6  text-xl transform -translate-y-2" aria-hidden="true">
              <i class="fas fa-check text-white text-xs absolute inset-x-0
                               ml-1 mt-px"></i>
            </span>

            <!-- Edit button -->
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 px-2 py-1 
                        text-white font-semibold text-sm rounded block text-center 
                        sm:inline-block block hover:bg-blue-800">Edit</a>
          </div>

          <!-- post, following, followers list for medium screens -->
          <ul class="hidden md:flex space-x-8 mb-4">
            <li>
              <span class="font-semibold">{{$userPostCount->posts_count}}</span>
              posts
            </li>

            <li>
              <span class="font-semibold">50.5k</span>
              followers
            </li>
            <li>
              <span class="font-semibold">10</span>
              following
            </li>
          </ul>
          <!-- user meta form medium screens -->
          <div class="hidden md:block">
            <h1 class="font-semibold">{{$userPostCount->username}}</h1>
            <span class="bioclass">{{$userPostCount->website}}</span>
            <p>{{$userPostCount->bio}}</p>
          </div>

        </div>

        <!-- user meta form small screens -->
        <div class="md:hidden text-sm my-2">
          <h1 class="font-semibold">{{$userPostCount->username}}</h1>
          <span class="bioclass">{{$userPostCount->website}}</span>
          <p>{{$userPostCount->bio}}</p>
        </div>

      </header>

      <!-- posts -->
      <div class="px-px md:px-3">

        <!-- user following for mobile only -->
        <ul class="flex md:hidden justify-around space-x-8 border-t 
                text-center p-2 text-gray-600 leading-snug text-sm">
          <li>
            <span class="font-semibold text-gray-800 block">6</span>
            posts
          </li>

          <li>
            <span class="font-semibold text-gray-800 block">50.5k</span>
            followers
          </li>
          <li>
            <span class="font-semibold text-gray-800 block">10</span>
            following
          </li>
        </ul>
        <br>
        <br>
        <!-- insta freatures -->
        <ul class="flex items-center justify-around md:justify-center space-x-12  
                    uppercase tracking-widest font-semibold text-xs text-gray-600
                    border-t">
          <!-- posts tab is active -->
          <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
            <a class="inline-block p-3" href="#">
              <i class="fas fa-th-large text-xl md:text-xs"></i>
              <span class="hidden md:inline">posts</span>
            </a>
          </li>
        </ul>
        <!-- flexbox grid -->
        <div class="flex flex-wrap -mx-px md:-mx-3">

          <!-- column -->
          <div class="w-1/3 p-px md:px-3">
            <!-- post 1-->
            @foreach ($posts as $post)


            <div class="max-w-sm m-4">
              <div class="rounded-2xl shadow-xl bg-white text-gray-700">
                <div class="w-fit rounded overflow-hidden shadow-none">
                  <header class="flex flex-start">
                    <div>
                      <a href="#" class="cursor-pointer m-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">

                        <img src="{{$userPostCount->img}}" class="h-9 w-9 rounded-full object-cover" alt="usuario" />
                        <div>
                          <p class="block ml-2 text-sm font-bold">{{$userPostCount->name}}</p>
                          <span class="block ml-2 text-xs text-gray-600">Published on {{$userPostCount->created_at}}</span>
                        </div>
                      </a>
                    </div>

                  </header>
                  <!-- inside card -->
                  <div class="menu-nav">
                    <div class="dropdown-container" tabindex="-1">
                      <div class="three-dots"></div>
                      <div class="dropdown">

                        <form method="POST" action="{{route('profilePage.destroy',$post->id )}}" onsubmit="return confirm('Are you sure?');">
                          @csrf
                          @method('Delete')
                          <button class="text-red-400 hover:text-red-600" type="submit">Delete</button>
                        </form>


                        <a class="text-blue-400 hover:text-blue-600" href="{{route('updatePost.updateForm',$post->id )}}" type="submit">Modify</a>

                      </div>
                    </div>
                  </div>

                  <div class="w-fit rounded overflow-hidden shadow-none">
                    <header class="flex flex-start">
                      <div>

                      </div>
                    </header>
                    <img class="w-full max-w-full min-w-full" src="{{ $post->img_url }}" alt="post">

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
                            <a class="cursor-pointer">{{$userPostCount->name}}:</a>
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
            </div>

            @endforeach
          </div>
        </div>
      </div>
  </main>
</x-guest-layout>
<style>
  .menu-nav {

    display: flex;
  }

  .menu-item {
    color: #FCC;
    padding: 3px;
  }

  .three-dots:after {
    cursor: pointer;
    color: #444;
    content: '\2807';
    font-size: 20px;
  }



  .dropdown {
    outline: none;
    opacity: 0;
    z-index: -1;
    max-height: 0;
    transition: opacity 0.1s, z-index 0.1s, max-height 5s;
  }

  ;

  .dropdown-container:focus {
    outline: none;
  }

  .dropdown-container:focus .dropdown {
    opacity: 1;
    z-index: 100;
    max-height: 100vh;
    transition: opacity 0.2s, z-index 0.2s, max-height 0.2s;
  }
</style>