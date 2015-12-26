# EveryonePHP v0.0.1-dev

[![Source](https://img.shields.io/badge/source-cedwardsmedia/everyonephp-blue.svg?style=flat-square "Source")](https://www.github.com/cedwardsmedia/cnam)
![Version](https://img.shields.io/badge/version-0.0.0--dev-brightgreen.svg?style=flat-square)
[![License](https://img.shields.io/badge/license-MIT-lightgrey.svg?style=flat-square "License")](./LICENSE)
[![Gratipay](https://img.shields.io/gratipay/cedwardsmedia.svg?style=flat-square "License")](https://gratipay.com/~cedwardsmedia/)

## Note ##
_EveryonePHP_ is a PHP library for querying EveryoneAPI. The original code (and thus, pre-1.0 code, was originally developed as part of [_CNAM_](https://github.com/cedwardsmedia/cnam)). Due to the growing maturity of _CNAM_ and the lack of a reliable PHP class for EveryoneAPI, I decided to fork the original code into a stand-alone library that everyone can use, and continue to expand [_CNAM-CLI_](https://github.com/cedwardsmedia/cnam-cli) and [_webCNAM_](https://github.com/cedwardsmedia/webcnam) separately.

In order to use _EveryonePHP_, you must have an [EveryoneAPI account](https://www.everyoneapi.com/sign-up)  with [available funds](https://www.everyoneapi.com/pricing).

## Installation

1. Clone the repo.
2. Run `php composer.phar install`
3. Rename `config.default.php` to `config.php`.
4. Edit `config.php` and add your EveryoneAPI credentials.
5. Ensure `cnam.php` executable by running `chmod +x /path/to/cnam.php`.

## Usage


```
// Instantiate EveryonePHP
$api = new EveryonePHP();
```
```
// Perform EveryoneAPI query
$api->query($phone, $datapoints);
```
```
// Check for Error
if ($api->error) {               // If there's an error
   echo "Error: $api->error";    // Print it out
   exit(1);                      // Exit with status 1
}
```
```
// Print results
print_r($api->data->data->[datapoint]);
```
### Data Point Selection

Just as with the EveryoneAPI, issuing a query without specifying data points will return all available information for the provided phone number. Alternatively, you may supply a comma separated list of data points to return.

- Use `name` to query for the *name* data point.
- Use `profile` to query for the *profile* data point.
- Use `cnam` to query for the *cnam* data point.
- Use `gender` to query for the *gender* data point.
- Use `image` to query for the *image* data point.
- Use `address` to query for the *address* data point.
- Use `location` to query for the *location* data point. (Included free with `address`)
- Use `provider` to query for the *provider* data point.
- Use `carrier` to query for the *carrier* data point.
- Use `carrier_o` to query for the *carrier_o* data point. (Included free with `carrier`)
- Use `linetype` to query for the *linetype* data point.

Example:
```
// Set phone number
$phone = 5551234567;

// Set data point selection
$datapoints = "name,gender,carrier"

// Instantiate EveryonePHP
$api = new EveryonePHP();

// Perform EveryoneAPI query
$api->query($phone, $datapoints);
```

The above code would populate `$api->data->data->name`, `$api->data->data->gender`, `$api->data->data->carrier` (and `$api->data->data->carrier_o` because it is returned free with `carrier`).

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
_EveryonePHP_ is licensed under the **MIT License**. See LICENSE for more.

---
**Disclaimer**: _EveryonePHP_ is not endorsed by, sponsored by, or otherwise associated with [OpenCNAM](http://www.opencnam.com), [EveryoneAPI](http://www.everyoneapi.com), or [Telo USA, Inc](http://www.telo.com).
