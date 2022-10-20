<div>
    
    <div class="w-2/3 bg-gray-50 p-2 rounded-sm shadow-md hidden grid-cols-1 md:visible md:grid md:grid-cols-3">
    
        <h1 class="text-left font-semibold text-md col-span-3 p-2" >Personas que podrías conocer:</h1>
    
        @foreach ($users as $user)

        <a href="{{route('perfil', ['id' => $user->name])}}">
        
            <div class="shadow-md m-1 p-3 h-36 border-2 border-gray-50 transition ease-in hover:-translate-y-1 hover:skew-110 translate-y-1 translate-x-1 delay-100 duration-100 hover:shadow-cyan-500/70">
                
                <img width="50" height="50" class="object-cover rounded-2xl" src="" alt="profile_photo">
                <small>{{$user->name}}</small>
            
            </div>
        
        
        
        </a>
            
        @endforeach


    </div>

</div>
