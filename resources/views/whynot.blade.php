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