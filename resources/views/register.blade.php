<h1>Register</h1>
  <p>Create an  customer account in our demo app.</p>
  <form class="pure-form pure-form-stacked" action="/register" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email Address</label>
    <input type="email" name="email" required>

  

    <input class="pure-button pure-button-primary"  type="submit"  value="Register">
  </form>
  <p>Already have an account? <a href="/login"> Login here</a></p>