# \<com-eng\>



## Install the Polymer-CLI

First, make sure you have the [Polymer CLI](https://www.npmjs.com/package/polymer-cli) installed. Then run `polymer serve` to serve your application locally.

## Viewing Your Application

```
$ polymer serve
```

## Building Your Application

```
$ polymer build
```

This will create a `build/` folder with `bundled/` and `unbundled/` sub-folders
containing a bundled (Vulcanized) and unbundled builds, both run through HTML,
CSS, and JS optimizers.

You can serve the built versions by giving `polymer serve` a folder to serve
from:

```
$ polymer serve build/bundled
```

## Running Tests

```
$ polymer test
```

Your application is already set up to be tested via [web-component-tester](https://github.com/Polymer/web-component-tester). Run `polymer test` to run your application's test suite locally.

# API Endpoints
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/ef5e5d0cb73ae66283c0)

Refer to the Data models in the API folder for examples of how to complete these API calls.

URL: https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/
- POST
- OPTIONS

URL: https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/listissues
- GET
- OPTIONS

URL: https://gabezjlby1.execute-api.us-west-2.amazonaws.com/Hacktest/issue
- GET 
-- Requires querystring parameter id, where id = issueID of the issue you want
- PUT
- OPTIONS

GET / only has hard coded demo data GET /listissues uses the DB for dummy data

Refer to post-model.json for POST method body request information

# License Information

MIT License

Copyright (c) 2017 Team Dumpster Fire (Allen McNichols, Antonio Oretega Jr, Richard Owens, Seabastion Miller, Lee Ralls,  Yves Gurcan, Tyson Bishop, Shanon Sallaway, Charlie Chang, Bishop Lafer)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.