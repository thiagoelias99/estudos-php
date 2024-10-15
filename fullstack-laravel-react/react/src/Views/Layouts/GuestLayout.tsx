import { Navigate, Outlet } from 'react-router-dom';
import { useAppContext } from '../../Hooks/useAppContext';

export default function GuestLayout() {
    const { token } = useAppContext();
    if (token) {
        return <Navigate to="/" />
    }

    return (
        <div id="guestLayout">
            <Outlet />
        </div>
    );
}
