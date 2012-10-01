$(function() {

  var TodoModel = Backbone.Model.extend({
    
    defaults: {
      id: null,
      text: '',
      status: 0
    },

    urlRoot: '/api/v1/todos/rest'

  });

  var TodoCollection = Backbone.Collection.extend({

    model: TodoModel,

    url: '/api/v1/todos/rest' 

  });


  var TodoForm = Backbone.View.extend({

    el: $("#f-todo"),


    events: {
      "keypress input" : "onEnter"
    },

    onEnter: function (e) {
      if (e.keyCode != 13) return;
      this.save();
    },

    serialize: function() {
      this.data = {text: this.$('input').val()};
    },

    save: function() {

      this.serialize();

      this.model = new this.collection.model();

      this.model.save(this.data, {
        "wait": true,
      });

      this.collection.add(this.model);

      this.$('input').val('');
    }

  });

  var TodoListItem = Bootstrap.ListItem.extend({

    tagName: 'li',

    className: 'todo-list-item',

    template: _.template($("#t-todo-item").html())

  });

  var TodoList = Bootstrap.List.extend({

    el: $("#e-todo-list"),

    item: TodoListItem

  });

  var AppRouter = Backbone.Router.extend({

    routes: {
      "": "index",
      "!/toggleStatus::id": "toggleStatus",
      "!/trash::id": "trash"
    },

    initialize: function() {

      this.collection = new TodoCollection();

      this.todoList = new TodoList({collection: this.collection});

      this.todoList.fetch();

      this.form = new TodoForm({collection: this.collection});
    },

    index: function() {
      this.navigate("!/");
    },

    toggleStatus: function(id) {
      var model = this.collection.get(id);
      var status = (model.get('status') == 1)? 0 : 1;
      model.save({status: status}, {
        wait: true
      });
      this.index();
    },

    trash: function(id) {
      var model = this.collection.get(id);
      model.destroy({
        wait: true
      });
      this.index();
      
    }

  });

  var app = new AppRouter();

  Backbone.history.start();


});
