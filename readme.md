# hubspot-user-php

This package allows you to seamlessly integrate with user data stored in Hubspot CRM. You can easily access user data via PHP or JavaScript with some minor additional setup.

## Before You Get Started
You will need a Hubspot API key in order to use this package. If you don't already have an API key, you can learn how to generate one [here](https://knowledge.hubspot.com/integrations/how-do-i-get-my-hubspot-api-key).

## Installation
This package can be installed using composer:
`composer require steve-erdelyi/hubspot-user-php`

## Quick Start
To use this package, the first thing you need to do is ensure you have already required the autoload file in your PHP template file:
`require 'PATH_TO_YOUR_INSTALLATION/vendor/autoload.php';`

Next, tell PHP to use the class namespace:
`use HubspotUser/HubspotUser;`

And finally, initialize the HubspotUser class and access a variable:
`$hubspot_user = new HubspotUser('YOUR_HUBSPOT_API_KEY');`
`$first_name = $hubspot_user->name->first;`
`$last_name = $hubspot_user->name->last;`
`$full_name = $hubspot_user->name->full;`
`$email = $hubspot_user->email;`

## Use User Variables via JavaScript
You might want to access these variables from JavaScript so you can easily perform client-side personalizations. In order to use variables via JavaScript, you must output the HubspotUser data to the page by adding the following line somewhere inside your page's `<head>` tag:
`<?= $hubspot_user->output(); ?>`

After adding the output function inside your `<head>` tag, you can simply call the variables globally via JavaScript:
`let first_name = hubspot_user.name.first;`
`let last_name = hubspot_user.name.last;`
`let full_name = hubspot_user.name.full;`
`let email = hubspot_user.email;`

## Changing Your Hubspot UTK Cookie Name
By default, this package relies on the standard Hubspot UTK cookie name `hubspotutk`. If you need to override the cookie name used to find your Hubpot UTK, you can simply pass a string variable containing your custom name as the second parameter when initializing your class:
`$hubspot_user = new HubspotUser('YOUR_HUBSPOT_API_KEY', 'YOUR_CUSTOM_UTK_COOKIE_NAME');`
