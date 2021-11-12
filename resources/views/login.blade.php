<h1>Login</h1>
  <p>Create an  customer account in our demo app.</p>
  <form class="pure-form pure-form-stacked" action="/login" method="post">
    @csrf
   
    <label for="email">Email Address</label>
    <input type="email" name="email" required>

   
    <input class="pure-button pure-button-primary"  type="submit"  value="Login">
  </form>
  <p>Already have an account? <a href="#"> Regis here</a></p>