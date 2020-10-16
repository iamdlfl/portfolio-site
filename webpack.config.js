const path = require('path');

const postCSSPlugins = [
    require('postcss-import'),
    require('postcss-simple-vars'),
    require('postcss-nested'),
    require('autoprefixer')
]

module.exports = {
    mode: 'development',
    entry: './app/assets/scripts/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'app')
    },
    devServer: {
        before: function(app, server) {
            server._watch('./app/**/*.html')
        },
        contentBase: path.join(__dirname, 'app'),
        hot: true,
        port: 4000,
        host: '0.0.0.0',
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [
                    'style-loader',
                    'css-loader?url=false',
                    {
                        loader: 'postcss-loader', 
                        options: {
                            postcssOptions: {plugins: postCSSPlugins}
                        }
                    }
                ]
            }
        ]
    }
};