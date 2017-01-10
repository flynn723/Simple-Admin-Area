<?php
/*
Admin Class for the Simple Admin Area
Version 1.0

Author: Justin Estrada
Plugin URI: http://justinestrada.com/wordpress-plugins?plugin=simple-admin-area
*/
$color1 = get_option('color1');
$color2 = get_option('color2');
$color3 = get_option('color3');
$color4 = get_option('color4');
?>
<style type="text/css">
input[type=checkbox]:checked:before{color:<?php echo $color2; ?>}
input[type=radio]:checked:before{background:<?php echo $color2; ?>}
.wp-core-ui input[type=reset]:active,.wp-core-ui input[type=reset]:hover{color:#0096dd}
.wp-core-ui .button-primary{background:<?php echo $color3; ?>;}
.wp-core-ui .wp-ui-primary{background-color:<?php echo $color2; ?>}
.wp-core-ui .wp-ui-text-primary{color:<?php echo $color2; ?>}
.wp-core-ui .wp-ui-highlight{background-color:<?php echo $color3; ?>}
.wp-core-ui .wp-ui-text-highlight{color:<?php echo $color3; ?>}
.wp-core-ui .wp-ui-notification{background-color:<?php echo $color4; ?>}
.wp-core-ui .wp-ui-text-notification{color:<?php echo $color4; ?>}
.tablenav .tablenav-pages a:focus,.tablenav .tablenav-pages a:hover, .wrap .add-new-h2:hover,.wrap .page-title-action:hover{background-color:<?php echo $color2; ?>}
.view-switch a.current:before{color:<?php echo $color2; ?>}
.view-switch a:hover:before{color:<?php echo $color4; ?>}
#adminmenu,#adminmenuback,#adminmenuwrap{background:<?php echo $color2; ?>}
#adminmenu a:hover,#adminmenu li.menu-top:hover,#adminmenu li.opensub>a.menu-top,#adminmenu li>a.menu-top:focus{background-color:<?php echo $color3; ?>}
#adminmenu .wp-has-current-submenu .wp-submenu,#adminmenu .wp-has-current-submenu.opensub .wp-submenu,#adminmenu .wp-submenu,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu,.folded #adminmenu .wp-has-current-submenu .wp-submenu{background:<?php echo $color1; ?>}
#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after{border-right-color:<?php echo $color1; ?>}
#adminmenu .wp-has-current-submenu .wp-submenu a:focus,#adminmenu .wp-has-current-submenu .wp-submenu a:hover,#adminmenu .wp-has-current-submenu.opensub .wp-submenu a:focus,#adminmenu .wp-has-current-submenu.opensub .wp-submenu a:hover,#adminmenu .wp-submenu a:focus,#adminmenu .wp-submenu a:hover,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:focus,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:hover,.folded #adminmenu .wp-has-current-submenu .wp-submenu a:focus,.folded #adminmenu .wp-has-current-submenu .wp-submenu a:hover{color:<?php echo $color3; ?>}
#adminmenu .wp-has-current-submenu.opensub .wp-submenu li.current a:focus,#adminmenu .wp-has-current-submenu.opensub .wp-submenu li.current a:hover,#adminmenu .wp-submenu li.current a:focus,#adminmenu .wp-submenu li.current a:hover,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a:focus,#adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a:hover{color:<?php echo $color3; ?>}
#adminmenu li.current a.menu-top,#adminmenu li.wp-has-current-submenu .wp-submenu .wp-submenu-head,#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,.folded #adminmenu li.current.menu-top{color:#fff;background:<?php echo $color3; ?>}
#adminmenu .awaiting-mod,#adminmenu .update-plugins{background:<?php echo $color4; ?>}
#adminmenu li a.wp-has-current-submenu .update-plugins,#adminmenu li.current a .awaiting-mod,#adminmenu li.menu-top:hover>a .update-plugins,#adminmenu li:hover a .awaiting-mod{background:<?php echo $color1; ?>}
#collapse-button:focus,#collapse-button:hover{color:<?php echo $color3; ?>}
#wpadminbar{background:<?php echo $color2; ?>}
#wpadminbar .ab-top-menu>li.menupop.hover>.ab-item,#wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus,#wpadminbar.nojs .ab-top-menu>li.menupop:hover>.ab-item,#wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item,#wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{color:<?php echo $color3; ?>;background:<?php echo $color1; ?>}#wpadminbar:not(.mobile)>#wp-toolbar a:focus span.ab-label,#wpadminbar:not(.mobile)>#wp-toolbar li.hover span.ab-label,#wpadminbar:not(.mobile)>#wp-toolbar li:hover span.ab-label{color:<?php echo $color3; ?>}
#wpadminbar .menupop .ab-sub-wrapper{background:<?php echo $color1; ?>}
#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a,#wpadminbar .quicklinks .menupop ul li a:focus,#wpadminbar .quicklinks .menupop ul li a:focus strong,#wpadminbar .quicklinks .menupop ul li a:hover,#wpadminbar .quicklinks .menupop ul li a:hover strong,#wpadminbar .quicklinks .menupop.hover ul li a:focus,#wpadminbar .quicklinks .menupop.hover ul li a:hover,#wpadminbar li #adminbarsearch.adminbar-focused:before,#wpadminbar li .ab-item:focus .ab-icon:before,#wpadminbar li .ab-item:focus:before,#wpadminbar li a:focus .ab-icon:before,#wpadminbar li.hover .ab-icon:before,#wpadminbar li.hover .ab-item:before,#wpadminbar li:hover #adminbarsearch:before,#wpadminbar li:hover .ab-icon:before,#wpadminbar li:hover .ab-item:before,#wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus,#wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover{color:<?php echo $color3; ?>}
#wpadminbar .menupop .menupop>.ab-item:hover:before,#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a .blavatar,#wpadminbar .quicklinks li a:focus .blavatar,#wpadminbar .quicklinks li a:hover .blavatar,#wpadminbar.mobile .quicklinks .ab-icon:before,#wpadminbar.mobile .quicklinks .ab-item:before{color:<?php echo $color3; ?>}
#wpadminbar #wp-admin-bar-user-info a:hover .display-name{color:<?php echo $color3; ?>}
.wp-pointer .wp-pointer-content h3{background-color:<?php echo $color3; ?>}
.wp-pointer .wp-pointer-content h3:before{color:<?php echo $color3; ?>}
.wp-pointer.wp-pointer-top .wp-pointer-arrow,.wp-pointer.wp-pointer-top .wp-pointer-arrow-inner,.wp-pointer.wp-pointer-undefined .wp-pointer-arrow,.wp-pointer.wp-pointer-undefined .wp-pointer-arrow-inner{border-bottom-color:<?php echo $color3; ?>}
.media-item .bar,.media-progress-bar div{background-color:<?php echo $color3; ?>}
.details.attachment{-webkit-box-shadow:inset 0 0 0 3px #fff,inset 0 0 0 7px <?php echo $color3; ?>;box-shadow:inset 0 0 0 3px #fff,inset 0 0 0 7px <?php echo $color3; ?>}
.attachment.details .check{background-color:<?php echo $color3; ?>;-webkit-box-shadow:0 0 0 1px #fff,0 0 0 2px <?php echo $color3; ?>;box-shadow:0 0 0 1px #fff,0 0 0 2px <?php echo $color3; ?>}
.media-selection .attachment.selection.details .thumbnail{-webkit-box-shadow:0 0 0 1px #fff,0 0 0 3px <?php echo $color3; ?>;box-shadow:0 0 0 1px #fff,0 0 0 3px <?php echo $color3; ?>}
.theme-browser .theme.active .theme-name,.theme-browser .theme.add-new-theme a:focus:after,.theme-browser .theme.add-new-theme a:hover:after{background:<?php echo $color3; ?>}
.theme-browser .theme.add-new-theme a:focus span:after,.theme-browser .theme.add-new-theme a:hover span:after{color:<?php echo $color3; ?>}
.theme-filter.current,.theme-section.current{border-bottom-color:<?php echo $color2; ?>}
body.more-filters-opened .more-filters{background-color:<?php echo $color2; ?>}
body.more-filters-opened .more-filters:focus,body.more-filters-opened .more-filters:hover{background-color:<?php echo $color3; ?>;}
.widgets-chooser li.widgets-chooser-selected{background-color:<?php echo $color3; ?>;}
.wp-responsive-open div#wp-responsive-toggle a{border-color:transparent;background:<?php echo $color3; ?>}
.wp-responsive-open #wpadminbar #wp-admin-bar-menu-toggle a{background:<?php echo $color1; ?>}
.mce-container.mce-menu .mce-menu-item-normal.mce-active,.mce-container.mce-menu .mce-menu-item-preview.mce-active,.mce-container.mce-menu .mce-menu-item.mce-selected,.mce-container.mce-menu .mce-menu-item:focus,.mce-container.mce-menu .mce-menu-item:hover{background:<?php echo $color3; ?>}
li.menu-top a:hover, li.menu-top a:focus{color: #fff !important;}li.menu-top:hover .wp-menu-image:before, li.menu-top:focus .wp-menu-image:before{color: #fff !important;}
</style>