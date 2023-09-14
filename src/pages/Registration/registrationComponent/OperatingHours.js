import React, { useContext, useState } from "react";
import {  Col, Form, Row } from "react-bootstrap";
import { UserRegistrationContext } from "../RegistrationContext";
import AdditionalOperatingHours from "./AdditionalOperatingHours";

const OperatingHours = ({Day}) => {

  const { setOperatingDays} = useContext(UserRegistrationContext);
  
  const AddHoursId = new Date();
  const [values, setValues] = useState([]);

  const [fielData, setFieldData] = useState({
    id: 0,
    start: "",
    end: ""
  })

  function handleAdd() {
    setValues([...values, AddHoursId]);
  }

  function handleDelete(_data) {
    setValues(values.filter((data) => data !== _data));
  }

  function handleChange( _key, _value) {
    setFieldData({...fielData, [_key]: _value})
    // setOperatingDays({...operatingDays, [Day] : addDataInContext()})
    addOrChangeObject(Day, fielData);
  }
  
  function addOrChangeObject(day, objectToAddOrChange) {
    setOperatingDays((prevDays) => {
      const updatedDayArray = prevDays[day].map((obj) => {
        if (obj.id === objectToAddOrChange.id) {
          return { ...obj, ...objectToAddOrChange };
        }
        return obj;
      });

      if (!updatedDayArray.find((obj) => obj.id === objectToAddOrChange.id)) {
        updatedDayArray.push(objectToAddOrChange);
      }

      return {
        ...prevDays,
        [day]: updatedDayArray,
      };
    });
  }
  return (
    <div>
      <Form className="mx-md-5 px-md-5 border border-3 rounded-3 mt-2">
        <Form.Group className=""> 
          <Row >
            <Col
              className="d-flex justify-content-start align-items-center"
            >
              <Form.Check // prettier-ignore
                id={Day}
                label={Day}
              />
            </Col>
            <Col>
              <Row>
              <Col className="d-flex justify-content-center align-items-center">
              <Form.Control
                required
                type="time"
                className="border border-0 text-secondary"
                defaultValue={"00:00"}
                onChange={(e) => {handleChange("start", e.target.value)}}
              />
            </Col>
            <Col className="d-flex justify-content-center align-items-center">
              <i className="fa-solid fa-minus"></i>
            </Col>
            <Col className="d-flex justify-content-center align-items-center">
              <Form.Control
                required
                type="time"
                className="border border-0 text-secondary"
                defaultValue={"00:00"}
                onChange={(e) => {handleChange("end", e.target.value)}}
              />
            </Col>
            <Col className="d-flex justify-content-center align-items-center">
              <div className="btn" onClick={handleAdd}>
                <i className="fa-solid fa-plus"></i>
              </div>
            </Col>
              </Row>
            </Col>
            
          </Row>
          {values.map((data, i) => {
            return(<AdditionalOperatingHours key={i} handleDelete={handleDelete} data={data} day={Day} id={i}/>)
          })}  

          <Row>
            <Col>
            </Col>
            <Col>
            
            </Col>
          </Row>
        </Form.Group>

      </Form>
    </div>
  );
};

export default OperatingHours;
