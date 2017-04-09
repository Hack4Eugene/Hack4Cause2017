const path = require('path');

const projectDir = path.resolve(__dirname, '../../');

module.exports = {
    db: {
        path: path.resolve(projectDir, './data/db.sqlite')
    },
    web: {
        api: {
            port: 3001
        }
    },
    cache: {
        defaultTtl: 1440
    },
    "google": {
        key: "AIzaSyDN-L_XluD83Bs1oojM-X2UgZQGcEe33m8"
    },
    openWeatherMap: {
        key: '5f9f878f5cf88bc74d376d07475377c7'
    }
};
