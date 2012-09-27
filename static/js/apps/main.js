var ListView = Backbone.View.extend({

  initialize: function() {
    this.collection.on("add", this.addOne, this);
    this.collection.on("reset", this.render, this);
  },

  events: {
    "click .refresh-list": "refresh"
  },

  refresh: function() {
    this.clear();
    this.fetch();
  },

  clear: function() {
    _.each(this.collection.models, function(model) {
      model.trigger("clear");
    }, this);
  },

  render: function() {
    _.each(this.collection.models, function(model) {
      this.addOne(model);
    }, this);
  },

  fetch: function() {
    this.collection.fetch({data: this.collection.data});
  }

});

var ListItemView = Backbone.View.extend({

  initialize: function() {
    this.model.on("change", this.render, this);
    this.model.on("clear", this.clear, this);
  },

  clear: function() {
    this.$el.remove();
  },

  render: function() {
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  }

});

var FormModalView = Backbone.View.extend({

  events: {
    "click .save": "save",
    "keypress input" : "onEnter",
    "click .modal-open": "modalOpen",
    "click .modal-close": "modalClose"
  },

  onEnter: function(e) {
    if (e.keyCode != 13) return;
    this.save();
    return false;
  },

  modalOpen: function(e) {
    this.$('.modal').hide();
    return false;
  },

  modalClose: function(e) {
    this.$('.modal').hide();
    this.trigger("close");
    return false;
  },

  serialize: function() {
    this.data = this.$('form').formParams();
  },

  save: function() {

    this.serialize();

    this.model.save(this.data, {
      wait:true,
      error: function(model, response, x) {
        model.trigger("error", response);
      },
      success: function(model, data) {
        model.trigger("success", data);
      }
    });

    if(this.model.isNew()) {
      this.collection.add(this.model);
    }
  },

  success: function(data) {
    this.$('.modal').hide();
  },

  errors: function(response) {
    var json = JSON.parse(response.responseText);
    _.each(json.errors, function(value, key) {
      this.$('#message-'+key).html(value);
    });
  },

  render: function(model) {
    this.model = model;
    this.model.on("error", this.errors, this);
    this.model.on("success", this.success, this);
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  }

});
