import React, { useContext } from 'react'
import OperatingHours from './registrationComponent/OperatingHours'
import { Button, Col, Container, Row } from 'react-bootstrap'
import { UserRegistrationContext } from './RegistrationContext'
import {  faArrowRight, faArrowLeft } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';


const OperatingDays = () => {

  const { operatingDays, setCurrentStep } = useContext(UserRegistrationContext);
  
  const days = [ 
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday"
  ]
 

  return (
    <div>
      
      <div className='d-flex justify-content-center align-items-center '>
        <Container className='mx-5 px-5'>
          {days.map((days, id) => {
            return(<OperatingHours key={id} Day={days}/>)
          })}

          <Row className="mt-5">
        <Col className="d-flex  gap-5 ">
          <Button className='btn-2' onClick={() => {
              setCurrentStep(2)
            }}> <FontAwesomeIcon icon={faArrowLeft} style={{ color: "#ffffff" }} /> Back </Button>
          <Button 
           onClick={() => {
            setCurrentStep(4)
          }}
           type="submit">Next <FontAwesomeIcon icon={faArrowRight} style={{ color: "#ffffff" }} /> </Button>
        </Col>

      </Row>
        </Container>
      </div>
    </div>
  )
}

export default OperatingDays