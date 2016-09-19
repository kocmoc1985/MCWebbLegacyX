<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div id="add_form" style="width: 50%">
    <form action="submit.php" method="post" id="loginform">
        <img src="images/login_1.png" alt="login_1" style="width: 70px;height: 70px">
        <h2>Login</h2>
        <label for="username">Username</label>
        <input class="cfinset" name="username" size="30" required>
        <label for="password">Password</label>
        <input class="cfinset" type="password" name="password" size="30" required>
        <input id="add_formSubmitBtn" type="submit" value="Submit">
    </form>
</div>

