const path = require('path');

module.exports = {
    outputDir: 'dist/',
    devServer: {
        port: 3454
    },
    transpileDependencies: [
        'vuetify'
    ],
    publicPath: '/',
    assetsDir: 'assets/',
    configureWebpack: {
        resolve: {

          extensions: [".ts", ".tsx", ".js"],
          alias: {
            '@layouts': path.resolve(__dirname, 'src/components/layout')
          }
        },
        output: {
            libraryExport: "default"
          },
          module: {
            rules: [
              {
                test: /\.ts$/,
                exclude: /node_modules/,
                include: /src/,
                loader: "ts-loader",
                options: {
                  transpileOnly: true,
                  appendTsSuffixTo: [/\.vue$/]
                }
              }
            ]
          }
      }
}