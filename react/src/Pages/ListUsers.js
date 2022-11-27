import axios from 'axios'
import React, { useState, useEffect } from 'react'
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import {Link} from 'react-router-dom'



function ListUsers() {

    const [inputs, setInputs] = useState({});
    const [getRole, setGetRole] = useState([]);
    const [getRolee, setGetRolee] = useState([]);

    useEffect(() => {
        fetchUsers();


    }, [])

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setInputs(values => ({ ...values, [name]: value }))
    }

    const handleSubmit = (event) => {
        event.preventDefault();
        // console.log(inputs);
        GetAllUser(inputs);
    }

    const GetAllUser = (inputs) => {
        // console.log(inputs);
        const url = "http://localhost/laravel_task_mumbai/laravel/public/api/get_user_by_id";
        axios.post(url, {
            role: inputs.role,
        })
            .then(function (response) {
                console.log(response);
                setGetRolee(response.data)

            })
            .catch(function (error) {
                console.log(error);
            });
    }

    const fetchUsers = () => {

        axios({
            method: 'get',
            url: 'http://localhost/laravel_task_mumbai/laravel/public/api/get_role',
            responseType: 'json'
        })
            .then(function (response) {
                // console.log(response.data);
                setGetRole(response.data)
            });
    }



    return (
        <div className='saveUsers w-50 mx-auto'>
            <header className="d-flex jcc">
                <h4>Get User By Role</h4>
            </header>
            <form onSubmit={handleSubmit}>
                <div className="card p-4">
                    <div className="d-flex flex-wrap jcsb aic">

                        <div className="px-3 mb-4 fieldWrap">
                            <label className='mb-2'>Role</label>
                            <select className="form-select mt-1"
                                name="role"
                                value={inputs.role || ""}
                                onChange={handleChange}
                            >
                                <option value="">Select Role</option>
                                {
                                    getRole.map((role) =>
                                        <option value={role.id} key={role.id}>{role.name}</option>
                                    )
                                }

                            </select>
                        </div>
                        <div className="fieldWrap">
                            <button type="submit" className="btn btn-primary">Get User</button>
                            <Link to="/">
                                <button type="submit" className="btn btn-primary ms-4">Home</button>
                            </Link>
                        </div>
                    </div>
                </div>
            </form>

            <div className="card mt-1 mb-4" id="get-user">
                <div className="d-flex bgHead">
                    <h4 className="card-header mx-auto">Users</h4>
                </div>


                <TableContainer component={Paper}>
                    <Table sx={{ minWidth: 650 }} aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                <TableCell>#</TableCell>
                                <TableCell >Name</TableCell>
                                <TableCell >Email</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {
                                getRolee.map((row, index) => (
                                    <TableRow
                                        key={row.name}
                                        sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                    >
                                        <TableCell component="th" scope="row">
                                            {index}
                                        </TableCell>
                                        <TableCell >{row.name}</TableCell>
                                        <TableCell >{row.email}</TableCell>
                                    </TableRow>
                                ))
                            }
                        </TableBody>
                    </Table>
                </TableContainer>
            </div>
        </div>
    )
}

export default ListUsers