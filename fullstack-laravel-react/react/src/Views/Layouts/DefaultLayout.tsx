import { Link, Navigate, Outlet } from 'react-router-dom';
import { useAppContext } from '../../Hooks/useAppContext';

export default function DefaultLayout() {
    const { token, user } = useAppContext();

    if (!token) {
        return <Navigate to="/login" />
    }

    console.log('User', user)

    const handleLogout = () => {
        console.log('Logout')
        // axiosClient.post('/logout')
        //     .then(() => {
        //         setUser({})
        //         setToken(null)
        //     })
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
                {/* {notification &&
                    <div className="notification">
                        {notification}
                    </div>
                } */}
            </div>
        </div>
    )
}
