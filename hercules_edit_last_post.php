<?php
/*
Plugin Name: Hercules Edit Last Post
Description: Adds a link to edit your last post under the posts menu.
Author: Todd D. Nestor - todd.nestor@gmail.com
Version: 1.0
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Class HercEditLastPost 
 *
 */
    class HercEditLastPost
    {
        /**
         * The constructor simply adds the link to the menu
         */
        function __construct()
        {
            add_action( 'admin_menu', array( $this, 'AddEditPostLink' ) );
        }
        
        /**
         * Gets the last post that was published.
         * @return object  the WP_Post object for the last post that was published.
         */
        function GetLastPost()
        {
            $args = array(
                'posts_per_page' => '1',
            );
            
            $posts = get_posts( $args );
            
            return $posts[0];
        }
        
        /**
         * Generates the slug that will be used as the link for th eEdit most recent post menu item
         * @return String  The url for editing the most recently published post.
         */
        function GenerateEditPostLink()
        {
            $recent_post = $this->GetLastPost();
            
            return 'post.php?post=' . $recent_post->ID . '&action=edit';
        }
        
        /**
         * Adds the link to edit the most recent post as a submenu item of the Posts menu item.
         */
        function AddEditPostLink()
        {
            add_posts_page( '', 'Edit most recent post', 'edit_posts', $this->GenerateEditPostLink() );
        }
    }
    
//SInitiatest the class    
$herc_edit_last_post = new HercEditLastPost;

?>