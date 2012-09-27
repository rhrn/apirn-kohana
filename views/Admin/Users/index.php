<div class="row-fluid">
  <div class="span6">
  	<h3>Users</h3>
  	<div id="app-users"></div>
	<div id="form-modal"></div>
  </div>
</div>

<div class="row-fluid show-grid">
  <div id="list-users" class="span12"></div>
</div>

<script id="app-user-template" type="text/template">
  <a class="btn btn-primary form-show" data-toggle="modal" href="#createUser">Create User</a>
</script>

<script id="form-user-template" type="text/template">
  <div class="modal form-modal hide" id="<%= modal_id %>">
    <form class="form-user">
	    <div class="modal-header">
	      <button class="close" data-dismiss="modal">×</button>
	      <h3>User</h3>
	    </div>
	    <div class="modal-body">
	      <p>
		<input class="name" name="name" type="text" placeholder="name"><br>
		<input class="surname" name="surname" type="text" placeholder="surname"><br>
		<input class="email" name="email" type="email" placeholder="email"><br>
	      </p>
	    </div>
	    <div class="modal-footer">
	      <a href="#" class="form-close btn" data-dismiss="modal">Close</a>
	      <a href="#" class="create-user btn btn-primary">Save changes</a>
	    </div>
    </form>
  </div>
</script>

<script id="view-user" type="text/template">
  <div class="user row-fluid show-grid">
  	<div class="name span2"><%= name %></div>
  	<div class="surname span2"><%= surname %></div>
  	<div class="email span2"><%= email %></div>
  	<div class="actions span2">
  		<a class="edit" href="#!/edit/<%= id %>">edit</a>
  		<a class="remove" href="#!/remove/<%= id %>">remove</a>
  	</div>
  </div>
</script>

<script id="template-users-edit-form-modal" type="text/template">
  <div id="delivery-form-modal" class="modal">
    <form>
      <div class="modal-header">
        <button class="modal-close close">×</button>
        <h3>Пользователь</h3>
      </div>
      <div class="modal-body">
        <p>
          <input class="name" name="email" type="text" placeholder="email" value="<%= email %>"><br>
          <input id="hidden-active" type="hidden" name="active" value="<%= active %>"><br>
        </p>
      </div>
      <div class="modal-footer">
        <a class="erase btn pull-left">удалить</a>
        <a class="modal-close btn">отмена</a>
        <a class="save btn btn-primary">Сохранить</a>
      </div>
    </form>
	</div>
</script>

