import './Register.css';
import {useState} from "react";


function Register() {
     const  [message, setMessage] = useState("");
    const[formData, setFormData] = useState({
        fullname : "",
        email : "",
        password : "",
        confirmPassword : ""
        });
    
    const handleChange =(e) =>{
        setFormData({... formData,
            [e.target.name]: e.target.value
        });
        }
        const handleSubmit = async (e) => {
    e.preventDefault();

    try {
        const response = await fetch(
            "http://localhost/authentication_system/src/backend%20api/api/register.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
            }
        );

        const data = await response.json();

        console.log(data);

        setMessage(data.message);

        
        // alert(data);

    } catch (error) {
        console.error(error);
    }
};
   
 
;
    return(<>
    <div className="register-container">  
        <form onSubmit={handleSubmit}>
            <h2 className="form-title">Sign Up</h2>
            <p><input type="text" 
                      name="fullname" 
                      placeholder="Full Name" 
                      onChange= {handleChange}required /></p>
            <p><input type="email" 
                      name="email" 
                      placeholder="Email" 
                      onChange = {handleChange}required /></p>
            <p><input type="password"
                      name="password" 
                      placeholder="Password" 
                      onChange= {handleChange} required /></p>
         
            
            <p><input type="password"
                      name="confirmPassword" 
                      placeholder="Confirm Password" 
                      onChange={handleChange}
                      required /></p>
            <button type="submit">Register</button>
               <p className="message">{message}</p>
        </form>  
    </div>   
</>)
}

export default Register;

