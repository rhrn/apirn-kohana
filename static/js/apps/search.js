$(function() {

  var SearchModel = Backbone.Model.extend({

    url: '/api/v1/search/'

  });

  var SearchCollection = Backbone.Collection.extend({

    model: SearchModel,

    url: '/api/v1/search/',

    search: function(q) {
      this.fetch({data: {q: q}});
    }

  });

  var SearchView = Backbone.View.extend({

    el: $("#search-form"),

    initialize: function() {
      this.collection.on("reset", this.result, this);
    },

    events: {
      "click #search-button": "search",
      "keypress #search-query" : "enter"
    },

    search: function() {
      $("#search-result").empty();
      this.collection.search($("#search-query").val());
    },

    enter: function(e) {
      if (e.keyCode != 13) return;
      this.search();
    },

    result: function() {
      _.each(this.collection.models, function (model) {
          $("#search-result").append(new SearchResultItemView({model: model}).render().el);
      });
    }

  });

  var SearchResultListView = Backbone.View.extend({
  });

  var SearchResultItemView = Backbone.View.extend({

    tagName: 'div',

    template: _.template($("#search-result-item").html()),

    render: function() {
      this.$el.html(this.template(this.model.toJSON()));
      return this;
    }

  });

  var SearchRouter = Backbone.Router.extend({

    initialize: function() {
      this.search = new SearchView({collection: new SearchCollection()});
    }

  });

  var search = new SearchRouter();
  //Backbone.history.start();

  var options = {
    serviceUrl: '/api/v1/search/autocomplete',
    minChars:2,
    delimiter:', ',
    onSelect: function(data, value) {
      //console.log(autocomplete);
      autocomplete.setOptions({params: {type: 'street', city_name: data}});
      autocomplete.el.val(autocomplete.el.val() + autocomplete.options.delimiter);
      autocomplete.el.focus();
    },
    params: {
      type: 'city',
    },
    deferRequestBy: 200
  };

  var autocomplete = $("#search-query").autocomplete(options);

});
