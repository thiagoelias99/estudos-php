import { Link, Navigate, Outlet } from 'react-router-dom';
import { useAppContext } from '../../Hooks/useAppContext';
import axiosClient from '../../axios-client';

export default function DefaultLayout() {
    const { token, user, setToken, setUser, notification } = useAppContext();

    if (!token) {
        return <Navigate to="/login" />
    }
    const handleLogout = () => {
        axiosClient.post('/logout')
            .then(() => {
                setUser(null)
                setToken(null)
            })
    }

    return (
        <div id="defaultLayout">
            <aside>
                <Link to="/dashboard">Dashboard</Link>
                <Link to="/users">Users</Link>
            </aside>
            <div className="content">
                <header>
                    <div>
                        Header
                    </div>

                    <div>
                        {user?.name}
                        <a onClick={() => handleLogout()} className="btn-logout" href="#">Logout</a>
                    </div>
                </header>
                <main>
                    <Outlet />
                </main>
                {notification &&
                    <div className="notification">
                        {notification}
                    </div>
                }
            </div>
        </div>
    )
}
