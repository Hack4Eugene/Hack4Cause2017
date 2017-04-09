const express = require('express');
const bodyParser = require('body-parser');
const NodeCache = require('node-cache');

const config = require('./config');
const routes = require('./routes');

const app = express();

const buildApp = function (connections) {
    app.set('connections', connections);
    app.set('cache', new NodeCache({ stdTTL: config.cache.defaultTtl }));
    app.set('config', config);

    // parse application/x-www-form-urlencoded
    app.use(bodyParser.urlencoded({ extended: false }));

    // parse application/json
    app.use(bodyParser.json());

    app.use(function () {
        return function allowCrossDomain(req, res, next) {
            res.header('Access-Control-Allow-Origin', '*');
            if (req.method === 'OPTIONS') {
                res.status(200).send();
            } else {
                next();
            }
        };
    }());

    routes(app);

    app.set('ready', true);

    app.listen(config.web.api.port, function () {
        app.set('ready', true);

        // Emit ready event (tests listen for this)
        app.emit('app:ready');
    });

    app.on('app:ready', function () {
        console.log(`Application has successfully started and is ready to start receiving requests at port ${config.web.api.port}`, 'Server');
    });
};

require('./lib/connections')(config)
    .then(function (connections) {
        buildApp(connections);
    })
    .catch(function (err) {
        console.log(err);
        process.exit(1);
    });
