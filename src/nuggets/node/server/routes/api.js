const Promise = require('bluebird');
const _ = require('lodash');
const request = require('superagent');


module.exports = function (app) {
    const connections = app.get('connections');
    const db = connections.sqlite;
    const config = app.get('config');

    const geoLib = require('../lib/geocode')(app);
    const queries = require('../lib/queries');
    const weatherLib = require('../lib/weather')(app);

    app.get('/convert/address/latlong', function (req, res) {
        console.log('hey');
        console.log('GET convert address to latlong endpoint called');
        const dbname = req.query.dbname;

        if (!dbname) {
            console.log('Must include dbname in query!');
            return res.status(400).send('Must include dbname in query');
        }

        console.log(`Querying dbname ${dbname}`);
        // if lat long values don't exist create them
        db.all(`SELECT lat from ${dbname} LIMIT 1`, function (err, response) {
            if (err) {
                console.log('Adding lat column to db');
                db.run(`ALTER TABLE ${dbname} ADD COLUMN lat TEXT`);
            } else {
                console.log(response);
                console.log('lat column exists');
            }
        });

        db.all(`SELECT lng from ${dbname} LIMIT 1`, function (err, response) {
            if (err) {
                console.log('Adding lng column to db');
                db.run(`ALTER TABLE ${dbname} ADD COLUMN lng TEXT`);
            } else {
                console.log(response);
                console.log('lng column exists');
            }
        });

        // iterate through db and convert addresses to lat long
        db.all(`SELECT  * FROM ${dbname}`, function (err, record) {
            if (err) {
                console.log(`error: ${err}`);
            }
            let count = 0;
            let updated = 0;
            record.forEach(function (row) {
                count++;
                // if lat long values are null call google api to convert

                console.log(`Converting address: ${row.address}`);

                if (row.lat == null || row.lng == null) {
                    geoLib.convertAddressToLatLong(`${row.address}, Eugene OR`)
                        .then(response => {
                            updated++;
                            console.log('Udpating db with values');
                            console.log(`UPDATE ${dbname} SET lat=${response.lat} WHERE address="${row.address}"`);
                            console.log(`UPDATE ${dbname} SET lng=${response.lng} WHERE address="${row.address}"`);
                            db.run(`UPDATE ${dbname} SET lat=${response.lat} WHERE address="${row.address}"`);
                            db.run(`UPDATE ${dbname} SET lng=${response.lng} WHERE address="${row.address}"`);
                            // res.status(200).send(response);
                        })
                        .catch(error => console.log(`ERROR OCCURRED AT API.JS: ${error}`));
                } else {
                    console.log('Skipping address, already has lat and lng');
                    console.log(row.address);
                }
            });

            res.status(200).send(`Found ${count} records, updated ${updated}`);
        });
    });

    app.get('/parking/setup', function (req, res) {
        const dbname = 'parkingCit2007';

        dbAll(`SELECT Location, SanitizedLocation, lat, lon FROM ${dbname}`)
            .then(function (recordSet) {
                const promiseStack = recordSet.map(function (record) {
                    return updateParkingLocation.bind(undefined, dbname, record);
                });
                return Promise.map(promiseStack, function (fun) {
                    return fun();
                }, { concurrency: 5 });
            })
            .then(function (result) {
                return dbAll(`SELECT Location, SanitizedLocation, lat, lon FROM ${dbname}`);
            })
            .then(function (result) {
                res.status(200).send(result);
            })
            .catch(function (err) {
                console.log(queryCache);
                console.error(err);
                console.error(err.stack);
                res.status(500).send({ error: err });
            });
    });

    function dbAll(query) {
        return new Promise(function (resolve, reject) {
            db.all(query, function (err, recordSet) {
                if (err) {
                    console.error(`Failed Query: ${query}`);
                    return reject(err);
                }
                return resolve(recordSet);
            });
        });
    }

    function dbRun(query) {
        return new Promise(function (resolve, reject) {
            db.run(query, function (err, recordSet) {
                if (err) {
                    console.error(`Failed Query: ${query}`);
                    return reject(err);
                }
                return resolve(recordSet);
            });
        });
    }

    function processLocation(location) {
        let locationArray = [];
        let outputFormat = 'N/A';
        if (_.isString(location)) {
            locationArray = location.split(' ');
            outputFormat = `${locationArray[0]} ${locationArray[2]}`;
        }
        return outputFormat;
    }

    const searchTermCache = {};

    function geoQuery(searchTerm) {
        if (!searchTermCache[searchTerm]) {
            return geoLib.convertAddressToLatLong(`${searchTerm}, Eugene, OR`)
                .then(function (result) {
                    searchTermCache[searchTerm] = result;
                    return result;
                });
        } else {
            return Promise.resolve(searchTermCache[searchTerm]);
        }
    }

    const queryCache = {};

    function updateRowWithGeoResult(dbname, record, sanitizedLocation, lat, lon) {
        const query = `UPDATE ${dbname} SET lat="${lat}", lon="${lon}", SanitizedLocation="${sanitizedLocation}" WHERE location="${record.Location}"`;
        if (!queryCache[query]) {
            return dbRun(query)
                .then(function (result) {
                    queryCache[query] = true;
                    return result;
                });
        } else {
            return Promise.resolve();
        }
    }

    function updateParkingLocation(dbname, record) {
        const searchTerm = processLocation(record.Location);
        return geoQuery(searchTerm)
            .then(function (coords) {
                if (coords && coords.lat && coords.lng) {
                    return updateRowWithGeoResult(dbname, record, searchTerm, coords.lat, coords.lng);
                } else {
                    return Promise.resolve();
                }
            });
    }

    app.get('/weather-forecast', function (req, res) {
        console.log('res', res);
         weatherLib.getWeatherForecast()
            .then(response => {
            console.log('response', response);
            res.status(200).send(response);
            })
            .catch(error => console.log(`ERROR OCCURRED AT weather-forecast ${error}`));
        // hook up to weather api and return something cool
    });

    app.get('/weather', function (req, res) {
        // hook up to weather api and return something cool
        request
            .get('api.openweathermap.org/data/2.5/forecast')
            .query({ q: 'Eugene,or', APPID: config.openWeatherMap.key })
            .end(function (err, response) {
                if (err) {
                    res.status(500).send(err);
                }
                res.status(200).send(response.body);
            });
    });

    app.get('/eugeneData', function (req, res) {
        const eugeneTable = 'eugeneOverview';

        db.all(`SELECT * FROM ${eugeneTable}`, function (err, records) {
            if (err) {
                return res.status(500).send(err);
            }

            res.status(200).send(records);
        });
    });

    app.get('/development/commercial', function (req, res) {
        const categoryTable = 'DEVELOPMENT_COM';

        db.all(`${queries[categoryTable]}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/development/residential', function (req, res) {
        const categoryTable = 'DEVELOPMENT_RES';

        db.all(`${queries[categoryTable]}`, function (err, records) {
            if (err) {
                console.log(err);
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/housing', function (req, res) {
        const categoryTable = 'HOUSING';

        db.all(`${queries[categoryTable]}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/income', function (req, res) {
        const categoryTable = 'INCOME';

        db.all(`${queries[categoryTable]}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/parking', function (req, res) {
        const categoryTable = 'PARKING';

        db.all(`${queries[categoryTable]}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/categories', function (req, res) {
        const categoryTable = 'category';

        db.all(`SELECT * FROM ${categoryTable}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });

    app.get('/data/for/category/:id', function (req, res) {
        const categoryId = req.params.id;

        db.all(`SELECT * FROM category WHERE id = ${categoryId}`, function (err, records) {
            if (err) {
                res.status(500).send(err);
            }
            res.status(200).send(records);
        });
    });
};
