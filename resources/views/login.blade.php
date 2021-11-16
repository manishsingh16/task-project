<center>
<h1>Login</h1>
  <p>Login .</p>
  <form class="pure-form pure-form-stacked" action="/login" method="post">
    @csrf
   
    <label for="email">Email Address</label>
    <input type="email" name="email" required>

    <label for="email">Password</label>
    <input type="text" name="password" required>
   
    <input class="pure-button pure-button-primary"  type="submit"  value="Login">
  </form>
  <p>Don't have an account? <a href="/">Register here</a></p>
</center>