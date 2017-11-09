
# Project Name

__The project tagline is cool and witty__

This is where you write a paragrah or so describing your project to the person
reading it knows what your project is all about. You could skip this part but
after all the hard work you put into creating your project, it would be a shame
if nobody ever used it, because you didn't take the time to explain it to them.
You don't have to write a lot - just enough to get them interested.


## Current Features

* First feature
* Second feature
* Third feature that is even better than the first two
* Another great thing your project does



## Installation and Setup

1. Step One
1. Step Two
1. Step Three
1. Step Four



## Custom Widgets

* Step One
* Step Two
* Step Three
* Step Four



## Custom Actions 

### action_name

Describe what the action does. Perhaps a couple of sentences. 
Just enough enable someone to use it.

**Example Code**

```
function mytheme_say_hello(){
	echo 'Hello World';
}
add_action('mytheme_hello_world', 'mytheme_say_hello');

// Somewhere in your theme
do_action( 'mytheme_hello_world' );
``` 



## Custom Filters 

### filter_name

Describe what the filter does. how many arguments are there, and what types they
are. They'll help your team before effective using your theme. 

**Example Code**

```
function mytheme_say_hello(){
	$name = apply_filters( 'person_name', 'world' );

	echo "Hello {$name}";
}

function mytheme_person_name( $name ) {
	if ( 'world' === $name ) {
		$name = 'Me';
	}
	return $name;
} 

add_filter( 'person_name', 'mytheme_person_name' );
``` 


## Frequently Asked Questions

__First Question?__

This is the first answer

__Second Question?__

Second answer



## Credits and Acknowledgments

Created and Maintained by [Firstname Lastname](http://example.com)



## About The Project

* [Changelog](../../blob/master/CHANGELOG.md)
* [GPL](http://opensource.org/licenses/GPL-3.0)



## Submit Bugs & or Fixes:

[Project Issues](https://github.com/your-github-id/your-project/issues)


