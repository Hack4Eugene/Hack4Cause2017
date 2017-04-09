const agent = require('superagent');
const Promise = require('bluebird');
const _ = require('lodash');

module.exports = function (app) {
    const config = app.get('config');

    function convertAddressToLatLong(address) {
        const deferred = Promise.defer();
        console.log(`Sending request to google geocoding api for address ${address}`);
        const encodedAddress = encodeURI(address);
        agent
            .get('https://maps.googleapis.com/maps/api/geocode/json')
            .query(`address=${encodedAddress}&key=${config.google.key}`)
            .end(function (err, response) {
                if (err) {
                    // console.log('An error occurred:');
                    // console.log(err);
                    deferred.reject(err);
                } else {
                    console.log(response.body);
                    const latlong = (!_.isEmpty(response.body.results)) ? response.body.results[0].geometry.location : null;
                    // console.log('latlong:');
                    // console.log(latlong);
                    deferred.resolve(latlong);
                }
            });
        return deferred.promise;
    }

    return {
        convertAddressToLatLong
    };
};
