const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: "./src/js/index.js",
    // watch: true,
    output: {
        filename: "index.js",
        path: path.resolve(__dirname, 'public/js')
    },
    plugins: [new MiniCssExtractPlugin({
        filename: "../css/app.css"
    })],
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
