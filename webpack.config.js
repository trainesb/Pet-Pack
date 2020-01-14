const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    entry: './src/js/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist')
    },
    target: "node",
    node: {
        fs: 'empty'
    },
    devtool: 'source-map',
    plugins: [
        new CopyWebpackPlugin([
            {
                from: 'src/img/products/*',
                to: 'img',
                flatten: true
            }
        ])
    ],
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    'style-loader',
                    'css-loader',
                    'resolve-url-loader',
                    'sass-loader?sourceMap'
                ]
            }
        ]
    }
};
