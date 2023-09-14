import React, { createContext, useState } from "react";

export const UserRegistrationContext = createContext();

const RegistrationContext = ({ children }) => {
  const [currentStep, setCurrentStep] = useState(1);
  const [BasicInformation, setBasicInformation] = useState({
    businessType: "",
    businessName: "",
  });
  const [contactInformation, setContactInformation] = useState({
    email: "",
    phone: "",
    address: "",
    state: "",
    pincode: "",
    country: "",
  });

  const [otherInformation, setOtherInformation] = useState({
    dineInCapacity: "",
    typeOfCuisine: "",
  });

  const [operatingDays, setOperatingDays] = useState({
    Monday: [],
    Tuesday : [],
    Wednesday : [],
    Thursday : [],
    Friday : [],
    Saturday : [],
    Sunday : [],
  });

  return (
    <UserRegistrationContext.Provider
      value={{
        BasicInformation,
        setBasicInformation,
        contactInformation,
        setContactInformation,
        otherInformation,
        setOtherInformation,
        operatingDays, 
        setOperatingDays,
        currentStep,
        setCurrentStep,
      }}
    >
      {children}
    </UserRegistrationContext.Provider>
  );
};

export default RegistrationContext;
