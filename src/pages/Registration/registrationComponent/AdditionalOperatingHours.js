import React, { useContext, useState } from 'react'
import { Row, Col, Form } from 'react-bootstrap'
import { UserRegistrationContext } from '../RegistrationContext'


const AdditionalOperatingHours = ({day, handleDelete, data, id}) => {

    const {  setOperatingDays} = useContext(UserRegistrationContext);
  
    const [fielData, setFieldData] = useState({
        id: id+1,
        start: "",
        end: ""
    })

    const handleChange = (_key,_value) => {
        setFieldData({...fielData, [_key]: _value})
        addOrChangeObject(day,fielData);
    }
    
    function deleteObjectById(day, idToDelete) {
        setOperatingDays((prevDays) => ({
          ...prevDays,
          [day]: prevDays[day].filter((obj) => obj.id !== idToDelete),
        }));
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
    <Row>
        <Col></Col>
            <Col>
                <Row>
                <Col className="d-flex justify-content-center align-items-center">
                  <Form.Control
                    required
                    type="time"
                    className="border border-0 text-secondary"
                    defaultValue={"00:00"}
                    onChange={(e) => {handleChange("start",e.target.value)}}
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
                    onChange={(e) => {handleChange("end",e.target.value)}}
                  />
                </Col>
                <Col className="d-flex justify-content-center align-items-center">
                  <div className="btn" onClick={() => {
                    handleDelete(data)
                    deleteObjectById(day, fielData.id)
                }}>
                    <i className="fa-solid fa-trash"></i>
                  </div>
                </Col>
                  </Row>
                </Col>
              </Row>
  )
}

export default AdditionalOperatingHours