const agent = require('superagent');
const Promise = require('bluebird');
const _ = require('lodash');

module.exports = function (app) {
    const config = app.get('config');

    function getWeatherForecast() {
        const deferred = Promise.defer();
        agent
            .get('https://api.darksky.net/forecast/006125af506b0df4ab8405ab02dca573/44.0521,-123.0868')
            .end(function (err, response) {
                if (err) {
                    // console.log('An error occurred:');
                    // console.log(err);
                    deferred.reject(err);
                } else {
                    // console.log('latlong:');
                    // console.log(latlong);
                    deferred.resolve(response);
                }
            });
        return deferred.promise;
    }

    return {
        getWeatherForecast
    };
};
