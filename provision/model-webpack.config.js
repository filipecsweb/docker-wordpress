const path = require('path'),
    webpack = require('webpack'),

    /**
     * @link https://www.npmjs.com/package/babili-webpack-plugin
     */
    babiliPlugin = require('babili-webpack-plugin'),

    /**
     * @link https://webpack.js.org/plugins/mini-css-extract-plugin/#root
     */
    miniCssExtractPlugin = require('mini-css-extract-plugin'),

    /**
     * Usamos este módulo abaixo para remover comentários das folhas de estilo.
     *
     * @link https://github.com/NMFR/optimize-css-assets-webpack-plugin
     */
    optimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin'),

    /**
     * @link https://webpack.js.org/plugins/copy-webpack-plugin/#root
     */
    copyPlugin = require('copy-webpack-plugin'),

    /**
     * @link https://www.npmjs.com/package/imagemin-webpack
     */
    imageminPlugin = require("imagemin-webpack");

module.exports = (env, options) => {
    let src_path = './wp-content/themes/ss/src',
        dist_path = './wp-content/themes/ss/dist',
        plugins = [];

    if ('production' === options.mode) {
        plugins.push(new babiliPlugin);

        plugins.push(new optimizeCssAssetsPlugin({
            assetNameRegExp: /bundle\.css/, // A regular expression indicating the file to be optimized. It's run against the files exported by the ExtractTextPlugin instances in your configuration, not the filenames of your source CSS files. Defaults to /\.css$/g
            cssProcessorPluginOptions: {
                preset: [
                    'default',
                    {
                        discardComments: {
                            removeAll: true
                        }
                    }
                ],
            },
            canPrint: true
        }));
    } else {
        plugins.push(new webpack.SourceMapDevToolPlugin({
            test: /\.css$/
        }));
    }

    plugins.push(new miniCssExtractPlugin({
        filename: 'bundle.css',
        chunkFilename: '[id].css'
    }));

    plugins.push(new copyPlugin([
        {
            from: src_path + '/image',
            to: path.resolve(__dirname, dist_path + '/image')
        }
    ]));

    plugins.push(new imageminPlugin({
        name: '[path][name].[ext]',
        cache: false,
        imageminOptions: {
            plugins: [
                ["gifsicle", {interlaced: true}], // @link https://github.com/imagemin/imagemin-gifsicle
                ["mozjpeg", {progressive: false, quality: 70}], // @link https://github.com/imagemin/imagemin-mozjpeg
                ["optipng", {optimizationLevel: 5}], // @link https://github.com/imagemin/imagemin-optipng
                ["svgo", { // @link https://github.com/imagemin/imagemin-svgo
                    plugins: [{removeViewBox: false}]
                }]
            ]
        }
    }));

    return {
        entry: {
            app: src_path + '/js/app.js'
        },
        output: {
            filename: 'bundle.js',
            path: path.resolve(__dirname, dist_path)
        },
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env']
                        }
                    }
                },
                {
                    test: /\.scss$/,
                    exclude: /node_modules/,
                    use: [
                        miniCssExtractPlugin.loader,
                        'css-loader?sourceMap',
                        'sass-loader'
                    ]
                },
                {
                    test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                    exclude: /node_modules/,
                    loader: 'url-loader?limit=10000&mimetype=application/octet-stream'
                },
                {
                    test: require.resolve('jquery'),
                    use: [{
                        loader: 'expose-loader',
                        options: 'jQuery'
                    }, {
                        loader: 'expose-loader',
                        options: '$'
                    }]
                }
            ]
        },
        plugins: plugins,
        watchOptions: {
            ignored: /node_modules/
        }
    };
};