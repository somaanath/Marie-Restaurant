import React, { useState } from 'react'
import { Alert } from 'react-bootstrap'

const CustomAlert = (props) => {
  const [show, setShow] = useState(true);
  return (
<>
   { show ? 
     <Alert variant="danger" onClose={() => setShow(false)} dismissible>
          <Alert.Heading>{props.heading}</Alert.Heading>
          <p>
            {props.message}
          </p>
        </Alert> : null }
    </>
    )
}

export default CustomAlert