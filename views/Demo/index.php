  <h1>Todo's</h1>

  <div id="f-todo">
      <input class="input-xlarge" type="text" name="text">
  </div>

  <div> 
    <ul id="e-todo-list" class="unstyled"></ul> 
  </div>


  <script id="t-todo-item" type="text/template">

    <a href="#!/toggleStatus:<%= id %>"><i class="icon-ok"></i></a>

    <% var i = (status == 0)? 'span' : 'del' %>
    <<%= i %>>
      <%- text %>
    </<%= i %>>

    <a href="#!/trash:<%= id %>"><i class="icon-trash"></i></a>

  </script>
  
