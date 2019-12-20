<?php
namespace App;

function is_admin()
{
	$usr = auth();
	if ( !$usr ) return false;
	if ( !$usr->admin ) return false;
	return true;
}


function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url, $sort)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="page-item"><a href="'.$page_url.'?page=1&sort='.$sort.'" class="page-link">First</a></li>'; //first link
            $pagination .= '<li class="page-item"><a href="'.$page_url.'?page='.$previous_link.'&sort='.$sort.'" class="page-link">Previous</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li class="page-item"><a href="'.$page_url.'?page='.$i.'&sort='.$sort.'" class="page-link">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="page-item page-link active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="page-item page-link active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="page-item page-link active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li class="page-item"><a href="'.$page_url.'?page='.$i.'&sort='.$sort.'" class="page-link">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li class="page-item"><a href="'.$page_url.'?page='.$next_link.'&sort='.$sort.'" class="page-link">Next</a></li>'; //next link
                $pagination .= '<li class="page-item"><a href="'.$page_url.'?page='.$total_pages.'&sort='.$sort.'" class="page-link">Last</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}











