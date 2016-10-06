SETUP
wp-config.php
	define( 'WP_AUTO_UPDATE_CORE', false );

.gitignore
	gruntfile.js, bower.json, package.json

UPDATES
css/scss/_global.scss
	$global-width: rem-calc(1140) !default;
style.css
	version number to match foundation version
package.json
	version number

SLICK SLIDER
css/scss/_slick.scss
	.slick-slide img {
		display: block;
		width: 100%;
        background-size: cover;
	}
css/scss/_slick-theme.scss
	$slick-font-path: "../fonts/" !default;
	$slick-dot-color: #fff !default;
	$slick-dot-size: 15px !default;
	.slick-list {
	    .slick-loading & {
	        background: #fff url("../images/slides/ajax-loader.gif") center center no-repeat;
	    }
	}
	.slick-prev,
	.slick-next {
	    position: absolute;
	    display: block;
	    height: 20px;
	    width: 20px;
	    line-height: 0px;
	    font-size: 0px;
	    cursor: pointer;
	    background: transparent;
	    color: transparent;
	    top: 50%;
	    margin-top: -10px;
	    padding: 0;
	    border: none;
	    outline: none;
	    z-index: 99;
	    &:hover, &:focus {
	        outline: none;
	        background: transparent;
	        color: transparent;
	        &:before {
	            opacity: $slick-opacity-on-hover;
	        }
	    }
	    &.slick-disabled:before {
	        opacity: $slick-opacity-not-active;
	    }
	}
	.slick-prev {
	    left: 0;
	    [dir="rtl"] & {
	        left: auto;
	        right: -25px;
	    }
	    &:before {
	        content: $slick-prev-character;
	        [dir="rtl"] & {
	            content: $slick-next-character;
	        }
	    }
	}
	.slick-next {
	    right: 0;
	    [dir="rtl"] & {
	        left: -25px;
	        right: auto;
	    }
	    &:before {
	        content: $slick-next-character;
	        [dir="rtl"] & {
	            content: $slick-prev-character;
	        }
	    }
	}
	.slick-dots {
		bottom: 15px;
		margin: 0;
	}