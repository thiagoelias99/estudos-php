import { Navigate, Outlet } from 'react-router-dom';
import { useAppContext } from '../../Hooks/useAppContext';

export default function DefaultLayout() {
    const { token } = useAppContext();

    if (!token) {
        return <Navigate to="/login" />
    }

    return (
        <div>
            <h1>Default Layout</h1>
            <Outlet />
        </div>
    )
}
