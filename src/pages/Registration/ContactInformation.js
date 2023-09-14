import React, { useState, useContext } from "react";
import { Form, Row, Col, Button } from "react-bootstrap";
import { UserRegistrationContext } from "./RegistrationContext";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEnvelope, faAddressCard, faPhoneVolume, faArrowRight, faArrowLeft } from '@fortawesome/free-solid-svg-icons';

function ContactInformation() {

  const [validated, setValidated] = useState(false);
  const { contactInformation, setContactInformation, setCurrentStep } = useContext(UserRegistrationContext);

  const handleChange = (_key, _value) => {
    setContactInformation({ ...contactInformation, [_key]: _value });
  };

  console.log(contactInformation);
  const handleSubmit = (event) => {
    const form = event.currentTarget;
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      setCurrentStep(3)
    }
    setValidated(true);
  };

  return (
    <Form noValidate validated={validated} onSubmit={handleSubmit}>
      <Row className="mb-3">
        <div className=' form_label-1'>
          Contact Information
        </div>
        <Form.Group as={Col} xs={12} sm={12} md={5} className="mt-4 position-relative ">
          <Form.Label>Email ID</Form.Label>
          <Form.Control
            required
            type="email"
            placeholder='Email'
            defaultValue={contactInformation.email}
            onChange={(e) => handleChange("email", e.target.value)}
            style={{ paddingLeft: '40px' }}

          />
          <span
            style={{
              position: 'absolute',
              top: '70%',
              transform: 'translateY(-50%)',
              left: '26px',
              fontSize: '19px'
            }}
          >
            <FontAwesomeIcon icon={faEnvelope} />
          </span>
        </Form.Group>

        <Form.Group as={Col} xs={12} sm={12} md={4} className="mt-4  position-relative ">
          <Form.Label>Phone</Form.Label>
          <Form.Control
            required
            type="number"
            placeholder="Phone"
            defaultValue={contactInformation.phone}
            onChange={(e) => handleChange("phone", e.target.value)}
            style={{ paddingLeft: '40px' }}
          />
          <span
            style={{
              position: 'absolute',
              top: '70%',
              transform: 'translateY(-50%)',
              left: '26px',
              fontSize: '19px'
            }}
          >
            <FontAwesomeIcon icon={faPhoneVolume} />
          </span>
        </Form.Group>
        <Form.Group as={Col} xs={12} sm={12} md={3} className="mt-4  position-relative ">
          <Form.Label>Address</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="Address"
            defaultValue={contactInformation.address}
            onChange={(e) => handleChange("address", e.target.value)}
            style={{ paddingLeft: '40px' }}
          />
          <span
            style={{
              position: 'absolute',
              top: '70%',
              transform: 'translateY(-50%)',
              left: '26px',
              fontSize: '19px'
            }}
          >
            <FontAwesomeIcon icon={faAddressCard} />
          </span>
        </Form.Group>
        <Form.Group as={Col} xs={12} sm={12} md={5} className="mt-4  ">
          <Form.Label>State</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="state"
            defaultValue={contactInformation.state}
            onChange={(e) => handleChange("state", e.target.value)}
          />
        </Form.Group>
        <Form.Group as={Col} xs={12} sm={12} md={4} className="mt-4">
          <Form.Label>Pincode</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="pincode"
            defaultValue={contactInformation.pincode}
            onChange={(e) => handleChange("pincode", e.target.value)}
          />
        </Form.Group>
        <Form.Group as={Col} xs={12} sm={12} md={3} className="mt-4">
          <Form.Label>Country</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="country"
            defaultValue={contactInformation.country}
            onChange={(e) => handleChange("country", e.target.value)}
          />
        </Form.Group>
      </Row>
      <Row className="mt-5">
        <Col className="d-flex  gap-5 ">
          <Button className='btn-2' onClick={() => {
              setCurrentStep(1)
            }}> <FontAwesomeIcon icon={faArrowLeft} style={{ color: "#ffffff" }} /> Back </Button>
          <Button type="submit">Next <FontAwesomeIcon icon={faArrowRight} style={{ color: "#ffffff" }} /> </Button>
        </Col>

      </Row>
    </Form>
  );
}

export default ContactInformation;
