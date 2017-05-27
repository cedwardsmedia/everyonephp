# EveryonePHP Changelog
All notable changes to this project will be documented in this file.

## [1.0.2] - 2017-05-27
#### Changed
- The query now uses HTTP Basic authentication to pass the account SID and token to keep the credentials out of the URL (and thus out of logs)
- The query now uses the HTTPS URL for EveryoneAPI.

### [1.0.1] - 2017-05-22
#### Added
- Added CURLE_COULDNT_RESOLVE_HOST error response
- Added CURLE_COULDNT_RESOLVE_PROXY error response
- Added license to EveryonePHP.php

### [1.0.0] - 2015-12-28

#### Changed
- Split APICaller class from _CNAM_ off as _EveryonePHP_
