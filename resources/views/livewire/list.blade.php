<div>
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">List Posts</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-7xl text-justify">@if($errors->any())
            <div class="w-full bg-red-500 p-2 text-center my-2 text-white">
                {{$errors->first()}}
            </div>
            @endif
            @if (session('status'))
                <div class="w-full bg-green-500 p-2 text-center my-2 text-white">
                    {{ session('status') }}
                </div>
            @endif
            <div class="text-right py-2">
                <button wire:click="crear()" class="inline-block px-4 py-1 bg-orange-500 text-white rounded mr-2 hover:bg-orange-800" href="{{ route('roles.create') }}" title="Create">Create new post</button> 
            </div>            
        @if($modal)
              @include('livewire.crear')   
        @endif   
 
           <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <!--First card-->
            @foreach($posts as $post) 
               <div class="md:p-8 p-2 bg-white">
               
                <!--Banner image-->
                      <img
                        class="rounded-lg w-full"
                        src="https://images.unsplash.com/photo-1603349206295-dde20617cb6a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80 "/>

                      <!--Title-->
                      <h1
                        class="font-semibold text-gray-900 leading-none text-xl mt-1 capitalize truncate">
                            {{ $post->title }}
                      <!--Description-->
                      <div class="max-w-full">
                        <p class="text-base font-medium tracking-wide text-gray-600 mt-1">
                          {{ $post->body }} 
                        </p>
                      </div>

                      <div class="flex items-center space-x-2 mt-20">
                        <!--Author's profile photo-->
                        <img
                          class="w-10 h-10 object-cover object-center rounded-full"
                          src="https://randomuser.me/api/portraits/men/54.jpg" alt="random user"/>
                          
                        
                        <div>
                          <!--Author name-->
                          <p class="text-gray-900 font-semibold">Lugano Shabani</p>
                          <p class="text-gray-500 font-semibold text-sm">
                            Feb 24,2021 &middot; 6 min read
                          </p>
                        </div>
                  </div>
              </div>
      <!--End of first card-->                    
     @endforeach     
        </div>
    </div>
</article>
</div>



    
