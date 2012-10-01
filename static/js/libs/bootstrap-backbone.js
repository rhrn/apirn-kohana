
  var Bootstrap = Bootstrap || {};

  Bootstrap.Modal = Backbone.View.extend({

    events: {
      "click .modal-close": "close",
      "click .save": "save",
      "keypress input" : "onEnter"
    },

    close: function() {
      this.$(".modal").hide();
      this.trigger("close");
    },

    serialize: function() {
      this.data = this.$('form').formParams();
      console.log(this.data);
    },

    save: function() {

      this.serialize();

      var isNew = this.model.isNew();

      this.model.save(this.data, {
        "wait": true
      });

      if (isNew) {
        this.collection.add(this.model);
      }

      this.close();
    },

    onEnter: function (e) {
      if (e.keyCode != 13) return; 
      this.save();
    },

    render: function(model) {
      this.$el.html(this.template(this.model.toJSON()));
      return this;
    }

  });

  Bootstrap.List = Backbone.View.extend({

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

    addOne: function(model) {
      this.$el.append(new this.item({model: model}).render().el);
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

  Bootstrap.ListItem = Backbone.View.extend({

    initialize: function() {
      this.model.on("change", this.render, this);
      this.model.on("clear", this.clear, this);
      this.model.on("destroy", this.clear, this);
    },

    clear: function() {
      this.$el.remove();
    },

    render: function() {
      this.$el.html(this.template(this.model.toJSON()));
      return this;
    }

  });

  Bootstrap.Button = Backbone.View.extend({

    el: $('.btn-group'),

    events: {
      "click .btn": "click"
    },

    click: function(e) {
      e.preventDefault();
    }

  });

  Bootstrap.Router = Backbone.Router.extend({

    routes: {
      "": "index"
    },

    index: function() {
      this.navigate("!/");
    }

  });

// jquerymx3.2 form_params
(function(g){var i=/radio|checkbox/i,j=/[^\[\]]+/g,k=/^[\-+]?[0-9]*\.?[0-9]+([eE][\-+]?[0-9]+)?$/,l=function(b){if(typeof b=="number")return true;if(typeof b!="string")return false;return b.match(k)};g.fn.extend({formParams:function(b,d){if(!!b===b){d=b;b=null}if(b)return this.setParams(b);else if(this[0].nodeName.toLowerCase()=="form"&&this[0].elements)return jQuery(jQuery.makeArray(this[0].elements)).getParams(d);return jQuery("input[name], textarea[name], select[name]",this[0]).getParams(d)},setParams:function(b){this.find("[name]").each(function(){var d=
b[g(this).attr("name")],a;if(d!==undefined){a=g(this);if(a.is(":radio"))a.val()==d&&a.attr("checked",true);else if(a.is(":checkbox")){d=g.isArray(d)?d:[d];g.inArray(a.val(),d)>-1&&a.attr("checked",true)}else a.val(d)}})},getParams:function(b){var d={},a;b=b===undefined?false:b;this.each(function(){var e=this;if(!((e.type&&e.type.toLowerCase())=="submit"||!e.name)){var c=e.name,f=g.data(e,"value")||g.fn.val.call([e]),h=i.test(e.type);c=c.match(j);e=!h||!!e.checked;if(b){if(l(f))f=parseFloat(f);else if(f===
"true")f=true;else if(f==="false")f=false;if(f==="")f=undefined}a=d;for(h=0;h<c.length-1;h++){a[c[h]]||(a[c[h]]={});a=a[c[h]]}c=c[c.length-1];if(a[c]){g.isArray(a[c])||(a[c]=a[c]===undefined?[]:[a[c]]);e&&a[c].push(f)}else if(e||!a[c])a[c]=e?f:undefined}});return d}})})(jQuery);
