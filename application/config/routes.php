<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['reg'] = "home/process";
$route['verifylogin'] = "home/login";
$route['userhome'] = "userhome";
$route['facebooklogin'] = "facebooklogin";
$route['logout'] = "home/logout";
$route['about-us'] = "home/aboutus";
$route['contact-us'] = "home/contactus";
$route['privacy-policy'] = "home/privacypolicy";
$route['terms-of-use'] = "home/termsofuse";
$route['faq'] = "home/faq";
//$route['default_controller'] = "sdsadasdasdsad";

$connect=mysql_connect("50.63.106.154", "tellidbase1212", "XenaDog12!!") or die("Could not connect");
mysql_select_db("tellidbase1212",$connect) or die("Could not select database");

//category url
$select=mysql_query("select cate_name,cid from category");
while($row=mysql_fetch_array($select)){	
	$cat_name = str_replace(" ","-",$row['cate_name']);
	$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );	
	$route['category/category-name/'.$cat_name] = "category/seoUrlIndex/".$row['cid'];	
	$route[''.$cat_name] = "category/seoUrlIndex/".$row['cid'];	
}

//group url
$select=mysql_query("select id,group_name from group_list");
while($row=mysql_fetch_array($select)){	
	$group_name = str_replace(" ","-",$row['group_name']);
	$group_name =preg_replace("![^a-z0-9]+!i", "-",$group_name);
	$route['group-discussions/group-name/'.$group_name] = "groupdiscussions/seoUrlIndex/".$row['id'];
	$route[''.$group_name] = "groupdiscussions/seoUrlIndex/".$row['id'];
	
}

//pod url
$select=mysql_query("select id,place from place_of_discussion");
while($row=mysql_fetch_array($select)){	
	$place = str_replace(" ","-",$row['place']);
	$place =preg_replace("![^a-z0-9]+!i", "-",$place);
	$route['place-discussions/place/'.$place] = "placediscussions/seoUrlIndex/".$row['id'];
	$route[''.$place] = "placediscussions/seoUrlIndex/".$row['id'];
	
}

//view profile
$select=mysql_query("select userid,name,last_name from users");
while($row=mysql_fetch_array($select)){	
     if($row['last_name']!='')
		 $name=$row['name'].' '.$row['last_name'];				
	 else
		 $name=$row['name'];
	$name= str_replace(" ","-",$name);
	$name =preg_replace("![^a-z0-9]+!i", "-",$name);
	/*if($name!=''){
	$route['view-profile/'.$name.'/'.$row['userid']] = "viewprofile/seoUrlIndex/".$row['userid'];
	$route['add-to-group/'.$name.'/'.$row['userid']] = "addtogroup/seoUrlIndex/".$row['userid'];
	$route['add-to-discussion/'.$name.'/'.$row['userid']] = "addtodiscussion/seoUrlIndex/".$row['userid'];
	}
	else{
	$route['view-profile/'.$row['userid']] = "viewprofile/seoUrlIndex/".$row['userid'];
	$route['add-to-group/'.$row['userid']] = "addtogroup/seoUrlIndex/".$row['userid'];
	$route['add-to-discussion/'.$row['userid']] = "addtodiscussion/seoUrlIndex/".$row['userid'];
	}*/
        $route['view-profile/'.$name.'/'.$row['userid']]    = "viewprofile/seoUrlIndex/".$row['userid'];
	$route['add-to-group/'.$row['userid']]              = "addtogroup/seoUrlIndex/".$row['userid'];
	$route['add-to-discussion/'.$row['userid']]         = "addtodiscussion/seoUrlIndex/".$row['userid'];
	
}

//user posts
$select=mysql_query("SELECT * from post_details");
while($row=mysql_fetch_array($select)){	
	$about=$row['post_about'];
	if($about=='person')
			$category=$row['first_name']." ".$row['last_name'];
	else if($about=='place')
			$category=$row['place'];
	else if($about=='other')
			$category=$row['other_description'];
	else if($about=='group' || $about=='pod')
			$category=$row['first_name'];
	else
		$category='';
	$category_link= str_replace(" ","-",$category);
	$category_link=preg_replace("![^a-z0-9]+!i", "-", $category_link);
	$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$row['postid'].")");
	if($row_cat=mysql_fetch_array($selectcat)){
		$cat_name = str_replace(" ","-",$row_cat['cate_name']);
		$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );
	}
        
	$route[''.$cat_name.'/'.$category_link.'/'.$row['postid']] = "userpost/seoUrlIndex/".$row['postid'];
	$route[''.$category_link.'/'.$row['postid']] = "userpost/seoUrlIndex/".$row['postid'];
	$route['TELLITIZE/'.$category_link.'/'.$row['postid']] = "userpost/seoUrlIndex/".$row['postid'];	
	$route['TELLITIZE/'.$row['postid']] = "userpost/seoUrlIndex/".$row['postid'];
        
        $route[''.$cat_name.'/'.$category_link.'/'.$row['postid']."/ref"] = "userpost/seoUrlIndex/".$row['postid'];
	$route[''.$category_link.'/'.$row['postid']."/ref"] = "userpost/seoUrlIndex/".$row['postid'];
	$route['TELLITIZE/'.$category_link.'/'.$row['postid']."/ref"] = "userpost/seoUrlIndex/".$row['postid'];	
	$route['TELLITIZE/'.$row['postid']."/ref"] = "userpost/seoUrlIndex/".$row['postid'];}



/* End of file routes.php */
/* Location: ./application/config/routes.php */