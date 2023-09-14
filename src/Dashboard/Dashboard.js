import React, { useContext } from 'react'
import Sidebar from '../Components/Sidebar/Sidebar'
import { UserContext } from '../Context/UserContext'

const Dashboard = () => {
  const user = useContext(UserContext)
  console.log(user);
  return (
    <>
    <Sidebar/>
    <div style={{marginLeft: "300px"}}>

    <div className="container-fluid py-3">
                <div className="d-flex justify-content-between">
                <div className="">
                    <h3>Hi, Good Morning</h3>
                    <p>Welcome to Marie ERP</p>
                </div>
               
                <div className=" top-not">
                    <button className="btn notification"><i className="fa-solid fa-bell"></i><span className="badge text-bg-secondary">4</span></button>
                    <img className="profile-image rounded-circle" src="https://image.winudf.com/v2/image1/bmV0LndsbHBwci5ib3lzX3Byb2ZpbGVfcGljdHVyZXNfc2NyZWVuXzBfMTY2NzUzNzYxN18wOTk/screen-0.webp?fakeurl=1&type=.webp" width={60} />
                </div>
            </div>
            </div>
    <h1 className='mt-3'>Welcome to Dashboard </h1>
    
    </div>
    </>
  )
}

export default Dashboard