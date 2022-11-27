import React, { useState, useEffect } from 'react'
import axios from 'axios';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { useNavigate, Link } from "react-router-dom";



function SaveUsers() {

    const [inputs, setInputs] = useState({});
    const [getRolee, setGetRolee] = useState([]);
    const notify = () => toast("Wow so easy!");

    const navigate = useNavigate()


    useEffect(() => {
        getRole();
        console.log("Role", getRolee);

    }, [])

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setInputs(values => ({ ...values, [name]: value }))
    }

    const save = "http://localhost/laravel_task_mumbai/laravel/public/api/save_user";

    const handleSubmit = (event) => {
        event.preventDefault();
        // console.log(inputs);
        postAPI(inputs);
    }

    const postAPI = (ee) => {
        // console.log(ee);
        axios.post(save, {
            name: ee.name,
            email: ee.email,
            role: ee.role,
        })
            .then(function (response) {
                console.log(response);
                // notify()
                if (response.data.flag == false) {
                    toast(response.data.resp);
                } else {
                    toast(response.data.resp);
                    setTimeout(
                        () => navigate("/ListUsers"),
                        1000
                    );
                    // navigate("/ListUsers");
                }

            })
            .catch(function (error) {
                console.log(error);
            });
    }

    const getRole = () => {
        axios({
            method: 'get',
            url: 'http://localhost/laravel_task_mumbai/laravel/public/api/get_role',
            responseType: 'json'
        })
            .then(function (response) {
                console.log(response.data);
                setGetRolee(response.data)
            });

    }


    return (

        <div className='saveUsers w-50 mx-auto'>
            <header className="d-flex jcc">
                <h4>Add Users</h4>
            </header>
            <form onSubmit={handleSubmit}>
                <div className="card p-4">
                    <div className="d-flex flex-wrap jcsb">
                        <div className="px-3 mb-4 fieldWrap">
                            <label>Name</label>
                            <input
                                type="text"
                                className='form-control'
                                name="name"
                                value={inputs.name || ""}
                                onChange={handleChange}

                            />
                        </div>
                        <div className="px-3 mb-4 fieldWrap">
                            <label>Email</label>
                            <input
                                type="email"
                                className='form-control'
                                name="email"
                                value={inputs.email || ""}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="px-3 mb-4 fieldWrap">
                            <label>Role</label>
                            <select className="form-select"
                                name="role"
                                value={inputs.role || ""}
                                onChange={handleChange}
                            >
                                {
                                    getRolee.map((role) =>
                                        <option value={role.id} key={role.id}>{role.name}</option>
                                    )
                                }

                            </select>
                        </div>
                    </div>
                    <div className="d-flex">
                        <button type="submit" className="btn btn-primary ms-3">Save</button>
                        <Link to="/ListUsers">
                            <button type="submit" className="btn btn-primary ms-3">View User List</button>
                        </Link>
                    </div>
                    <ToastContainer />
                </div>
            </form>
        </div>
    )
}

export default SaveUsers