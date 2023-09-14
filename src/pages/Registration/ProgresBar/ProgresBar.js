import React from "react";
import "./ProgresBar.css";

const ProgresBar = ({ currentStep }) => {
  const steps = [
    "Basic Information",
    "Contact Information",
    "Operating Days",
    "Other Information",
  ];
  return (
    <div>
      <section className="step-wizard">
        <ul className="step-wizard-list">
          {steps.map((steps, i) => {
            return (

              <li
                key={i}
                className={
                  currentStep - 1 === i
                    ? "step-wizard-item current-item"
                    : "step-wizard-item"
                }
              >
                <div>
                  <span className="progress-count">{i + 1}</span>
                </div>
                <div>
                  <span className="progress-label">{steps}</span>
                </div>
              </li>
            );
          })}
        </ul>
      </section>
    </div>
  );
};

export default ProgresBar;
