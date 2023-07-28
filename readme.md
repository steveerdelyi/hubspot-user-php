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

And finally, initialize the HubspotUser class:
`$hubspot_user = new HubspotUser('YOUR_HUBSPOT_API_KEY');`