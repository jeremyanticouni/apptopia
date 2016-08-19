exports.config = {
  files: {
    javascripts: {
      joinTo: {
        'js/app.js': /^(app\/js)/,
        'js/vendor.js': /^(node_modules|bower_components)|(app\/vendor)/
      }
    },
    stylesheets: {
      joinTo: {
        'css/app.css': /^(app\/css)/,
        'css/vendor.css':  /^(node_modules|bower_components)/
      }
    }
  },

  plugins: {
    autoReload: {
      enabled: {
        css: true,
        js: true,
        assets: true
      }
    },
    babel: {
      presets: ['es2015', 'react']
    }
  },

  npm: {
    enabled: true,
    whitelist: [
      'lodash',
      'immstruct',
      'immutable',
      'lodash',
      'moment',
      'omniscient',
      'react',
      'react-dom',
      'react-select',
      'react-datepicker',
      'react-sparklines',
      'whatwg-fetch'
    ],
    styles: {
      'react-select': ['dist/react-select.css'],
      'react-datepicker': ['dist/react-datepicker.css']
    }
  }
};
