const mix = require('laravel-mix');
const webpack = require("webpack");
const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');
const WebpackRTLPlugin = require('webpack-rtl-plugin');
const del = require('del');
const LiveReloadPlugin = require('webpack-livereload-plugin');

// arguments/params from the line command
const args = getParameters();

const dir = 'resources';


mix.options({
    cssNano: {
        discardComments: false,
    }
});


// Remove existing generated assets from public folder
del.sync([
    'public/assets/js/app.js',
    // uncomment if wanna make the plugins is rebuild
    'public/assets/plugins/global/plugins.bundle.*',
    'public/assets/**/custom.bundle.*',
    'public/assets/js/custom',
    'public/assets/css/custom',
]);

mix.js("resources/mix/app.js", "public/assets/js/app.js").webpackConfig({
    plugins: [
        new webpack.DefinePlugin({
            'process.env.PUSHER_APP_KEY': JSON.stringify(process.env.PUSHER_APP_KEY),
            'process.env.WS_HOST': JSON.stringify(process.env.WS_HOST),
            'process.env.PUSHER_APP_CLUSTER': JSON.stringify(process.env.PUSHER_APP_CLUSTER),

        }),
    ],
});


// dont touch , uncomment if wanna including new package on the plugins 
// Build 3rd party plugins css/js

mix.sass('resources/mix/plugins.scss', `public/assets/plugins/global/plugins.bundle.css`).then(() => {
    // remove unused preprocessed fonts folder
    rimraf(path.resolve('public/fonts'), () => {
    });
    rimraf(path.resolve('public/images'), () => {
    });
}).sourceMaps(!mix.inProduction())
    .options({ processCssUrls: false })
    .scripts(require('./resources/mix/plugins.js'), `public/assets/plugins/global/plugins.bundle.js`);


// Build theme css/js to rebuild just uncomment below lines and delete the public/assets/css/style.bundle.css

// mix.sass(`${dir}/sass/style.scss`, `public/assets/css/style.bundle.css`, { sassOptions: { includePaths: ['node_modules'] } })
//     // .options({processCssUrls: false})
//     .scripts(require(`./resources/mix/scripts.js`), `public/assets/js/scripts.bundle.js`); // Add this line for minification;



// if wanna store the plugins as npm deps uncomment below lines 

// // Build custom 3rd party plugins
// (glob.sync(`resources/vendors/**/*.js`) || []).forEach(file => {
//     mix.scripts(require('./' + file), `public/assets/${file.replace('resources/vendors/', 'plugins/custom/')}`);
// });

// (glob.sync(`resources/vendors/**/*.scss`) || []).forEach(file => {
//     mix.sass(file, `public/assets/${file.replace('resources/vendors/', 'plugins/custom/').replace('scss', 'css')}`);
// });

// the custom bundling

// JS pages (single page use) if use remove if using inline script
// (glob.sync(`${dir}/js/custom/**/*.js`) || []).forEach(file => {
//     // bundle all js except index.js
//     if(file.includes('index.js')) return ;
//     var output = `public/assets/${file.replace(`${dir}/`, '')}`;
//     mix.js(file, output);
// });

// (glob.sync(`${dir}/sass/custom/**/*.scss`) || []).forEach(file => {
//     var output = `public/assets/${file.replace(`${dir}/sass`, 'css').replace("scss", "css")}`;
//     mix.sass(file, output);
// });

mix.js("resources/js/custom/index.js","public/assets/js/custom.bundle.js");
mix.sass("resources/sass/custom/index.scss","public/assets/css/custom.bundle.css");

let plugins = [
    new ReplaceInFileWebpackPlugin([
        {
            // rewrite font paths
            dir: path.resolve(`public/assets/plugins/global`),
            test: /\.css$/,
            rules: [
                {
                    // keenicons
                    search: /url\('fonts\/(keenicons-(duotone|solid|outline))\.(.*?)'?\)/g,
                    replace: 'url(./fonts/$1/$1.$3)',
                },
            ],
        },
    ]),
    new LiveReloadPlugin({
        useSourceHash: true,
    })
];
if (args.indexOf('rtl') !== -1) {
    plugins.push(new WebpackRTLPlugin({
        filename: '[name].rtl.css',
        options: {},
        plugins: [],
        minify: false,
    }));
}

mix.webpackConfig({
    plugins: plugins,
    ignoreWarnings: [{
        module: /esri-leaflet/,
        message: /version/,
    }],
});







// Widgets
// mix.scripts((glob.sync(`${dir}/js/widgets/**/*.js`) || []), `public/assets/js/widgets.bundle.js`).minify('public/assets/js/widgets.bundle.js');

function getParameters() {
    var possibleArgs = [
        'rtl'
    ];
    for (var i = 0; i <= 13; i++) {
        possibleArgs.push('demo' + i);
    }

    var args = [];
    possibleArgs.forEach(function (key) {
        if (process.env['npm_config_' + key]) {
            args.push(key);
        }
    });

    return args;
}
