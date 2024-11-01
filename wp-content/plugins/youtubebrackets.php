<?php
/*
Plugin Name: Youtube Brackets
Plugin URI: http://www.robertbuzink.nl/journal/2006/11/23/youtube-brackets-wordpress-plugin/
Description: Insert YouTube videos in post using bracket method. Enables YouTube blogging to standalone wordpress setups.

Based on the Quicktime Posting plugin by Shawn Van Every.

Author: Robert Buzink
Version: 1
Author URI: http://robertbuzink.nl
*/ 

$stag = "[youtube=http://www.youtube.com/watch?v=";
$etag = "]";

function quicktime_post($the_content)
{
    GLOBAL $stag, $etag;

    $spos = strpos($the_content, $stag);
    if ($spos !== false)
    {
        $epos = strpos($the_content, $etag, $spos);
        $spose = $spos + strlen($stag);
        $slen = $epos - $spose;
        $tagargs = substr($the_content, $spose, $slen);
        
        $the_args = explode(" ", $tagargs);
        
        if (sizeof($the_args) == 1)
        {
            $file = $tagargs;
			$width = 425;
			$height = 350;
            $tags = generate_tags($file,$width,$height);
            $new_content = substr($the_content,0,$spos);
            $new_content .= $tags;
            $new_content .= substr($the_content,($epos+1));
        }
		
		else if (sizeof($the_args) == 3)
        {
            list($file,$width,$height) = explode(" ", $tagargs);
            $tags = generate_tags($file,$width,$height);
            $new_content = substr($the_content,0,$spos);
            $new_content .= $tags;
            $new_content .= substr($the_content,($epos+1));
        }
       /* else if (sizeof($the_args) == 4)
        {
            list($file,$poster,$width,$height) = explode(" ", $tagargs);
            $tags = generate_tags($file,$width,$height,$poster);
            $new_content = substr($the_content,0,$spos);
            $new_content .= $tags;
            $new_content .= substr($the_content,($epos+1));
        }
        else if (sizeof($the_args) == 5)
        {
            list($file,$width,$height,$autoplay,$controller) = explode(" ",$tagargs);
            $poster = "";
            $tags = generate_tags($file,$width,$height,$poster,$autoplay,$controller);
            $new_content = substr($the_content,0,$spos);
            $new_content .= $tags;
            $new_content .= substr($the_content,($epos+1));
        }
        else if (sizeof($the_args) == 6)
        {
            list($file,$poster,$width,$height,$autoplay,$controller) = explode(" ",$tagargs);
            $tags = generate_tags($file,$width,$height,$poster,$autoplay,$controller);
            $new_content = substr($the_content,0,$spos);
            $new_content .= $tags;
            $new_content .= substr($the_content,($epos+1));
        } */
                
        if ($epos+1 < strlen($the_content))
        {
            $new_content = quicktime_post($new_content);
        }
        return $new_content;
    }
    else
    {
        return $the_content;
    }
}

function generate_tags($file, $width, $height, $poster = "", $autoplay = "false", $controller = "")
{
    $tag_line = "<object width=\"";
	$tag_line .= $width;
	$tag_line .= "\" height=\"";
	$tag_line .= $height;
	$tag_line .= "\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/";
	$tag_line .= $file;
	$tag_line .= "\"> <param name=\"movie\" value=\"http://www.youtube.com/v/";
	$tag_line .= $file;
	$tag_line .= "\" /><param name=\"wmode\" value=\"transparent\" /></object>";
	
	$script_tags = $tag_line;
        
    return $script_tags;
}

add_filter('the_content', 'quicktime_post');
add_filter('the_excerpt','quicktime_post');
?>