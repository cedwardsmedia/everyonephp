# EveryonePHP v1.0.2

[![Source](https://img.shields.io/badge/source-cedwardsmedia/everyonephp-blue.svg?style=flat-square "Source")](https://www.github.com/cedwardsmedia/cnam)
[![Version](https://img.shields.io/badge/version-1.0.2-brightgreen.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/cedwardsmedia/everyonephp.svg?style=flat-square)](https://packagist.org/packages/cedwardsmedia/everyonephp)
[![License](https://img.shields.io/badge/license-BSD-lightgrey.svg?style=flat-square "License")](./LICENSE.md)
[![Gratipay](https://img.shields.io/gratipay/cedwardsmedia.svg?style=flat-square "License")](https://gratipay.com/~cedwardsmedia/)
[![Say Thanks!](https://img.shields.io/badge/Say%20Thanks-!-1EAEDB.svg)](https://saythanks.io/to/cedwardsmedia)

## STOP
Due to the purchase of EveryoneAPI by Neustar and their refusal to offer any type of hobbyist access to their service, this project is officially discontinued. 

## Introduction
_EveryonePHP_ is a PHP library for querying EveryoneAPI. The original code was developed as part of [_CNAM-CLI_](https://github.com/cedwardsmedia/cnam-cli) and [_webCNAM_](https://github.com/cedwardsmedia/webcnam) before being forked into a stand-alone library. If you need a Python module for EveryoneAPI, consider trying [EveryoneAPI.py](https://github.com/cedwardsmedia/everyoneapi.py).

In order to use _EveryonePHP_, you must have an [EveryoneAPI account](https://www.everyoneapi.com/sign-up)  with [available funds](https://www.everyoneapi.com/pricing).

## Installation

I highly recommend using _Composer_ to install _EveryonePHP_ for your project. _Composer_ will allow you to automatically install the _GuzzleHttp_ library, which _EveryonePHP_ depends on.

1. Install [Composer](https://getcomposer.org/download/)
2. `cd` to your project's directory
3. Run `composer require cedwardsmedia/everyonephp`
4. Build your amazing project!


## Usage

I have never been a great programmer. As such, I strived to make EveryonePHP as simple to use as possible and I'm always looking to simplify it even more. Let's build a basic EveryoneAPI client using EveryonePHP:

### Step 1: Instantiate EveryonePHP as an Object
```php
// Instantiate EveryonePHP
$api = new EveryonePHP();
```
Creating a new EveryonePHP object allows us to interact with the class.

### Step 2: Set EveryoneAPI Credentials
```php
// Set EveryoneAPI Credentials
$api->sid = "9e3cef42da225d42bd86feaa80ff47";
$api->token = "65f3ef01462c62f7f4ce7d2156ceee";
```
EveryonePHP needs these credentials in order to query EveryoneAPI. Otherwise, the query will fail. How you obtain and store these credentials is completely up to you, just be sure to set them for each instance of EveryonePHP before calling `query()`.

### Step 3: Set EveryoneAPI Data Points
```php
// Set EveryoneAPI Data Points
$data = array("name", "profile", "cnam", "gender", "image", "address", "location", "line_provider", "carrier", "carrier_o", "linetype");
```
Each data point is optional and all data points are returned by default, unless otherwise specified. In the same way EveryoneAPI uses a comma separated list of identifiers, EveryonePHP uses a simple array to specify the data points you wish to retrieve. EveryonePHP passes these identifiers directly to EveryoneAPI so you will use the same identifiers here as you would in a cURL request.

For a full list of available Data Points, check the [EveryoneAPI Docs](https://www.everyoneapi.com/docs#data-points).

### Step 4: Perform EveryoneAPI Query
```php
// Perform EveryoneAPI query
$api->query($phone, $data);
```
Only `$phone` is required for this function. The function performs the query against EveryoneAPI and stores the results in a stdClass object, in this example, `$api->results`.

### Step 5: Print the Results
```php
// Print results

// Print first name
echo $api->results->data->expanded_name->first;

// Print last name
echo $api->results->data->expanded_name->last;

// Print carrier name
echo $api->results->data->carrier->name;
```
EveryonePHP converts the JSON response from EveryoneAPI into a stdClass object. This allows us to access the entire response for our application. In the above example, we print the first name, last name, and carrier for the given phone number.

### Optional: Error Checking
```php
// Check for Error
if ($api->error) {               // If there's an error
   echo "Error: $api->error";    // Print it out
   exit(1);                      // Exit with status 1
}
```
EveryonePHP will assign error messages, if one occurs, to `$api->error`. You can use this in an `if` statement, as shown above, to halt your application if something has gone wrong.

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request ^^,

## Credits
Concept and original codebase: Corey Edwards ([@cedwardsmedia](https://www.twitter.com/cedwardsmedia))

Optimization and Debugging: Brian Seymour ([@eBrian](http://bri.io))

## License
_EveryonePHP_ is licensed under the **BSD Simplified License**. See LICENSE for more.

---
**Disclaimer**: _EveryonePHP_ is not endorsed by, sponsored by, or otherwise associated with [OpenCNAM](http://www.opencnam.com), [EveryoneAPI](http://www.everyoneapi.com), or [Telo USA, Inc](http://www.telo.com).
