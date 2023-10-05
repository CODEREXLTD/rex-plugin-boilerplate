const glob = require('glob');
const fs = require('fs');

// For entry file selection
glob("plugin.php", function(err, files) {
        files.forEach(function(item, index, array) {
            const data = fs.readFileSync(item, 'utf8');
            const mapObj = {
                PLUGIN_NAME_DEVELOPMENT: "PLUGIN_NAME_PRODUCTION"
            };
            const result = data.replace(/PLUGIN_NAME_DEVELOPMENT/gi, function (matched) {
                return mapObj[matched];
            });
            fs.writeFile(item, result, 'utf8', function (err) {
            if (err) return console.log(err);
        });
        console.log('✅  Development asset enqueued!');
    });
});