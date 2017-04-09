const sqlite3 = require('sqlite3');
const Promise = require('bluebird');

module.exports = function (config) {
    return new Promise((resolve, reject) => {
        const db = new sqlite3.Database(config.db.path);
        resolve({
            sqlite: db
        });
    });
};
