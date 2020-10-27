const currentTask = process.env.npm_lifecycle_event;
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');

const path = require('path');
const fse = require('fs-extra');


const postCSSPlugins = [
    require('postcss-import'),
    require('postcss-simple-vars'),
    require('postcss-nested'),
    require('postcss-hexrgba'),
    require('autoprefixer')
]

class RunAfterCompile {
    apply(compiler) {
        compiler.hooks.done.tap('Copy Images', function () {
            fse.copySync('./app/assets/about_pics', './dist/assets/about_pics');
            fse.copySync('./app/assets/index_pics', './dist/assets/index_pics');
            fse.copySync('./app/assets/edu_files', './dist/assets/edu_files');
            fse.copySync('./app/assets/proj_files', './dist/assets/proj_files');
            fse.copySync('./app/assets/OldSite', './dist/assets/OldSite');
        });
    }
}

let pages = fse.readdirSync('./app').filter(function (file) {
    let returnValue = null;
    if (file.endsWith('.html')) {
        returnValue = file.endsWith('.html');
    }
    if (file.endsWith('.php')) {
        returnValue = file.endsWith('.php');
    }
    return returnValue;
}).map(function (page) {
    return new HtmlWebpackPlugin({
        filename: page,
        template: `./app/${page}`
    })
});

let cssConfig = {
    test: /\.css$/i,
    use: [
        'css-loader?url=false',
        {
            loader: 'postcss-loader',
            options: {
                postcssOptions: { plugins: postCSSPlugins }
            }
        }
    ]
}

let config = {
    entry: './app/assets/scripts/index.js',
    plugins: pages,
    module: {
        rules: [
            cssConfig
        ]
    }
};

if (currentTask == "dev" || currentTask == "devserv") {

    cssConfig.use.unshift('style-loader');

    config.output = {
        filename: 'main.js',
        path: path.resolve(__dirname, 'app')
    };

    config.devServer = {
        before: function (app, server) {
            server._watch('./app/**/*.html')
        },
        contentBase: path.join(__dirname, 'app'),
        hot: true,
        port: 4000,
        host: '0.0.0.0',
    };

    config.mode = 'development';

}


if (currentTask == "build") {
    config.module.rules.push({
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
            loader: 'babel-loader',
            options: {
                presets: ['@babel/preset-env']
            }
        }
    });

    cssConfig.use.unshift(MiniCssExtractPlugin.loader);

    postCSSPlugins.push(require('cssnano'));

    config.output = {
        filename: '[name].[chunkhash].js',
        chunkFilename: '[name].[chunkhash].js',
        path: path.resolve(__dirname, 'dist')
    };

    config.mode = 'production';

    config.optimization = {
        splitChunks: {
            chunks: 'all'
        }
    };

    config.plugins.push(
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin({ filename: 'styles.[chunkhash].css' }),
        new RunAfterCompile()
    );

}


module.exports = config;