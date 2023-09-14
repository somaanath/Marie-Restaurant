import React, { useContext, useState } from "react";
import { Form, Row, Col, Button } from "react-bootstrap";
import { UserRegistrationContext } from "./RegistrationContext";
import { faArrowRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

function BasicInformation() {
  const [validated, setValidated] = useState(false);
  const { BasicInformation, setBasicInformation, setCurrentStep } = useContext(UserRegistrationContext)

  const [otherTypes, setOtherTypes] = useState(false);

  function handleChange(_key, _value) {
    // setBasicInformation({ ...BasicInformation, [_key]: _value });
    if (_key === "businessTypes" && _value === "others") {
      setOtherTypes(true);
    } else if (_key === "businessTypes") {
      setOtherTypes(false);
      setBasicInformation({ ...BasicInformation, businessType: _value });
    } else if (_key === "otherbusinessType") {
      setBasicInformation({ ...BasicInformation, businessType: _value });
    } else {
      setBasicInformation({ ...BasicInformation, [_key]: _value });
    }
  }


  const handleSubmit = (event) => {
    const form = event.currentTarget;
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      setCurrentStep(2)
    }
    setValidated(true);
  };

  return (
    <Form noValidate validated={validated} onSubmit={handleSubmit}>
      <Row className="my-3">
        <Form.Label className='form_label  fw-medium '>Basic Information</Form.Label>
        <Form.Group as={Col} className="mt-3" controlId="validationCustom01" >

          <Form.Label>Business Type</Form.Label>
          <Form.Select aria-label="select" onChange={(e) => { handleChange("businessTypes", e.target.value) }} defaultValue={BasicInformation.businessType}>
            <option>-- Business Type --</option>
            <option value="1">Restaurant</option>
            <option value="2">Cafe</option>
            <option value="3">Bar</option>
            <option value="4">Cloud Kitchen</option>
            <option value="5">Food Kiosk</option>
            <option value="others">others</option>
          </Form.Select>
        </Form.Group>


        {otherTypes ? <Form.Group
          as={Col}
          className="mt-3"
          controlId="validationCustom02"
        >
          <Form.Label>Business Type</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="Business Type"
            defaultValue={BasicInformation.businessName}
            onChange={(e) => {
              handleChange("otherbusinessType", e.target.value);
            }}
          />
        </Form.Group> : null}

        <Form.Group
          as={Col}
          sm={12}
          className="mt-3"
          controlId="validationCustom03"
        >
          <Form.Label>Business Name</Form.Label>
          <Form.Control
            required
            type="text"
            placeholder="Business Name"
            defaultValue={BasicInformation.businessName}
            onChange={(e) => {
              handleChange("businessName", e.target.value);
            }}
          />
        </Form.Group>
      </Row>
      <Row className="mt-4">
        <Col className="d-flex  justify-content-start">
          <Button type="submit">Next <FontAwesomeIcon icon={faArrowRight} style={{ color: "#ffffff" }} /></Button>
        </Col>
      </Row>
    </Form>
  );
}

export default BasicInformation;
