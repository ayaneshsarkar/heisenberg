const path = require('path');
require("@babel/polyfill");

module.exports = {
  mode: "development",
  entry: ["@babel/polyfill", "./app/resources/js/app.js"],
  output: {
    filename: "index.js",
    path: path.resolve(__dirname, "./public/js")
  },
  module: {
    rules: [
      {
        test: /\.js$/, 
        exclude: /node_modules/, 
        use: ['babel-loader']
      }
    ]
  }
}