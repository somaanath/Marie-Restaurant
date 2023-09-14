import React, { useContext, useState } from 'react'
import { Button, Form, Row, Col } from 'react-bootstrap'
import { UserRegistrationContext } from './RegistrationContext'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons'




const OtherInformation = () => {
  const [validated, setValidated] = useState(false);
  const { otherInformation, setOtherInformation, setCurrentStep } = useContext(UserRegistrationContext);

  const handleSubmit = (event) => {
    const form = event.currentTarget;
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
    }
    setValidated(true);
  };

  const handleChange = (_key, _value) => {
    setOtherInformation({ ...otherInformation, [_key]: _value });
  }
  return (
    <div>
      <div className='form_label  fw-medium'>
        OtherInformation
      </div>
      <Form noValidate validated={validated} onSubmit={handleSubmit}>
        <Form.Group className='mt-3'>
          <Form.Label>Dine In Capacity</Form.Label>
          <Form.Control
            type="text"
            placeholder="Dine In Capacity"
            onInput={(e) => handleChange("dineInCapacity", e.target.value)}
            defaultValue={otherInformation.dineInCapacity}
          />
        </Form.Group>
        <Form.Group className='mt-3'>
          <Form.Label>Type of Cuisine</Form.Label>
          {/* <Form.Control
            type="text"
            placeholder="Type of Cuisine"
            onInput={(e) => handleChange("typeOfCuisine", e.target.value)}
            defaultValue={otherInformation.typeOfCusine}
          /> */}

          <Form.Select aria-label="select" onChange={(e) => { handleChange("typeOfCuisine", e.target.value) }} defaultValue={otherInformation.typeOfCusine}>
            <option>-- select Country --</option>
            <option value="1">Indian</option>
            <option value="2">Malaysian </option>
            <option value="3">Chinese</option>
            <option value="4">Thai</option>
            <option value="5">Korean</option>
          </Form.Select>
        </Form.Group>

        <Row className="mt-5" >

          <Col className="d-flex  justify-content-start">
            <Button className='btn-2' onClick={() => {
              setCurrentStep(3)
            }}> <FontAwesomeIcon icon={faArrowLeft} style={{ color: "#ffffff" }} /> Back </Button>
            <Col className="d-flex  justify-content-end">
              <Button type="submit">Finish </Button>
            </Col>
          </Col>

        </Row>
      </Form>
    </div>
  )
}

export default OtherInformation