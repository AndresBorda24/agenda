const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: "./src/js/index.js",
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
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
                generator: {  //If emitting file, the file path is
                    filename: '../fonts/[hash][ext][query]'
                }
            },
        ]
    }
}
