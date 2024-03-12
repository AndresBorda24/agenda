const Encore = require('@symfony/webpack-encore');
const dotenv = require('dotenv-webpack');
const resolve = require('path').resolve;
const { DefinePlugin } = require('webpack');

require("dotenv").config({
    path: `./.env${Encore.isProduction() ? '.prod' : ''}`
});

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath(process.env.APP_PATH + '/build')
    // .setPublicPath('/build')
    .setManifestKeyPrefix('build/')
    .addEntry('index/app', './assets/index/index.js')
    .addEntry('home/app', './assets/home/index.js')
    .addEntry('activar/app', './assets/activar-tarjeta/index.js')
    .addEntry('forgot/app', './assets/forgot/index.js')
    .addEntry('beneficiarios/app', './assets/beneficiarios/index.js')
    .addEntry('agenda/app', './assets/agenda/index.js')
    .addEntry('profile/app', './assets/profile/index.js')
    .addEntry('citas/app', './assets/mis-citas/index.js')
    .addEntry('login/app', './assets/login/index.js')
    .addEntry('registro/app', './assets/registro/index.js')
    .addEntry('planes/app', './assets/planes/index.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .enableVersioning()
    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // dotenv
    .addPlugin(new dotenv({
        ignoreStub: true,
        path: `./.env${Encore.isProduction() ? '.prod' : ''}`
    }))
    .addPlugin(new DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: false
    }))
;

let config = Encore.getWebpackConfig();
config.resolve.alias = {
    '@': resolve(__dirname, './assets')
};

module.exports = config;
