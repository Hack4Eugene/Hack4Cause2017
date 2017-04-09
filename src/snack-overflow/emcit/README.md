# EmCit

## Tools Required

- npm
- node (9.7)
- python (2.7)
- pip
- virtualenv

## Javascript dependencies

See `client/package.json` for javascript dependencies

## Python dependencies

See `requirements.txt` from python dependencies

## Setup

This was written last minute, and may be incomplete.

- `virtualenv venv`
- `source venv/bin/active`
- `pip install -r requirements.txt`
- `cd client`
- `npm install`

## Create the database

`./manage.py create_db`

## Seed the database

`./manage.py seed_db`

## Building the Javascript

Enter the client directory

`cd client`

Install dependencies

`npm install`

### Watching the javascript

To watch (reload output on file changes) mobile or desktop:

`npm run watch-mobile`
`npm run watch-desktop`

To just build, but not watch:

`npm run build-mobile`
`npm run build-desktop`

## Run the development server

`./manage.py runserver -dr`

## Make hosts file entries

Edit `/etc/hosts` and add:

`127.0.0.1 mobile.emcit`
`127.0.0.1 desktop.emcit`

## Use app

Visit `mobile.emcit:5000` for mobile

Visit `desktop.emcit:5000` from desktop

## Login

Desktop:

- adam@example.com with password `1234` for analytics
- alice@example.com with password `1234` for admin

Mobile:

- rob@example.com with password `1234` for reporting
