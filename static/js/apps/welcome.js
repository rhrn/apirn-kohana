$(function() {

  var auth = new Auth();

  var UserModel = Backbone.Model.extend({
    
    url: '/api/v1/users/join/',

    joinUser: function(user) {
      this.save(user, {
        wait: true,
        success: this.success,
        error: this.error
      });
    },

    success: function(model, response) {

      auth.save(response.auth);
      model.trigger("success", response);
      new Function(response.action)();
    },

    error: function(model, response, x) {

      var json = jQuery.parseJSON(response.responseText);
      model.trigger("error", json.errors);

    },

  });

  var UserJoinView = Backbone.View.extend({

      el: $("#form-user"),

      join: 1,

      template: _.template($("#form-user-template").html()),

      initialize: function() {
        this.model.on("success", this.render, this);
        this.model.on("error", this.messages, this);
        auth.on("remove", this.render, this);
        this.render();
      },

      registration: function() {
        this.join = 0;
        this.$("#join-button").hide(); 
        this.$("#registration-button").show(); 
        this.$("#repassword-group").show();
        this.$("#join-passwrod").val('');
        this.$("#join-repasswrod").val('');
      },
  
      enter: function() {
        this.join = 1;
        this.$("#join-button").show(); 
        this.$("#registration-button").hide(); 
        this.$("#repassword-group").hide();
        this.$("#join-passwrod").val('');
      }, 

      events: {
        "click .join-button": "join",
        "click .logout": "logout",
        "keyup #join-repasswrod": "repassword",
        "keyup #join-passwrod": "repassword"
      },

      join: function() {
        this.$(".help-inline").empty();
        this.model.joinUser(this.serialize());
        return false;
      },

      repassword: function() {
        if (this.join == 0) {
          if (this.$("[name=password]").val() == this.$("[name=repassword]").val()) {
            this.$("#registration-button").removeAttr('disabled');
            this.$("#message-repassword").hide();
          } else {
            this.$("#registration-button").attr('disabled', 'disabled');
            this.$("#message-repassword").show();
          }
        }
      },

      messages: function(messages) {
        _.each(messages, function(value, key) {
            this.$('#message-'+key).html(value);
        });
      },

      logout: function() {
        auth.remove();
      },

      serialize: function() {
        return this.$('form').formParams();
      },
      
      render: function(response) {
        var user = auth.get();
        if (typeof(response) != "undefined" && typeof(response.is_new) != "undefined") {
          user.is_new = 1;
        }
        this.$el.html(this.template(user)); 
      }

  });

  var ToggleJoinRouter = Backbone.Router.extend({

    routes: {
      "!/registration": "registration",
      "!/enter": "enter"
    },

    initialize: function() {
      this.joinUser = new UserJoinView({model: new UserModel()});
      this.tabs = $("#toggle-tabs");
    },

    toggleTabs: function(selector) {
      this.tabs.find('.active').removeClass('active');
      this.tabs.find(selector).addClass('active');
    },

    registration: function() {
      this.toggleTabs('#registration');
      this.joinUser.registration();
    },

    enter: function() {
      this.toggleTabs('#enter');
      this.joinUser.enter();
    }

  });

  var toggleJoin = new ToggleJoinRouter();

  Backbone.history.start();

});
