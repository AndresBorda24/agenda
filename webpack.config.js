const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require('webpack');
const dotenv = require('dotenv');

dotenv.config();

const web = {
    entry: "./src/js/index.js",
    output: {
        filename: "index.js",
        path: path.resolve(__dirname, 'public/js')
    },
    plugins: [
        new webpack.DefinePlugin({
           'process.env': JSON.stringify(process.env)
        }),
        new MiniCssExtractPlugin({
            filename: "../css/app.css"
        })
    ],
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
            {
                test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/i,
                // More information here https://webpack.js.org/guides/asset-modules/
                type: "asset",
                generator: {
                    filename: '../assets/[hash][ext][query]'
                }
            },
        ]
    }
}

module.exports = web;
