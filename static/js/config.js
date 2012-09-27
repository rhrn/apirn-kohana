require.config({

  deps: ["main"],

  baseUrl: "/static/js",

  paths: {
    json:         "libs/json2",
    jquery:       "libs/jquery-1.8.2.min",
    underscore:   "libs/underscore-1.3.3.min",
    backbone:     "libs/backbone-min",
    amplifystore: "libs/amplify.store",
    bootstrap:    "libs/bootstrap.min",
    autocomplete: "plugins/jquery.autocomplete-min",
  },

  shim: {

    autocomplete: {
      deps: ["jquery"]
    },

    bootstrap: {
      deps: ["jquery"]
    },

    backbone: {
      deps: ["json", "jquery", "underscore"],
      exports: "Backbone"
    },

    app: {
      deps: ["backbone", "amplifystore", "bootstrap"]
    }

  }

});
