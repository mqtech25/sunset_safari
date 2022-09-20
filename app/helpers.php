<?php
use \App\Models\Category;
function generateChildrens(Category $category){
    if($category->items->count()>0)
    {
        echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="'.route('category.show', $category->slug).'" id="'.$category->slug.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$category->name.'</a>
                <div class="dropdown-menu" aria-labelledby="'.$category->slug.'">';
                foreach($category->items as $item){
                    generateChildrens($item);
                }
        echo '</div>
				</li>';
    }else{
        echo '<li class="nav-item">
                <a class="nav-link" href="'.route('category.show', $category->slug) .'">'.$category->name.'</a>
            </li>';
    }
}

function getCartWeight(){
    dd(\Cart::getContent());
}