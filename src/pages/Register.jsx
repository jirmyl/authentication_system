import './Register.css';

function Register() {
return(<>
    <div className="register-container">  
        <form action="">
            <h2 className="form-title">Sign Up</h2>
            <p><input type="text" name="username" placeholder="Username" required /></p>
            <p><input type="email" name="email" placeholder="Email" required /></p>
            <p><input type="password" name="password" placeholder="Password" required /></p>
            <button type="submit">Register</button>
        </form>  
    </div>   
</>)
}

export default Register;

