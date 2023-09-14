import "./login.css";
import { Row, Col, Form } from "react-bootstrap";
import React, {  useState } from "react";
import axios from "axios";
import CustomAlert from "../../Components/CustomAlert";
import { useNavigate } from "react-router";

// import { Link } from "react-router-dom";
// import { UserContext } from "../../Context/UserContext";


const Login = () => {


  const nav = useNavigate();
  const [invalidInput, setInvalidInput] = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [LoginData, setLoginData] = useState({
    email: "",
    password: "",
  });

  const handleFormChange = (keyName, value) => {
    setLoginData({ ...LoginData, [keyName]: value });
  };

  const AuthenticateUser = async (LoginData) => {
    try {
      const response = await axios.post("http://localhost/Marie-ERP/api/login",LoginData);
      console.log(response);
      if (response.status === 200) {
        nav('/dashboard')
      }
    } 
    catch(err) {
      setInvalidInput(true)
      setTimeout(() => {
        setInvalidInput(false)
      },5000)
      console.log(err)
    }
    
    // const data = await response.json();
    //   if (data.message) {
    //     setInvalidInput(true)
    //   } else {
    //     setUser(data)
    //     nav('/dashboard')
    //   }
   }
  

  return (
    <Row className="flex-md-row-reverse">
      <Col className="pt-5 d-flex-justify-content-center align-items-center h-100" xs={12} sm={12} md={12} lg={6}>
        <div className="mt-2 d-flex-justify-content-center align-items-center flex-column text-center login-page-right-side overflow-hidden">
          <div className="">
            <img
              src="/Restaruntlogo.jpg"
              alt=""
              width={150}
              height={100}
              className="my-4 login-page-logo"
            />
            <div className="h1 d-flex justify-content-center align-items-center">
              <div>
                Welcome Back
                <p className="fs-6">Please enter your Login information</p>
              </div>
              <div className="login-page-right-heading">
                <img
                  src="/assets/Circle.png"
                  alt=""
                  width={80}
                  className="login-page-red-circle"
                />
              </div>
            </div>
          </div>
        </div>
        <Form
          className="mt-3 px-2 px-sm-5 px-md-5 px-lg-4 px-xl-5 mx-lg-3 mx-xl-5"
          onSubmit={(e) => e.preventDefault()}
        >
          <label htmlFor="email">
            <strong>Email</strong>
          </label>
          <div className="input-icons my-2">
            <i className="fa fa-user icon"></i>
            <input
              className="input-field"
              type="text"
              placeholder="Enter Your Email"
              id="email"
              required
              onChange={(e) => {
                handleFormChange("email", e.target.value);
              }}
            />
          </div>
          <label htmlFor="password ">
            <strong>Password</strong>
          </label>
          <div className="input-icons my-2">
            <i className="fa-solid fa-lock icon"></i>
            {showPassword ? (
              <i
                className="fa-solid fa-eye icon-show-password"
                onClick={() => setShowPassword(false)}
              ></i>
            ) : (
              <i
                className="fa-solid fa-eye-slash icon-show-password"
                onClick={() => setShowPassword(true)}
              ></i>
            )}
            <input
              className="input-field"
              type={showPassword ? "text" : "password"}
              placeholder="Enter Your Password"
              id="password"
              value={LoginData.password}
              required
              onChange={(e) => {
                handleFormChange("password", e.target.value);
              }}
            />
          </div>

          {/* <div>
            <Row>
              <Col>
                <input type="checkbox" name="Remember" id="Remember" />
                <label htmlFor="Remember" className="mx-2">
                  <strong>Remember me</strong>
                </label>
              </Col>
              <Col className="text-end">
                <Link to={'/forgotpassword'}>
                <strong>Forgot Password?</strong>
                </Link>
              </Col>
            </Row>
          </div> */}
          
          <div className="mt-4 mb-2">
            <button
              className="btn-base w-100 py-2"
              onClick={() => AuthenticateUser(LoginData)}
            >
              <div className="h4 fw-bolder text-light">Log In</div>
            </button>
          </div>
          
          {invalidInput ? <div className='custom-alert'>
          <CustomAlert message={"Invalid Email or Password"}/>
          </div> : null}
        </Form>
      </Col>

      <Col xs={12} sm={12} md={12} lg={6} className="login-left-side">
        <div>
          <div className="login-left-triangle px-5 d-flex justify-content-center align-items-center">
            <div className="text-light">
              <div className="h1">
                Food Is Our Common <br />
                Ground,
              </div>
              <p>
                Nothing brings people together like good food
                <i
                  className="fa-solid fa-hand-point-right ms-3"
                  style={{ color: "#000", width: "20px" }}
                ></i>
              </p>
            </div>
          </div>
        </div>
      </Col>
    </Row>
  );
};

export default Login;
