<?php
    use \Core\Auth;
        use \Facades\Storage;

?>

<aside class="bg-gray-900 w-64 p-6 space-y-6 transition-transform    hidden lg:block">
    <?php if(Auth::logged()) :  ?>
        <div class="flex items-center space-x-6 mb-6 px-4">
            <img 
            id=""
            src="<?php  if(!is_null(Auth::user()['avatar'])){ echo Storage::urlRead('avatar',Auth::user()['avatar']); } else {echo 'https://cdn.vectorstock.com/i/750p/66/13/default-avatar-profile-icon-social-media-user-vector-49816613.avif'; }?> "
            alt="User Avatar"
            class="w-24 h-24 rounded-full border-4 border-accent"
            />
            </div>
            <div>
            <h3 class="text-2xl font-bold px-2"><?=Auth::user()['name']?></h3>
        </div>
    <?php endif; ?>
               
    <nav class="space-y-4">
         <?php 
            if(Auth::logged()) 
            {
                echo ' <a href="'.url('dash').'" class="block hover:text-accent px-2"><i class="bi bi-house-door-fill mr-1"></i>Home</a>';
            }
            else
            {
                echo ' <a href="'.url('index').'" class="block hover:text-accent px-2"><i class="bi bi-house-door-fill mr-1"></i>Home</a>';
            }
            '  <a href="#" class="block hover:text-accent">Technology</a>
                    <a href="#" class="block hover:text-accent">AI</a>
                    <a href="#" class="block hover:text-accent">World</a>
                    <a href="#" class="block hover:text-accent">Opinion</a>';

            echo ' <a href="'.url('blog').'" class="block hover:text-accent px-2"><i class="bi bi-journal-text mr-1"></i>Blog</a>';

            if(Auth::logged()) 
            {
                echo ' <a href="'.url('profile').'" class="block hover:text-accent px-2"><i class="bi bi-person mr-1"></i>Profile</a>';
                if(boolval(Auth::user()['admin']))
                {
                    echo ' <a href="'.url('admin').'" class="block hover:text-accent px-2">
                            <i class="bi bi-person-badge-fill mr-1"></i>
                            Admin</a>';
                }
            }
            
        ?>      
       
      
    </nav>
    </aside>