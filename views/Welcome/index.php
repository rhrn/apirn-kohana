
  <div class="span8">
    <div id="form-user"></div>
  </div>

  <script id="form-user-template" type="text/template">
    <% if (!_.isEmpty(token)) { %>
      Добропожаловать, <%- name %>! <a href="#!/logout" class="btn btn-primary logout">выйти</a>
      <div>
<!--
      <% if (typeof(is_new) != "undefined") { %>
        Подтвердите свой email отправленный Вам на
        <div>
          <a target="_blank" href="http://<%= email.split('@')[1] %>"><%- email %></a>
        </div>
      <% } %>
-->
      </div>
    <% } else { %>

    <div class="control-group">
      <div id="toggle-tabs" class="btn-group">
        <a id="enter" href="#!/enter" class="btn btn-primary active">Вход</a>
        <a id="registration" href="#!/registration" class="btn btn-primary">Регистрация</a>
      </div>
    </div>

    <form id="form-join">

      <div class="control-group">
        <div class="controls">
          <input id="join-email" class="input-large" type="email" name="email" placeholder="email">
          <span id="message-email" class="help-inline"></span>
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <input id="join-passwrod" class="input-large" type="password" name="password" placeholder="пароль">
          <span id="message-password" class="help-inline"></span>
        </div>
      </div>

      <div id="repassword-group" class="control-group hide">
        <div class="controls">
          <input id="join-repasswrod" class="input-large repassword" type="password" name="repassword" placeholder="повторите пароль">
          <span id="message-repassword" class="help-inline hide">пароли не совпадают</span>
        </div>
      </div>

      <button id="join-button" class="btn btn-primary join-button">войти</button>
      <button id="registration-button" class="btn btn-primary hide join-button">зарегистрироваться</button>

    </form>
    <% } %>
  </script>
