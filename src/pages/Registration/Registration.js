import React, { useContext } from "react";
import CurrentStep from "./CurrentStep";
import ProgresBar from "./ProgresBar/ProgresBar";
import { Col, Container, Row } from "react-bootstrap";
import { UserRegistrationContext } from "./RegistrationContext";



const Registration = () => {

  const { currentStep } = useContext(UserRegistrationContext);


  return (
    <section className=' main-container '>
      <div className="NavBar container-fluid    ">
        <div className="img-container d-flex  ">
          <img src='/Restaruntlogo.jpg' alt="Logo" style={{ width: '65px', height: '78px', borderRadius: '20px' }} />
          <ul className="  list-unstyled  ">
            <li className=" fs-2 fw-bolder ms-2 " > MARIE</li>
            <li className=" fs-4   fw-bold  ms-2  mt-0 " > ERP</li>
          </ul>
          <h5 className=' text-end ' >Let's Make it Happen Together!</h5>

        </div>


      </div>
      <Container>
        <div className="text-center   fs-3 fw-bold  mt-4 ">
          Register
        </div>
        <Row>
          <Col sm={12} className="mt-2">
            <ProgresBar currentStep={currentStep} />
          </Col>
          <Col xs={12} sm={12} >
            <CurrentStep _step={currentStep} />
          </Col>
        </Row>
      </Container>
    </section>
  )
}

export default Registration;
