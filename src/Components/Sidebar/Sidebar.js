import React from "react";
import "./Sidebar.css";
import { NavLink } from "react-router-dom";

const Sidebar = () => {
  return (
    <div
      className="sidebar col-2 border py-2 d-none d-sm-block h-100 float-start"
      style={{ height: "100vh" }}
    >
      <div className="py-3 ">
        <img
          className="rounded Restarunt-logo float-start"
          src="/Restaruntlogo.jpg"
          alt=""
          width={40}
        />
        <div className="mx-5">
          <span className="marie fw-bolder">MARIE</span> <br />
          <span className="erp fw-bolder">ERP</span>
        </div>
      </div>
      <hr/>
      <div>
        <ul className="navbar-nav">
          {/* <li className="nav-item">
            <NavLink
              className={({ isActive }) =>
                isActive ? "fw-bold" : null
              }
              to={"/dashboard/"}
            >
              <i className="fa-solid fa-house-chimney mx-3"></i>Home
            </NavLink>
          
          </li>
          <li className="nav-item d-block-inline">
          <NavLink
              className={({ isActive }) =>
                isActive ? "fw-bold" : null
              }
              to={"/dashboard/people"}
            >
             <i className="fa-solid fa-user-group mx-3"></i>People
            </NavLink>
          </li> */}
          
           <li className="nav-item d-block-inline">
            <span className="nav-link activee" aria-current="page">
             <i className="fa-solid fa-house-chimney mx-3"></i>Home
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
            <i className="fa-solid fa-user-group mx-3"></i>People
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-mug-hot mx-3"></i>Ingredients
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-screwdriver-wrench mx-3"></i>Overheads
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-dollar-sign mx-3"></i> Costing
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-shield mx-3"></i>Admin
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-circle-user mx-3"></i>Profile
            </span>
          </li>
          <li className="nav-item d-block-inline settings">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-gear mx-3"></i>Settings
            </span>
          </li>
          <li className="nav-item d-block-inline">
            <span className="nav-link" aria-current="page">
              <i className="fa-solid fa-arrow-right-from-bracket mx-3"></i>Log
              out
            </span>
          </li>
        </ul>
      </div>
    </div>
  );
};

export default Sidebar;
