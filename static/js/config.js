require.config({

  deps: ["main"],

  baseUrl: "/static/js",

  paths: {
    json:         "libs/json2",
    jquery:       "libs/jquery.min",
    underscore:   "libs/underscore.min",
    backbone:     "libs/backbone.min",
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
