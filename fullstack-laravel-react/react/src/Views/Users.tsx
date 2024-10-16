import { Link } from 'react-router-dom';
import { IUser } from '../Models/User';
import { useEffect, useState } from 'react';
import { useAppContext } from '../Hooks/useAppContext';
import axiosClient from '../axios-client';

export default function Users() {
    const [users, setUsers] = useState<IUser[]>([]);
    const [loading, setLoading] = useState(false);
    const { setNotification } = useAppContext();

    useEffect(() => {
        getUsers();
    }, []);

    function getUsers() {
        setLoading(true)
        axiosClient.get<{ data: IUser[] }>('/users')
            .then(({ data }) => {
                console.log(data)
                setLoading(false)
                setUsers(data.data)
            })
            .catch(() => {
                setUsers([])
                setLoading(false)
            })
    };

    function handleDelete(user: IUser) {
        if (!window.confirm("Are you sure you want to delete this user?")) {
            return
        }
        axiosClient.delete(`/users/${user.id}`)
            .then(() => {
                setNotification('User was successfully deleted')
                getUsers()
            })
    };

    return (
        <div>
            <div style={{ display: 'flex', justifyContent: "space-between", alignItems: "center" }}>
                <h1>Users</h1>
                <Link className="btn-add" to="/users/new">Add new</Link>
            </div>
            <div className="card animated fadeInDown">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    {loading &&
                        <tbody>
                            <tr>
                                <td colSpan={Number("5")} className="text-center">
                                    Loading...
                                </td>
                            </tr>
                        </tbody>
                    }
                    {!loading &&
                        <tbody>
                            {users.map(user => (
                                <tr key={user.id}>
                                    <td>{user.id}</td>
                                    <td>{user.name}</td>
                                    <td>{user.email}</td>
                                    <td>{user.created_at}</td>
                                    <td>
                                        <Link className="btn-edit" to={'/users/' + user.id}>Edit</Link>
                                        &nbsp;
                                        <button className="btn-delete" onClick={() => handleDelete(user)}>Delete</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    }
                </table>
            </div>
        </div>
    )
}
